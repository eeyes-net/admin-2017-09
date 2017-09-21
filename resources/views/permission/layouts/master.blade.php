<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ganlv,eeyes.net">
    <title>e瞳统一权限管理</title>
    <link href="/static/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/permission/css/style.css" rel="stylesheet">
</head>
<body>
    @include('permission.layouts.nav')
    <div class="container-fluid">
        <div class="row">
            <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
                @include('permission.layouts.breadcrumb')
                @include('permission.layouts.errors')
                @include('permission.layouts.success')
                @yield('main')
            </main>
            @include('permission.layouts.sidebar')
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @include('permission.layouts.footer')
        </div>
    </div>
    <script src="/static/dist/js/jquery-3.2.1.min.js"></script>
    <script src="/static/dist/js/popper.min.js"></script>
    <script src="/static/dist/js/bootstrap.min.js"></script>
</body>
</html>
