<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link rel="stylesheet" href="<?php echo asset('css/header.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/modal.css')?>" type="text/css">
</head>
<body>
    <div id="app"></div>
<script src="<?php echo asset('js/app.js')?>"></script>
</body>
</html>
