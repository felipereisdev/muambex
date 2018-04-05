<?php $__env->startSection('adminlte_css'); ?>
    <link rel="stylesheet"
          href="<?php echo e(asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')); ?> ">
          
    <link rel="stylesheet"
          href="<?php echo e(asset('css/main.css')); ?> ">
    <?php echo $__env->yieldPushContent('css'); ?>
    <?php echo $__env->yieldContent('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : '')); ?>

<?php $__env->startSection('body'); ?>
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            <?php if(config('adminlte.layout') == 'top-nav'): ?>
            <nav class="navbar navbar-static-top" style="background-color: #00416B;">
                <div class="container">
                    <div class="navbar-header">
                        <a href="<?php echo e(url(config('adminlte.dashboard_url', 'home'))); ?>" class="navbar-brand">
                            <?php echo config('adminlte.logo', '<b>Admin</b>LTE'); ?>

                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <?php echo $__env->renderEach('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item'); ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            <?php else: ?>
            <!-- Logo -->
            <a href="<?php echo e(url(config('adminlte.dashboard_url', '/'))); ?>" class="logo" style="background-color: #00416B;">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><?php echo config('adminlte.logo_mini', '<b>A</b>LT'); ?></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><?php echo config('adminlte.logo', '<b>Admin</b>LTE'); ?></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" style="background-color: #00416B;" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only"><?php echo e(trans('adminlte::adminlte.toggle_navigation')); ?></span>
                </a>
            <?php endif; ?>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li>
                            <?php if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<')): ?>
                                <a href="<?php echo e(url(config('adminlte.logout_url', 'auth/logout'))); ?>">
                                    <i class="fa fa-fw fa-power-off"></i> <?php echo e(trans('adminlte::adminlte.log_out')); ?>

                                </a>
                            <?php else: ?>
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-fw fa-power-off"></i> <?php echo e(trans('adminlte::adminlte.log_out')); ?>

                                </a>
                                <form id="logout-form" action="<?php echo e(url(config('adminlte.logout_url', 'auth/logout'))); ?>" method="POST" style="display: none;">
                                    <?php if(config('adminlte.logout_method')): ?>
                                        <?php echo e(method_field(config('adminlte.logout_method'))); ?>

                                    <?php endif; ?>
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
                <?php if(config('adminlte.layout') == 'top-nav'): ?>
                </div>
                <?php endif; ?>
            </nav>
        </header>

        <?php if(config('adminlte.layout') != 'top-nav'): ?>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar" style="background-color: #fff159;">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <?php echo $__env->renderEach('adminlte::partials.menu-item', $adminlte->menu(), 'item'); ?>
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        <?php endif; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #f7f3f0;">
            <?php if(config('adminlte.layout') == 'top-nav'): ?>
            <div class="container">
            <?php endif; ?>

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <?php echo $__env->yieldContent('content_header'); ?>
            </section>

            <!-- Main content -->
            <section class="content">
                <input type="hidden" id="sweet_alert_title" value="<?php echo e((isset(Session::get('sweet_alert')['title']) && !empty(Session::get('sweet_alert')['title']) ? Session::get('sweet_alert')['title'] : '')); ?>" />
                <input type="hidden" id="sweet_alert_text" value="<?php echo e((isset(Session::get('sweet_alert')['text']) && !empty(Session::get('sweet_alert')['text']) ? Session::get('sweet_alert')['text'] : '')); ?>" />
                <input type="hidden" id="sweet_alert_type" value="<?php echo e((isset(Session::get('sweet_alert')['type']) && !empty(Session::get('sweet_alert')['type']) ? Session::get('sweet_alert')['type'] : '')); ?>" />
                <input type="hidden" id="controller" value="<?php echo e(isset($controller) ? "http://" . $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR . $controller  . DIRECTORY_SEPARATOR : ''); ?>" />
                <?php echo $__env->yieldContent('content'); ?>
            </section>
            <!-- /.content -->
            <?php if(config('adminlte.layout') == 'top-nav'): ?>
            </div>
            <!-- /.container -->
            <?php endif; ?>
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('adminlte_js'); ?>
    <script src="<?php echo e(asset('vendor/adminlte/dist/js/adminlte.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/loading.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('js'); ?>
    <?php echo $__env->yieldContent('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>