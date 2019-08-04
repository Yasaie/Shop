<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv=”content-type” content=”text/html; charset=utf-8″/>

    <script>
        var app_url = "{{url('/')}}";
        var csrf_token = "{{csrf_token()}}";
    </script>

    @yield('robots')
    @yield('description')
    @yield('keywords')

    @include('front.layout.assets')
    @yield('header_include')

    <title>
        @hasSection ('title')
            {{setting('site.title')}} - @yield('page-title')
        @else
            {{setting('site.title')}}
        @endif
    </title>

</head>
<body class="{{isRTL(0)}} home page-template-default page page-id-1125
    woocommerce-no-js yith-wcan-free emallshop-v-2.1.9 sticky-navigation
    sticky open-categories-menu wpb-js-composer js-comp-ver-5.7 vc_responsive">

<div class="wrapper">
    <div class="main-container">

        @include('front.layout.header')

        @yield('content')

        @include('front.layout.footer')

    </div>
</div>

@yield('footer_include')
</body>
</html>
