<?php $__env->startSection('title', 'Registrarme - Reenev'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Date de alta en Reenev</h1></div>
                <div class="panel-body">
                    <form onsubmit="return validarCampos();" class="form-horizontal" role="form" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('name1') ? ' has-error' : ''); ?>">
                            <label for="name1" class="col-md-4 control-label">Primer nombre</label>

                            <div class="col-md-6">
                                <input id="name1" type="text" class="form-control" name="name1" value="<?php echo e(old('name1')); ?>" placeholder="Juan" required autofocus>

                                <?php if($errors->has('name1')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('name1')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('name2') ? ' has-error' : ''); ?>">
                            <label for="name2" class="col-md-4 control-label">Segundo Nombre</label>

                            <div class="col-md-6">
                                <input id="name2" type="text" class="form-control" name="name2" value="<?php echo e(old('name2')); ?>" placeholder="José" required>

                                <?php if($errors->has('name2')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('name2')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('apellido1') ? ' has-error' : ''); ?>">
                            <label for="apellido1" class="col-md-4 control-label">Primer apellido</label>

                            <div class="col-md-6">
                                <input id="apellido1" type="text" class="form-control" name="apellido1" value="<?php echo e(old('apellido1')); ?>" placeholder="Perez" required>

                                <?php if($errors->has('apellido1')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('apellido1')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('apellido2') ? ' has-error' : ''); ?>">
                            <label for="apellido2" class="col-md-4 control-label">Segundo apellido</label>

                            <div class="col-md-6">

                                <input id="apellido2" type="text" class="form-control" name="apellido2" value="<?php echo e(old('apellido2')); ?>" placeholder="Rodriguez" required>

                                <?php if($errors->has('apellido2')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('apellido2')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('nacimiento') ? ' has-error' : ''); ?>">
                            <label for="nacimiento" class="col-md-4 control-label">Fecha de Nacimiento</label>

                            <div class="col-md-6">
                                <input id="nacimiento" type="fecha" class="form-control" name="nacimiento" value="<?php echo e(old('nacimiento')); ?>" required>

                                <?php if($errors->has('nacimiento')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('nacimiento')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('generacion') ? ' has-error' : ''); ?>">
                            <label for="generacion" class="col-md-4 control-label">Generacion</label>

                            <div class="col-md-6">
                                <select id="generacion" name=generacion class="form-control" required>
                                </select>

                                <?php if($errors->has('generacion')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('generacion')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('ci') ? ' has-error' : ''); ?>">
                            <label for="ci" class="col-md-4 control-label">Cedula</label>

                            <div class="col-md-6">
                                <input id="ci" type="cedula" class="form-control" name="ci" value="<?php echo e(old('ci')); ?>" placeholder="0.000.000-0" required>

                                <?php if($errors->has('ci')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('ci')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Correo</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="ejemplo@mail.com" required>

                                <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="******" required>

                                <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmacion</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="******" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrarme
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>