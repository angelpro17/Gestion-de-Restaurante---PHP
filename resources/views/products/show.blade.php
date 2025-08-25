<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles del Producto') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('products.edit', $product) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                    <i class="fas fa-edit mr-1"></i> Editar
                </a>
                <a href="{{ route('products.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                    <i class="fas fa-arrow-left mr-1"></i> Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensajes de éxito -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Imagen del producto -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-96 object-cover rounded-lg shadow-md">
                                @else
                                    <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <div class="text-center text-gray-500">
                                            <i class="fas fa-image text-6xl mb-4"></i>
                                            <p class="text-lg">Sin imagen</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Acciones rápidas -->
                            <div class="flex space-x-2">
                                <form action="{{ route('products.toggle-availability', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="flex-1 {{ $product->available ? 'bg-red-500 hover:bg-red-700' : 'bg-green-500 hover:bg-green-700' }} text-white font-bold py-2 px-4 rounded transition duration-200">
                                        <i class="fas {{ $product->available ? 'fa-eye-slash' : 'fa-eye' }} mr-1"></i>
                                        {{ $product->available ? 'Marcar No Disponible' : 'Marcar Disponible' }}
                                    </button>
                                </form>
                                
                                <form action="{{ route('products.duplicate', $product) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="flex-1 bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                                        <i class="fas fa-copy mr-1"></i> Duplicar
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Información del producto -->
                        <div class="space-y-6">
                            <!-- Información básica -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $product->name }}</h3>
                                
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                                        <p class="text-3xl font-bold text-green-600">{{ $product->formatted_price }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ ucfirst($product->category) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $product->available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        <i class="fas {{ $product->available ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                        {{ $product->available ? 'Disponible' : 'No Disponible' }}
                                    </span>
                                </div>

                                @if($product->description)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                                        <div class="bg-white p-4 rounded border">
                                            <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Información del sistema -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-800 mb-4">Información del Sistema</h4>
                                
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <span class="text-sm font-medium text-gray-600">ID del Producto:</span>
                                        <span class="text-sm text-gray-800 font-mono">#{{ $product->id }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <span class="text-sm font-medium text-gray-600">Creado:</span>
                                        <span class="text-sm text-gray-800">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                        <span class="text-sm font-medium text-gray-600">Última actualización:</span>
                                        <span class="text-sm text-gray-800">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    
                                    @if($product->image)
                                        <div class="flex justify-between items-center py-2">
                                            <span class="text-sm font-medium text-gray-600">Archivo de imagen:</span>
                                            <span class="text-sm text-gray-800 font-mono truncate max-w-xs">{{ basename($product->image) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Acciones administrativas -->
                            <div class="bg-red-50 rounded-lg p-6 border border-red-200">
                                <h4 class="text-lg font-semibold text-red-800 mb-4">Zona de Peligro</h4>
                                
                                <form action="{{ route('products.destroy', $product) }}" method="POST" 
                                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded transition duration-200">
                                        <i class="fas fa-trash mr-1"></i> Eliminar Producto
                                    </button>
                                </form>
                                
                                <p class="text-sm text-red-600 mt-2">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Esta acción eliminará permanentemente el producto y su imagen asociada.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts para confirmaciones -->
    <script>
        // Confirmación para cambio de disponibilidad
        document.querySelector('form[action*="toggle-availability"]').addEventListener('submit', function(e) {
            const isAvailable = {{ $product->available ? 'true' : 'false' }};
            const action = isAvailable ? 'marcar como no disponible' : 'marcar como disponible';
            
            if (!confirm(`¿Estás seguro de que deseas ${action} este producto?`)) {
                e.preventDefault();
            }
        });
        
        // Confirmación para duplicar
        document.querySelector('form[action*="duplicate"]').addEventListener('submit', function(e) {
            if (!confirm('¿Deseas crear una copia de este producto?')) {
                e.preventDefault();
            }
        });
    </script>
</x-app-layout>