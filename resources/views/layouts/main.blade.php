<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Skill Test</title>
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/bootstrap.min.css') }}">

    @yield('style')
</head>
<body>
<div class="container">
    <div class="row">
        @yield('content')
    </div>
</div>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('bootstrap/bootstrap.min.js') }}"></script>
@yield('script-bottom')
</body>

</html>