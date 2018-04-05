<?php $__env->startSection('title', 'Gestão Financeira'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Bem Vindo <?php echo e(Auth::user()->name); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="panel-body">
        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>