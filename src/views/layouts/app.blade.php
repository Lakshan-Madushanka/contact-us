<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ Session::token() }}">

    <title>Document</title>

    <link rel="stylesheet" href={{asset('vendor/lakm/contact/css/style.css')}}>


</head>
<body>
<div class="wrapper">
    <header>
        @section('header')
        @show
    </header>

    <main>
        @yield('content')
    </main>

</div>

<script src="{{asset('vendor/lakm/contact/js/main-script.js')}}"></script>
@yield('script')
{{--<script src="{{asset('vendor/lakm/contact/js/main-script.js')}}"></script>--}}

{{--<script src="{{asset('vendor/lakm/contact/js/script.js')}}"></script>--}}

</body>
</html>