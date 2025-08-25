<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar Producto: ') . $product->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('products.show', $product) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Ver Producto
                </a>
                <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver a la lista
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Mensajes de error -->
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <strong>¡Oops! Algo salió mal.</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Mensajes de éxito -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Información básica -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Información Básica</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nombre del producto -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nombre del Producto <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-300 @enderror"
                                           placeholder="Ej: Pizza Margherita" required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Categoría -->
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                        Categoría <span class="text-red-500">*</span>
                                    </label>
                                    <select name="category" id="category" 
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category') border-red-300 @enderror" required>
                                        <option value="">Selecciona una categoría</option>
                                        <option value="entradas" {{ old('category', $product->category) == 'entradas' ? 'selected' : '' }}>Entradas</option>
                                        <option value="platos_principales" {{ old('category', $product->category) == 'platos_principales' ? 'selected' : '' }}>Platos Principales</option>
                                        <option value="postres" {{ old('category', $product->category) == 'postres' ? 'selected' : '' }}>Postres</option>
                                        <option value="bebidas" {{ old('category', $product->category) == 'bebidas' ? 'selected' : '' }}>Bebidas</option>
                                        <option value="ensaladas" {{ old('category', $product->category) == 'ensaladas' ? 'selected' : '' }}>Ensaladas</option>
                                        <option value="pizzas" {{ old('category', $product->category) == 'pizzas' ? 'selected' : '' }}>Pizzas</option>
                                        <option value="pastas" {{ old('category', $product->category) == 'pastas' ? 'selected' : '' }}>Pastas</option>
                                        <option value="carnes" {{ old('category', $product->category) == 'carnes' ? 'selected' : '' }}>Carnes</option>
                                        <option value="mariscos" {{ old('category', $product->category) == 'mariscos' ? 'selected' : '' }}>Mariscos</option>
                                        <option value="vegetarianos" {{ old('category', $product->category) == 'vegetarianos' ? 'selected' : '' }}>Vegetarianos</option>
                                    </select>
                                    @error('category')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="mt-6">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Descripción <span class="text-red-500">*</span>
                                </label>
                                <textarea name="description" id="description" rows="4" 
                                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-300 @enderror"
                                          placeholder="Describe los ingredientes y características del producto..." required>{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Describe los ingredientes, preparación y características especiales del producto.</p>
                            </div>
                        </div>

                        <!-- Precio y disponibilidad -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Precio y Disponibilidad</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Precio -->
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                        Precio <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" 
                                               step="0.01" min="0" 
                                               class="w-full pl-7 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('price') border-red-300 @enderror"
                                               placeholder="0.00" required>
                                    </div>
                                    @error('price')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Disponibilidad -->
                                <div>
                                    <label for="available" class="block text-sm font-medium text-gray-700 mb-2">
                                        Estado
                                    </label>
                                    <div class="flex items-center space-x-6">
                                        <div class="flex items-center">
                                            <input type="radio" name="available" id="available_yes" value="1" 
                                                   {{ old('available', $product->available) == '1' ? 'checked' : '' }}
                                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label for="available_yes" class="ml-2 block text-sm text-gray-900">
                                                Disponible
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="available" id="available_no" value="0" 
                                                   {{ old('available', $product->available) == '0' ? 'checked' : '' }}
                                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label for="available_no" class="ml-2 block text-sm text-gray-900">
                                                No disponible
                                            </label>
                                        </div>
                                    </div>
                                    @error('available')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Imagen del producto -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Imagen del Producto</h3>
                            
                            <!-- Imagen actual -->
                            @if($product->image)
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagen Actual</label>
                                    <div class="flex items-start space-x-4">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-lg">
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-600 mb-2">{{ basename($product->image) }}</p>
                                            <div class="flex items-center space-x-2">
                                                <input type="checkbox" name="remove_image" id="remove_image" value="1" class="rounded border-gray-300">
                                                <label for="remove_image" class="text-sm text-red-600">Eliminar imagen actual</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Nueva imagen -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $product->image ? 'Cambiar Imagen' : 'Agregar Imagen' }}
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>{{ $product->image ? 'Subir nueva imagen' : 'Subir una imagen' }}</span>
                                                <input id="image" name="image" type="file" accept="image/*" class="sr-only" onchange="previewImage(this)">
                                            </label>
                                            <p class="pl-1">o arrastra y suelta</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, JPEG hasta 2MB
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Preview de la nueva imagen -->
                                <div id="image-preview" class="mt-4 hidden">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nueva Imagen</label>
                                    <img id="preview-img" src="" alt="Preview" class="max-w-xs h-48 object-cover rounded-lg mx-auto">
                                    <button type="button" onclick="removeNewImage()" class="mt-2 text-sm text-red-600 hover:text-red-800 block mx-auto">
                                        Cancelar nueva imagen
                                    </button>
                                </div>
                                
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Información adicional -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Información del Producto</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <p><strong>Creado:</strong> {{ $product->created_at->format('d/m/Y H:i') }}</p>
                                        <p><strong>Última actualización:</strong> {{ $product->updated_at->format('d/m/Y H:i') }}</p>
                                        <p><strong>ID:</strong> {{ $product->id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <div class="flex space-x-2">
                                <!-- Duplicar producto -->
                                <form method="POST" action="{{ route('products.duplicate', $product) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                        Duplicar Producto
                                    </button>
                                </form>
                                
                                <!-- Toggle disponibilidad -->
                                <form method="POST" action="{{ route('products.toggle-availability', $product) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="{{ $product->available ? 'bg-red-500 hover:bg-red-700' : 'bg-green-500 hover:bg-green-700' }} text-white font-bold py-2 px-4 rounded transition-colors">
                                        {{ $product->available ? 'Marcar No Disponible' : 'Marcar Disponible' }}
                                    </button>
                                </form>
                            </div>
                            
                            <div class="flex space-x-4">
                                <a href="{{ route('products.show', $product) }}" 
                                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded transition-colors">
                                    Cancelar
                                </a>
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition-colors">
                                    Actualizar Producto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para preview de imagen -->
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function removeNewImage() {
            document.getElementById('image').value = '';
            document.getElementById('image-preview').classList.add('hidden');
            document.getElementById('preview-img').src = '';
        }
        
        // Drag and drop functionality
        const dropZone = document.querySelector('.border-dashed');
        const fileInput = document.getElementById('image');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            dropZone.classList.add('border-indigo-500', 'bg-indigo-50');
        }
        
        function unhighlight(e) {
            dropZone.classList.remove('border-indigo-500', 'bg-indigo-50');
        }
        
        dropZone.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                fileInput.files = files;
                previewImage(fileInput);
            }
        }
    </script>
</x-app-layout>