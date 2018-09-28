<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telphone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="/member/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="/member/css/style.css" />
    @yield('style')
</head>
<body>

@yield('content')

<script src="/member/js/jquery2.1.4.min.js"></script>
<script src="/member/js/lyup.js"></script>
<script src="/member/js/flexible.js" type="text/javascript" charset="utf-8"></script>
<script src="/member/js/pub.js" type="text/javascript" charset="utf-8"></script>
@yield('script')
</body>
</html>