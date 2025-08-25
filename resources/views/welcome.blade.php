<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef's Kitchen - Sistema de Gestión para Restaurantes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header/Navbar -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">🍽️ Chef's Kitchen</h1>
                </div>
                
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-600 hover:text-blue-600">Inicio</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Servicios</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Funcionalidades</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Precios</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Contacto</a>
                </nav>
                
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-blue-600 hidden md:block">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 hidden md:block">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-150 ease-in-out">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Sistema de Gestión para Restaurantes</h2>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                    Administra tu restaurante de manera eficiente con nuestro sistema integral. Controla inventario, personal y ventas desde una sola plataforma.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @guest
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-150 ease-in-out">
                            Comenzar Prueba Gratuita
                        </a>
                        <a href="{{ url('/dashboard') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-150 ease-in-out">
                            Ver Demo
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-150 ease-in-out">
                            Ir al Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-4">
                    <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">500+</div>
                    <div class="text-gray-600">Restaurantes</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">99,9%</div>
                    <div class="text-gray-600">Uptime</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">24/7</div>
                    <div class="text-gray-600">Soporte</div>
                </div>
                <div class="p-4">
                    <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">100%</div>
                    <div class="text-gray-600">Seguro</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Funcionalidades Principales</h3>
                <p class="text-lg text-gray-600">Todo lo que necesitas para gestionar tu restaurante de manera profesional</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="text-blue-600 text-4xl mb-4">👥</div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Gestión de Usuarios</h4>
                    <p class="text-gray-600">Administra empleados y usuarios con roles específicos y permisos personalizados para cada área de tu restaurante.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="text-blue-600 text-4xl mb-4">📦</div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Gestión de Productos</h4>
                    <p class="text-gray-600">Administra tu menú, controla inventarios y supervisa el uso de tus productos en tiempo real.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="text-blue-600 text-4xl mb-4">📊</div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Dashboard Intuitivo</h4>
                    <p class="text-gray-600">Visualiza datos y cifras de tu negocio con gráficos claros y reportes detallados para una mejor toma de decisiones.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-3xl font-bold mb-6">¿Listo para transformar tu restaurante?</h3>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Únete a cientos de restaurantes que ya confían en nuestra plataforma.</p>
            
            <div class="bg-white text-gray-800 rounded-lg p-8 max-w-4xl mx-auto shadow-lg">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h4 class="text-2xl font-bold mb-4">Prueba Gratuita por 30 días</h4>
                        <p class="mb-6">Experimenta todas las funcionalidades sin compromiso</p>
                        @guest
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold inline-block">
                                Comenzar Ahora
                            </a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold inline-block">
                                Ir al Dashboard
                            </a>
                        @endguest
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Sistema Seguro y Confiable</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Soporte 24/7 incluido</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Sin tarjeta de crédito requerida</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-xl font-bold mb-4">Chef's Kitchen</h4>
                    <p class="text-gray-400">La solución completa para la gestión moderna de restaurantes.</p>
                </div>
                
                <div>
                    <h5 class="font-semibold mb-4">Producto</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Funcionalidades</a></li>
                        <li><a href="#" class="hover:text-white">Integraciones</a></li>
                        <li><a href="#" class="hover:text-white">API</a></li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="font-semibold mb-4">Soporte</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Centro de Ayuda</a></li>
                        <li><a href="#" class="hover:text-white">Contacto</a></li>
                        <li><a href="#" class="hover:text-white">Demo</a></li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="font-semibold mb-4">Empresa</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Acerca de</a></li>
                        <li><a href="#" class="hover:text-white">Blog</a></li>
                        <li><a href="#" class="hover:text-white">Prensa</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>© 2024 Chef's Kitchen. Sistema de gestión para restaurantes.</p>
            </div>
        </div>
    </footer>
</body>
</html>