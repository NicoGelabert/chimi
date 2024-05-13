<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Punto Sur Pastelería') }}</title>

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/img/puntosur.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=albert-sans:200,300,500,700|battambang:100,300,400,700,900" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <style>
    #loader-wrapper{
        width:100%;
        height: 100vh;
        display:flex;
        justify-content: center;
        align-items: center;
    }
    
    #body-content{
        display:none;
    }
</style>
    <body>
        <div id="loader-wrapper">
            <x-spinner />
        </div>
        <div id="body-content">
            <!-- Toast -->
            <div
                x-data="toast"
                x-show="visible"
                x-transition
                x-cloak
                @notify.window="show($event.detail.message)"
                class="toast z-20 fixed w-full max-w-[350px] bottom-0 mb-8 right-0 mr-8 py-4 px-4 rounded-3xl"
            >
                <div class="flex justify-between w-full items-center z-10">
                    <div class="font-semibold" x-text="message"></div>
                    <button
                        @click="close"
                        class="w-[30px] h-[30px] flex items-center justify-center rounded-full hover:bg-black/10 transition-colors"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
                <!-- Progress -->
                <div>
                    <div
                        class="progress absolute left-0 bottom-0 right-0 h-full rounded-3xl"
                        :style="{'width': `${percent}%`}"
                    ></div>
                </div>
            </div>
            <!--/ Toast -->
            @include('layouts.navigation')
            <main class="w-full mx-auto">
                {{ $slot }}
            </main>
            
            @include('layouts.footer')
            
        </div>
    </body>
</html>
<script>
    window.onload = function () {
    //Find the element with id "loader-wrapper" and hide it
        var loaderWrapper = document.getElementById('loader-wrapper');
        var bodyContent = document.getElementById('body-content');
        
        if (loaderWrapper) {
            loaderWrapper.style.display = 'none';
            bodyContent.style.display = 'block';
        }
    };
</script>