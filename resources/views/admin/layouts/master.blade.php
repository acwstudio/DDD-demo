<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.partials.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

@include('admin.partials.header')
@include('admin.partials.aside')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.flashes')

        @yield('content')
    </div>

    @include('admin.partials.footer')

</div>

@include('admin.partials.scripts')

</body>

</html>
