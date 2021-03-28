<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script>
             window.App={!!json_encode([
                'signedIn'=>auth()->check(),
                'user'=>auth()->user()
            ])!!}
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100" id="app">
            @include('layouts.navigation')
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            
            <footer class="bg-gray-800 mt-10 p-20 text-center text-white">
                crafted by CreativeCoder in 2021 
            </footer>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            window.flash=toastr;//make toastr to global use
            let success="{{session('success')}}";
            if(success){
                toastr.success(success,'',{timeOut: 2000});
            }
            let danger="{{session('danger')}}";
            if(danger){
                toastr.error(danger,'',{timeOut: 2000});
            }
        </script>
        <script src="{{asset('js/vue.js')}}"></script>
    </body>
</html>
