<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <script> window.Reenev = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>; </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Styles -->
    <!-- <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet"> -->
    <link href="<?php echo e(asset('/bootstrap-3.3.7-dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/estilos.css')); ?>" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('/font-awesome-4.7.0/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <style>
        .slow .toggle-group { transition: left 1s; -webkit-transition: left 1s; }
        .fast .toggle-group { transition: left 0.1s; -webkit-transition: left 0.1s; }
        .quick .toggle-group { transition: none; -webkit-transition: none; }
    </style>
</head>
<body>
    <div id="app" class="app">
        <?php echo $__env->make('layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!-- Scripts -->
    <!-- <script src="<?php echo e(asset('js/app.js')); ?>"></script> -->
    <script src="<?php echo e(asset('/js/jquery-3.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/wait.js')); ?>"></script>
    <script src="<?php echo e(asset('/bootstrap-3.3.7-dist/js/bootstrap.min.js')); ?>"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="<?php echo e(asset('/js/funciones.js')); ?>"></script>
    
</body>
</html>