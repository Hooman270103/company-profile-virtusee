<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $setting['name'] }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- favicon included here -->
    <link rel="shortcut icon" href="{{ $setting['favicon'] }}" type="image/x-icon" />

    <!-- apple touch icon included here -->
    <link rel="apple-touch-icon" href="{{ $setting['favicon'] }}" />

    
    @stack('css')

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

     <!-- Bootstrap  v5.2.1 css -->
     <link rel="stylesheet" href="{{ asset('assets_frontend') }}/css/bootstrap.min.css" />
     <!-- slick slider css -->
     <link rel="stylesheet" href="{{ asset('assets_frontend') }}/css/slick.css" />
     <link rel="stylesheet" href="{{ asset('assets_frontend') }}/css/slick-theme.css" />
     <!-- pie progress css -->
     <link rel="stylesheet" href="{{ asset('assets_frontend') }}/css/asPieProgress.min.css" />
     <!-- VenoBox 2.0.4 css -->
     <link rel="stylesheet" href="{{ asset('assets_frontend') }}/css/venobox.min.css" />
     <!-- Light Box css -->
     <link rel="stylesheet" href="{{ asset('assets_frontend') }}/css/lightbox.css" />
     <!-- headline.css -->
     <link rel="stylesheet" href="{{ asset('assets_frontend') }}/css/headline.css" />
     <!-- font awesome -->
     <link rel="stylesheet" href="../../../../cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
     <!-- custom css -->
     <link rel="stylesheet" href="{{ asset('assets_frontend') }}/css/style.css" />
     <!-- responsive css -->
     <link rel="stylesheet" href="{{ asset('assets_frontend') }}/css/responsive.css" />

    <!-- Vendor CSS Files -->
</head>
