<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description"
        content="{{ config('app.name') }}, adalah kegiatan senam poundfit yang diselenggarakan oleh Bnetfit." />
    <meta name="author" content="Shella" />

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="{{ config('app.name') }}" /> <!-- website name -->
    <meta property="og:site" content="{{ route('welcome') }}" /> <!-- website link -->
    <meta property="og:title" content="{{ config('app.name') }}" /> <!-- title shown in the actual shared post -->
    <meta property="og:description"
        content="{{ config('app.name') }}, adalah kegiatan donor darah yang diselenggarakan oleh JLM." />
    <!-- description shown in the actual shared post -->
    <meta property="og:image" content="{{ asset('img/android-chrome-256x256.png') }}" />
    <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="{{ route('welcome') }}" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="{{ asset('img/android-chrome-512x512.png') }}" />

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('img/safari-pinned-tab.svg') }}" color="#1467b0">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="msapplication-TileColor" content="#1467b0">
    <meta name="msapplication-config" content="{{ asset('img/browserconfig.xml') }}">
    <meta name="theme-color" content="#1467b0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')
</head>

<body id="donordarah">
    <div id="app">
        @yield('content')
    </div>

    <footer class="footer py-3 mt-auto">
        <div class="d-flex justify-content-between container">
            <div class="d-flex align-items-center">
                <a href="https://jlm.net.id/" target="_blank"
                    class="me-2 mb-md-0 text-muted text-decoration-none lh-1 mb-3">
                    <img src="{{ asset('img/logo-jlm-1.png') }}" alt="JLM Logo" class="img-fluid"
                        style="max-width: 70px;" />
                </a>
                <span class="h6 mb-0" style="padding-top: 4px;">Copyright &copy; {{ date('Y') }}
                    PT Jala Lintas Media</span>
            </div>
            <div class="h4 d-flex align-items-center gap-2 mb-0" style="padding-top: 4px;">
                <a href="https://jlm.net.id/" target="_blank" class="text-decoration-none lh-1 ">
                    <i class="fas fa-fw fa-globe-asia"></i>
                </a>
                <a href="https://www.facebook.com/JLMISP" target="_blank" class="text-decoration-none lh-1 ">
                    <i class="fab fa-fw fa-facebook"></i>
                </a>
                <a href="https://www.instagram.com/jalalintasmedia.id" target="_blank"
                    class="text-decoration-none lh-1 ">
                    <i class="fab fa-fw fa-instagram"></i>
                </a>
                <a href="https://www.linkedin.com/company/pt-jala-lintas-media" target="_blank"
                    class="text-decoration-none lh-1 ">
                    <i class="fab fa-fw fa-linkedin"></i>
                </a>
                <a href="https://www.youtube.com/@jalalintasmediagroup" target="_blank"
                    class="text-decoration-none lh-1 ">
                    <i class="fab fa-fw fa-youtube"></i>
                </a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
