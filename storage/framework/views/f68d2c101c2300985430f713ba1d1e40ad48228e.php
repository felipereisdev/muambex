<?php $__env->startSection('title', 'Listagem de Usuários'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="panel-body">
                    <div class="box-header">
                        <h3 class="box-title">Listagem de Usuários</h3>
                    </div>
                    <hr>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                            <thead>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th style="width: 10%">Opções</th>
                            </thead>
                            <?php if(isset($usuarios) && count($usuarios) > 0): ?>
                                <tbody>
                                    <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($usuario->name); ?></td>
                                            <td><?php echo e($usuario->email); ?></td>
                                            <td>
                                                <span class="badge <?php echo e(($usuario->fl_ativo) ? 'bg-green' : 'bg-red'); ?>"><?php echo e(($usuario->fl_ativo) ? 'ATIVO' : 'INATIVO'); ?></span>
                                            </td>
                                            <td>
                                                <?php echo e(link_to_route('usuarios.form_edit', '', [$usuario->id], ['class' => 'btn btn-sm btn-warning glyphicon glyphicon-edit', 'title' => 'Alterar', 'data-toggle' => 'tooltip', 'data-placement' => 'top'])); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            <?php else: ?>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-warning" role="alert">
                                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                Nenhum usuário encontrado
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            <?php endif; ?>
                        </table>
                        <div class="pull-right">
                            <?php echo e($usuarios->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/usuarios/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>