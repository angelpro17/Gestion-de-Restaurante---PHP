<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();
    
        // Filtro por categoría
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }
    
        // Filtro por disponibilidad
        if ($request->filled('available')) {
            if ($request->available === '1') {
                $query->available();
            } else {
                $query->where('available', false);
            }
        }
    
        // Búsqueda por nombre o descripción
        if ($request->filled('search')) {
            $query->search($request->search);
        }
    
        // Ordenamiento
        $sortBy = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');
        
        if (in_array($sortBy, ['name', 'price', 'category', 'created_at'])) {
            $query->orderBy($sortBy, $sortDirection);
        }
    
        $products = $query->paginate(12)->withQueryString();
        $categories = Product::getCategories();
    
        // Calcular estadísticas para el dashboard
        $availableCount = Product::where('available', true)->count();
        $unavailableCount = Product::where('available', false)->count();
    
        return view('products.index', compact('products', 'categories', 'availableCount', 'unavailableCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Product::getCategories();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0|max:999999.99',
            'category' => ['required', Rule::in(Product::getCategories())],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'available' => 'boolean',
        ]);

        $productData = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'available' => $request->boolean('available', true),
        ];

        // Manejo de imagen
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $productData['image'] = $imagePath;
        }

        Product::create($productData);

        return redirect()->route('products.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Product::getCategories();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0|max:999999.99',
            'category' => ['required', Rule::in(Product::getCategories())],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'available' => 'boolean',
        ]);

        $productData = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'available' => $request->boolean('available', true),
        ];

        // Manejo de imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $productData['image'] = $imagePath;
        }

        $product->update($productData);

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Eliminar imagen si existe
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }

    /**
     * Marcar producto como disponible
     */
    public function markAvailable(Product $product)
    {
        $product->markAsAvailable();

        return redirect()->back()
            ->with('success', 'Producto marcado como disponible.');
    }

    /**
     * Marcar producto como no disponible
     */
    public function markUnavailable(Product $product)
    {
        $product->markAsUnavailable();

        return redirect()->back()
            ->with('success', 'Producto marcado como no disponible.');
    }

    /**
     * Alternar disponibilidad del producto
     */
    public function toggleAvailability(Product $product)
    {
        if ($product->isAvailable()) {
            return $this->markUnavailable($product);
        } else {
            return $this->markAvailable($product);
        }
    }

    /**
     * Obtener productos por categoría (API)
     */
    public function getByCategory(Request $request, $category)
    {
        $products = Product::byCategory($category)
            ->available()
            ->get();

        return response()->json($products);
    }

    /**
     * Búsqueda de productos (API)
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query) {
            return response()->json([]);
        }

        $products = Product::search($query)
            ->available()
            ->limit(10)
            ->get();

        return response()->json($products);
    }

    /**
     * Duplicar producto
     */
    public function duplicate(Product $product)
    {
        $newProduct = $product->replicate();
        $newProduct->name = $product->name . ' (Copia)';
        $newProduct->save();

        return redirect()->route('products.edit', $newProduct)
            ->with('success', 'Producto duplicado exitosamente. Puedes editarlo ahora.');
    }

    /**
     * Exportar productos a CSV
     */
    public function export()
    {
        $products = Product::all();
        
        $filename = 'productos_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($products) {
            $file = fopen('php://output', 'w');
            
            // Encabezados CSV
            fputcsv($file, ['ID', 'Nombre', 'Descripción', 'Precio', 'Categoría', 'Disponible', 'Creado']);
            
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->name,
                    $product->description,
                    $product->price,
                    $product->category,
                    $product->available ? 'Sí' : 'No',
                    $product->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}