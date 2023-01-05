<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/app.css')}}">
    <link rel="stylesheet" href="/backend/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="/backend/vendors/quill/quill.bubble.css">
    <link rel="stylesheet" href="/backend/vendors/quill/quill.snow.css">
    <link rel="stylesheet" href="/backend/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="shortcut icon" href="/backend/images/favicon.svg" type="image/x-icon">
    @yield('spesifik_link')
    @yield('style')
</head>

<body>

    <div id="app">
        @include('layouts.backend.jobseeker.sidebar')
        <div id="main">
            @yield('content')
            @include('layouts.backend.jobseeker.footer')
        </div>
    </div>

    <script src="{{asset('backend/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('backend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/js/main.js')}}"></script>
    <script src="{{ asset('backend/vendors/jquery/jquery.min.js') }}"></script>

    @yield('script')
    <script src="/backend/vendors/fontawesome/all.min.js"></script>
    <script src="/backend/js/main.js"></script>

    <script src="/backend/vendors/quill/quill.min.js"></script>
    <script src="/backend/js/pages/form-editor.js"></script>
    <script src="/backend/vendors/tinymce/tinymce.min.js"></script>
    <script src="/backend/vendors/tinymce/plugins/code/plugin.min.js"></script>
    <script src="/backend/js/extensions/sweetalert2.js"></script>
    <script src="/backend/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
        tinymce.init({
            // selector: '#default'
        });
        tinymce.init({
            selector: '#dark',
            // toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
            // plugins: 'code'
        });
    </script>
</body>

</html>