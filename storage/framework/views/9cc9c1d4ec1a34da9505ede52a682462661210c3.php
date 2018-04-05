<?php $__env->startSection('title', $content_header); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e($content_header); ?></h3>
        </div>
        <?php echo e(Form::open(['route' => 'usuarios.update', 'id' => 'form_usuario'])); ?>

            <div class="box-body">
                <div class="form-group col-md-6">
                    <?php echo e(Form::label('Nome:', null, ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('name', (isset($usuario->name) && !empty($usuario->name) ? $usuario->name : ''), ['class' => 'form-control', 'id' => 'name'])); ?>

                </div>

                <div class="form-group col-md-6">
                    <?php echo e(Form::label('Email:', null, ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('email', (isset($usuario->email) && !empty($usuario->email) ? $usuario->email : ''), ['class' => 'form-control', 'id' => 'email', 'readonly' => true])); ?>

                </div>

                <div class="form-group col-md-6">
                    <?php echo e(Form::label('Senha:', null, ['class' => 'control-label'])); ?>

                    <?php echo e(Form::password('password', ['class' => 'form-control'])); ?>

                </div>
            </div>

            <div class="box-footer">
                <input type="hidden" name="id" value="<?php echo e((isset($usuario->id) && !empty($usuario->id) ? $usuario->id : '')); ?>" />
                <?php echo e(Form::submit('Salvar', ['class' => 'btn btn-primary'])); ?>

                <?php echo e(link_to_route('muambas.index', 'Cancelar', null, ['class' => 'btn btn-warning'])); ?>

            </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/usuarios/form.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>