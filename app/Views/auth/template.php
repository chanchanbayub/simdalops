<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.css">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="/assets/plugins/sweetalert2/sweetalert2.min.css">

    <!-- logo -->
    <link rel="shortcut icon" href="https://3.bp.blogspot.com/-1aWsvIfu95A/W6XY0r7XX0I/AAAAAAAAD3s/LOn2CDpfLyUniUWAXeTeJ-yHZKUyZP0QACLcBGAs/s1600/dishub.png" type="image/png">
</head>

<body class="hold-transition login-page">

    <?= $this->renderSection("content"); ?>
    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
    <!-- Sweet Alert -->
    <script src="/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
</body>

</html>