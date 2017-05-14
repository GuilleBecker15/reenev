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

    <!-- Styles -->
<!--     <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
 -->    <link href="<?php echo e(asset('bootstrap-3.3.7-dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/estilos.css')); ?>" rel="stylesheet">

</head>

<body>

    <div id="app">

        <nav class="navbar navbar-default navbar-static-top">

            <div class="container">

                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <strong>
                        <a class="navbar-brand" style="color: darkslategray;" href="<?php echo e(url('/')); ?>"><?php echo e(config('app.name', 'Reenev')); ?></a>
                    </strong>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                        <!-- Authentication Links -->
                        <?php if(Auth::guest()): ?>
                        <li><a href="<?php echo e(route('register')); ?>">Registrarme</a></li>
                        <li><a href="<?php echo e(route('login')); ?>">Entrar</a></li>
                        <?php else: ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('accion', App\Modelo::class)): ?>
                        <li><a href="<?php echo e(url('/')); ?>">Completar encuesta</a></li>
                        <li><a href="<?php echo e(url('/')); ?>">Encuestas completadas</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accion', App\Modelo::class)): ?>
                        <li><a href="<?php echo e(route('Cursos.index')); ?>">Cursos</a></li>
                        <li><a href="<?php echo e(route('Docentes.index')); ?>">Docentes</a></li>
                        <li><a href="<?php echo e(route('Encuestas.index')); ?>">Encuestas</a></li>
                        <li><a href="<?php echo e(route('Users.index')); ?>">Usuarios</a></li>
                        <?php endif; ?>

                        <li><a href="<?php echo e(route('Users.edit', Auth::user() )); ?>">Mis datos</a></li>

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <?php echo e(Auth::user()->name1); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">

                                <li>
                                    <a href="<?php echo e(route('logout')); ?>"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Salir
                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo e(csrf_field()); ?>


                                </form>

                            </li>

                        </ul>

                    </li>

                    <?php endif; ?>

                </ul>

            </div>

        </div>

    </nav>

    <?php echo $__env->yieldContent('content'); ?>

</div>

<!-- Scripts -->
<!-- <script src="<?php echo e(asset('js/app.js')); ?>"></script>
 --><script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('bootstrap-3.3.7-dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/funciones.js')); ?>"></script>

</body>

</html>
