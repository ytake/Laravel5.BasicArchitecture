<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="utf-8">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <meta name="robots" content="index">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Yuuki Takezawa, @ytake">
    <meta name="description" content="@yield('description', null)">
    <meta name="keywords" content="@yield('keywords', null)" />
    @yield('meta')
    <title>@yield('title', null)</title>
    <link rel="shortcut icon" href="/icon/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="/icon/favicon.png">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/ripples.min.css" rel="stylesheet">
    <link href="/assets/css/material-wfont.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    @yield('styles')
</head>
<body>
    @include('elements.header')
    <div class="container" id="main">
        @yield('content')
    </div>
    @include('elements.footer')
    <script src="/assets/js/react.min.js"></script>
    <script src="/assets/js/react-with-addons.min.js"></script>
    @yield('scripts')
</body>
</html>
