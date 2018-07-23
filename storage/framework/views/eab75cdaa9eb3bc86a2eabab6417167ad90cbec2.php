<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Meta Tags -->
    <meta name="description" content="">
    <meta name="author" content="Sijan Bhattarai">

    <!-- Title-->
    <title>Youth</title>

    <!-- Styles -->
    <link href="//fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/materialadmin-bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/materialadmin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/material-design-iconic-font.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/libs/toastr/toastr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/app.css')); ?>">

    <!-- Page Level Styles -->
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="menubar-hoverable header-fixed menubar-pin">
    <?php if(auth()->guest()): ?>
        <?php echo $__env->yieldContent('guest'); ?>
    <?php else: ?>
        <!-- BEGIN HEADER -->
        <?php echo $__env->make('backend.layouts.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- END HEADER -->
        <!-- BEGIN BASE-->
        <div id="base">
            <div id="content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <?php echo $__env->make('backend.layouts.partials.menubar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <!-- END BASE -->
    <?php endif; ?>

    <!-- Global Script For Setting Session Messages and Active URL -->
    <?php echo $__env->make('backend.layouts.partials.global-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- Scripts -->
    <script src="<?php echo e(asset('backend/js/libs/jquery/jquery-1.11.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/libs/jquery/jquery-migrate-1.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/libs/bootstrap/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/libs/spin.js/spin.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/libs/autosize/jquery.autosize.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/libs/bootbox/bootbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/libs/toastr/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/libs/nanoscroller/jquery.nanoscroller.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/core/source/App.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/core/source/AppNavigation.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/core/source/AppCard.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/core/source/AppForm.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/core/source/AppVendor.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/core/source/AppToast.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/core/source/AppBootBox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/app.js')); ?>"></script>

    <!-- Page Level Scripts -->
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
