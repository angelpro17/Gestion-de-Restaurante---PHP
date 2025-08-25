<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <div class="flex items-center space-x-3">
        <!-- Logo profesional con gradiente -->
        <div class="relative">
            <svg class="w-10 h-10" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#f59e0b;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#dc2626;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <!-- Plato base -->
                <circle cx="20" cy="28" r="11" fill="url(#logoGradient)" stroke="#374151" stroke-width="1.5"/>
                <!-- Sombra del plato -->
                <ellipse cx="20" cy="35" rx="8" ry="2" fill="#374151" opacity="0.3"/>
                <!-- Gorro de chef -->
                <path d="M12 15c0-4.4 3.6-8 8-8s8 3.6 8 8c0 1.1-.2 2.1-.6 3H12.6c-.4-.9-.6-1.9-.6-3z" fill="white" stroke="#374151" stroke-width="1.5"/>
                <rect x="12" y="18" width="16" height="4" fill="white" stroke="#374151" stroke-width="1.5"/>
                <!-- Detalles del gorro -->
                <circle cx="16" cy="12" r="1.5" fill="#f3f4f6"/>
                <circle cx="20" cy="10" r="1.5" fill="#f3f4f6"/>
                <circle cx="24" cy="12" r="1.5" fill="#f3f4f6"/>
                <!-- Cubiertos cruzados -->
                <path d="M15 25l2 2m0-2l-2 2" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M23 25h4m-2-2v4" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </div>
        <div class="flex flex-col">
            <span class="font-bold text-xl bg-gradient-to-r from-amber-500 to-red-600 bg-clip-text text-transparent">
                Chef's Kitchen
            </span>
            <span class="text-xs text-gray-500 font-medium tracking-wide">
                RESTAURANTE GOURMET
            </span>
        </div>
    </div>
</div>
