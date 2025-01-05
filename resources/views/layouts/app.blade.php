<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
    $site = DB::table('sites')->find(1);
    $sitetitle = $site->title; 
    $fav_icon =$site->fav_icon; 
    @endphp
    @if ($site)
    <title>{{  $sitetitle==null? 'Laravel':  $sitetitle }}</title>
    <link rel="icon" type="image/x-icon" href="{{ Storage::url($fav_icon) }}">
    @else
    <title>Laravel</title>
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <!-- Styles -->
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" data-navigate-track></script>
        <style>
            td {
  -webkit-touch-callout: initial; /* iOS Safari */
  -webkit-user-select: text; /* Safari */
  -khtml-user-select: text; /* Konqueror HTML */
  -moz-user-select: text; /* Old versions of Firefox */
  -ms-user-select: text; /* Internet Explorer/Edge */
  user-select: text; /* Non-prefixed version, currently supported by Chrome, Edge, Opera, and Firefox */
}
        </style>
    @stack('css')
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
        </main>
        <div class="custombody bg-white dark:bg-gray-800  overflow-hidden shadow-xl sm:rounded-lg">
            {{-- <x-welcome /> --}}
            <div class="sb-cover">
                <div class="sidebar">
                    <div class="resizer"></div>
                    <div class="header">
                        <a href="{{ route('admin.dashboard') }}">
                            <h3>Dashboard</h3>
                        </a>
                    </div>
                    @if(Auth::guard('admin')->check())
                    @livewire('backend.body.sidebar')
                    @endif

                    @if(Auth::guard('web')->check())
                    @livewire('frontend.sidebar.dashboard')
                    @endif
                </div>
            </div>
            <div class="rs-content">
                {{ $slot }}
            </div>
        </div>
    </div>

    @stack('modals')

    @livewireScripts

    {{-- all script start from here --}}
    {{-- <script>
        window.addEventListener('popstate', function(event) {
            // Get the previous URL
            var previousUrl = document.referrer;

            // Redirect to the previous URL
            window.location.href = previousUrl;
        });
    </script> --}}

    <script src="{{ asset('asset/js/resizer.js') }}"></script>{{-- sidebar resizer script  --}}
    <script src="{{ asset('asset/custom_js/tailwindcss3.3.5.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>{{-- https://ionic.io/ionicons/usage  --}}
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>{{-- https://ionic.io/ionicons/usage  --}}
    <script src="{{ asset('asset/custom_js/multiselect-dropdown.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" data-navigate-track></script>
    
    {{-- <script src="{{ asset('asset/custom_js/toastr.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 10000;
                    toastr.info("{{ Session::get('message') }}");
                    var audio = new Audio('{{ asset('asset/audio/audio.mp3') }}');
                    audio.play();
                    break;
                case 'success':

                    toastr.options.timeOut = 10000;
                    toastr.success("{{ Session::get('message') }}");
                    var audio = new Audio('{{ asset('asset/audio/audio.mp3') }}');
                    audio.play();

                    break;
                case 'warning':

                    toastr.options.timeOut = 10000;
                    toastr.warning("{{ Session::get('message') }}");
                    var audio = new Audio('{{ asset('asset/audio/audio.mp3') }}');
                    audio.play();

                    break;
                case 'error':

                    toastr.options.timeOut = 10000;
                    toastr.error("{{ Session::get('message') }}");
                    var audio = new Audio('{{ asset('asset/audio/audio.mp3') }}');
                    audio.play();

                    break;
            }
        @endif
    </script>
    {{-- all script end from here --}}
    <script>
        window.addEventListener('popstate', function(event) {
            // Get the previous URL
            var previousUrl = document.referrer;

            // Redirect to the previous URL
            window.location.href = previousUrl;
        });
    </script>
@stack('scripts')
</body>

</html>
