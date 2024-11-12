<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title> --}}
    @include('landing.layouts.header')

</head>

<body class="my-0">

    <div class="wrapper">
        @yield('landingContent')
        @include('landing.layouts.footer')
    </div>

    @include('landing.layouts.script')
</body>

</html>

{{-- <div class="py-2 h-50">
            <h3 class="text-center">Secteur d'Active</h3>
        </div> 
        <div class="py-2 h-100">
            <h3 class="text-center">Les services de l'ecosysteme</h3>
        </div>
        <div class="py-2 h-100">
            <h3 class="text-center">Chiffre & Donnees de la Base</h3>
        </div> --}}

{{-- @include('landing.dashboard') --}}
