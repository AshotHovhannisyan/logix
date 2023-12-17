<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>User tasks</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css?v=' . time()) }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div id="app">

        @include('layouts.header')
        <main >
            @yield('content')
        </main>
        @include('layouts.footer')

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="{{ asset('assets/js/app.js')}}" type="text/javascript" charset="utf-8"></script>
</body>
</html>
