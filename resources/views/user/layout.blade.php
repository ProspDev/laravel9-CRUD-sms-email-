<!DOCTYPE html>
<html>
<head>
    <title>User CRUD Application </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
    .avatar {
        width: 60px;
        height: 60px;
        margin: auto;
        border-radius: 30px;
    }

    td { vertical-align: middle !important; }

    th, td { text-align: center; }

    .pull-left {
        float: left;
    }

    .pull-right { float: right; }
    .margin-tb { 
        margin-top: 40px;
        margin-bottom: 30px;
    }
</style>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>