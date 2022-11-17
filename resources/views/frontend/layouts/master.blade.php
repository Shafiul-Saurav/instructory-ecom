
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tohoney - @yield('frontend_title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('frontend.layouts.inc.style')

</head>

<body>
    @include('frontend.layouts.inc.preloader')

    @include('frontend.layouts.inc.search')

    @include('frontend.layouts.inc.header')

    @yield('frontend_content')

    @include('frontend.layouts.inc.newsletter')

    @include('frontend.layouts.inc.footer')

    @include('frontend.layouts.inc.modal')

    @include('frontend.layouts.inc.script')

</body>
</html>
