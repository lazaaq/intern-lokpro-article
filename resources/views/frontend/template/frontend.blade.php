<!doctype html>
<html class="no-js" lang="zxx">

 @include('frontend.template.header')

<body>

    @include('frontend.template.navbar')

    @yield('content')

    @include('frontend.template.footer')

    @include('frontend.template.javascript')
</body>

</html>
