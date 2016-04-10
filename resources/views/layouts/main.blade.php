<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Hello, My name is Clay Malven. I am a developer and this site is used to showcase some of my work as well as a place to just test new applications that I am working on.">

    <title>Clay Malven</title>

    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->

    
    @yield('css')

</head>
<body id="app-layout">
    
    @include('layouts.nav')

    @yield('content')

    <!-- JavaScripts -->
    @yield('script')
    
</body>
</html>
