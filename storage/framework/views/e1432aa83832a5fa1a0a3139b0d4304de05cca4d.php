<?php $__env->startSection('title', $content_header); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e($content_header); ?></h3>
        </div>
        <?php echo e(Form::open(['route' => (isset($muamba->id) && !empty($muamba->id) ? array('muambas.update', $muamba->id) : 'muambas.store'), 'id' => 'form_muambas'])); ?>

            <?php echo e(method_field('PUT')); ?>

            <div class="box-body">
                <div class="form-group col-md-3">
                    <?php echo e(Form::label('Nome:', null, ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('nome', (isset($muamba->nome) && !empty($muamba->nome) ? $muamba->nome : ''), ['class' => 'form-control', 'id' => 'nome'])); ?>

                </div>

                <div class="form-group col-md-3">
                    <?php echo e(Form::label('Código Rastreio:', null, ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('codigo_rastreio', (isset($muamba->codigo_rastreio) && !empty($muamba->codigo_rastreio) ? $muamba->codigo_rastreio : ''), ['class' => 'form-control', 'id' => 'codigo_rastreio'])); ?>

                </div>
            </div>

            <div class="box-footer">
                <input type="hidden" name="id" value="<?php echo e((isset($muamba->id) && !empty($muamba->id) ? $muamba->id : '')); ?>" />
                <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>" />
                <?php echo Form::button('Salvar', ['class' => 'btn btn-primary', 'id' => 'btn-salvar', 'type' => 'button']); ?>

                <?php echo e(link_to_route('muambas.index', 'Cancelar', null, ['class' => 'btn btn-warning'])); ?>

            </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/muambas/form.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>