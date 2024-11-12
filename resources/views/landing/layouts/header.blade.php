<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if (in_array(env('APP_ENV'), ['local', 'test']))
        <meta name="url" content="{{ 'https://api.mlouma.org/api' }}" hidden>
    @elseif(env('APP_ENV') === 'prod')
        <meta name="url" content="{{ 'https://api.mlouma.com/api' }}" hidden>
    @endif
    <meta name="user_id" content="{{ isset($_SESSION['id_utilisateur']) ? $_SESSION['id_utilisateur'] : null }}">
    {{-- <meta name="client" content="{{ isset($_SESSION['client']) ? $_SESSION['client'] : null }}"> --}}
    <meta name="token" content="{{ isset($_GET['token']) ? $_GET['token'] : null }}">
    <meta name="id" content="{{ isset($_GET['utilisateur']) ? $_GET['utilisateur'] : null }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="keywords"
        content="mlouma, xamsambay, louma mbay, meteombay, prix du marche">
    <meta name="author" content="Mlouma">
    <!-- Site Title -->
    <title>XAMSAMBAY | V2.0</title>
    <!-- Meta Description Tag -->
    <meta name="description" content="Xamsambay, une plateforme de Mlouma qui vous propose des services étudiés et optimisés pour répondre aux besoins spécifiques des acteurs de la chaine de valeurs!">
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo/FAVICO1.ico') }}">

    <!-- Material Design Lite Stylesheet CSS -->
    <link rel="stylesheet" href="{{ asset('assets/landing/plugin/material/material.min.css') }}" type="text/css" />
    <!-- Material Design Select Field Stylesheet CSS -->
    <link rel="stylesheet" href="{{ asset('assets/landing/plugin/material/mdl-selectfield.min.css') }}" type="text/css">
    <!-- Animteheading Stylesheet CSS -->
    <link rel="stylesheet" href="{{ asset('assets/landing/plugin/animateheading/animateheading.min.css') }}"
        type="text/css" />
    <!-- Owl Carousel Stylesheet CSS -->
    <link rel="stylesheet" href="{{ asset('assets/landing/plugin/owl_carousel/owl.carousel.min.css') }}"
        type="text/css" />
    <!-- Animate Stylesheet CSS -->
    <link rel="stylesheet" href="{{ asset('assets/landing/plugin/animate/animate.min.css') }}" type="text/css" />
    <!-- Magnific Popup Stylesheet CSS -->
    <link rel="stylesheet" href="{{ asset('assets/landing/plugin/magnific_popup/magnific-popup.min.css') }}"
        type="text/css" />
    <!-- Flex Slider Stylesheet CSS -->
    <link rel="stylesheet" href="{{ asset('assets/landing/plugin/flexslider/flexslider.min.css') }}" type="text/css" />

    <!-- Custom Main Stylesheet CSS -->
    <link rel="stylesheet" href="{{ asset('assets/landing/dist/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/landing/dist/css/style2.css') }}" type="text/css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/landing/dist/css/style_green_api.css') }}" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/landing/fontawesome-free/css/all.min.css') }}">

    {{-- data table --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/data-tables/css/select.dataTables.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/vente/shop.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vente/comment.css') }}">


<link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2-materialize.css') }}" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets\css\pages\form-select2.css') }}">

        
    {{-- <link rel="stylesheet" href="{{ asset('assets/landing/dist/css/bootstrap/bootstrap.css') }}" type="text/css"> --}}

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    {{-- <link rel="stylesheet" href="{{ asset('assets/landing/font-awesome/css/font-awesome.min.css')}}"> --}}

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}



</head>
