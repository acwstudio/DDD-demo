<!doctype html>
<html class="no-js" lang="en">

@include('shop.partials.head')

<body>
<div class="main-wrapper">

    <!-- Header Section Start -->
@include('shop.partials.header')
<!-- Header Section End -->

@yield('content')

<!-- Brand Section Start -->
@include('shop.partials.brands')
<!-- Brand Section End -->

    <!-- Service Section Start -->
@include('shop.partials.service')
<!-- Service Section End -->

    <!-- Footer Top Section Start -->
@include('shop.partials.footer-top')
<!-- Footer Top Section End -->

    <!-- Footer Bottom Section Start -->
@include('shop.partials.footer-bottom')
<!-- Footer Bottom Section End -->

</div>
<!-- JS
============================================ -->

@include('shop.partials.scripts')

</body>

</html>
