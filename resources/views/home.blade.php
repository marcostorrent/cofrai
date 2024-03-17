{{-- Utiliza el layout de guest que proporciona Breeze --}}
<x-guest-layout>

    {{-- Encabezado de la página --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bienvenido a nuestra aplicación
        </h2>
    </x-slot>

    {{-- Contenido principal de la página de inicio --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Mensaje de bienvenida --}}
                    <p>COFRAI</p>
                    
                    {{-- Enlaces para iniciar sesión o registrarse --}}
                    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>

                       
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
