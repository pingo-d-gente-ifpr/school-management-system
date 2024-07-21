<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
 
        <title>Pingo de Gente</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


        <!-- Material Design Icons -->
        {{-- <link type="text/css" href="{{ asset('assets/css/material-icons.css')}}" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
        

        {{-- Flatpicker --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- Scripts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        {{-- CSS --}}
        <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
        
    </head>
    <body class="font-sans antialiased">
        <div class="d-flex">
            @include('layouts.navigation')
            <div class="w-100">
                 <!-- Page Content -->
                @include('layouts.header')
                <main style="height:100vh;width:100%">
                    {{ $slot }}
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="{{ asset("public/assets/js/sidebars.js") }}"></script>
    </body>
    
</html>