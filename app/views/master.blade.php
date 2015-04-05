<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>豆瓣图书排名工具</title>
    <link rel="stylesheet" href="{{asset('styles/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('styles/bootstrap-table.css')}}">
    <link rel="stylesheet" href="{{asset('styles/bootstrap-editable.css')}}">
    {{ HTML::script('scripts/jquery.min.js') }}
    {{ HTML::script('scripts/bootstrap.min.js') }}
    {{ HTML::script('scripts/bootstrap-table.js') }}
    {{ HTML::script('scripts/bootstrap-editable.min.js') }}
</head>
<body>
<div class="container">
    <div class="page-header">
        @yield('header')
    </div>
    @yield('content')
</div>
</body>
</html>