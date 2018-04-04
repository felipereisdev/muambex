<?php $__env->startSection('title', 'Listagem de Muambas'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="panel-body">
                    <div class="box-header">
                        <h3 class="box-title">Listagem de Muambas</h3>
    
                        <div class="box-tools">
                            <?php echo e(link_to_route('muambas.form_add', 'Cadastrar', null, ['class' => 'btn btn-primary'])); ?>

                        </div>
                    </div>
                    <hr>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="filtros">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" href="#filtrosCollapse" aria-expanded="true" aria-controls="filtrosCollapse" style="display: block;">
                                    <i class="fa fa-filter" aria-hidden="true"></i> FILTROS
                                </a>
                            </h4>
                        </div>
                        <div id="filtrosCollapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filtros">
                            <div class="panel-body">
                                <form id="form-busca" action="<?php echo e(route('muambas.index')); ?>" method="POST">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            
                                        </div>
                                        <div class="form-group col-md-2">
                                            
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <?php echo e(Form::token()); ?>

                                        <?php echo e(Form::submit('Buscar', ['class' => 'btn btn-default', 'id' => 'btnBuscar'])); ?>

                                    </div>
                                </form>
                                <br />
                                <br />
                            </div>
                        </div>
                    </div>
                
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                            <thead>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th style="width: 10%">Opções</th>
                            </thead>
                            <?php if(isset($muambas) && count($muambas) > 0): ?>
                                <tbody>
                                    <?php $__currentLoopData = $muambas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $muamba): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            <?php else: ?>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-warning" role="alert">
                                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                Nenhuma muamba encontrada
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            <?php endif; ?>
                        </table>
                        <div class="pull-right">
                            <?php echo e($muambas->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/muambas/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>