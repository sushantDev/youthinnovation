<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="Prashant Thapa">
    <title>Youth Innovation</title>

    <link rel='stylesheet' id='style-css' href='<?php echo e(asset('frontend/stylefe9d.css?ver=4.7.3')); ?>' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='color-css' href='<?php echo e(asset('frontend/css/colorfe9d.css?ver=4.7.3')); ?>' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='prettyPhoto-css' href='<?php echo e(asset('frontend/css/prettyPhotofe9d.css?ver=4.7.3')); ?>'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='responsive-css' href='<?php echo e(asset('frontend/css/responsivefe9d.css?ver=4.7.3')); ?>'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='animate-css' href='<?php echo e(asset('frontend/css/animatefe9d.css?ver=4.7.3')); ?>' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='js_composer_front-css'
          href='<?php echo e(asset('frontend/css/js_composer.min972f.css?ver=5.0.1')); ?>' type='text/css' media='all'/>
    <script type='text/javascript' src='<?php echo e(asset('frontend/js/jquery/jqueryb8ff.js?ver=1.12.4')); ?>'></script>
    <script type='text/javascript' src='<?php echo e(asset('frontend/js/jquery/jquery-migrate.min330a.js?ver=1.4.1')); ?>'></script>
    <script type='text/javascript'
            src='<?php echo e(asset('frontend/js/jquery.themepunch.tools.min4ee1.js?ver=5.3.1.5')); ?>'></script>
    <script type='text/javascript'
            src='<?php echo e(asset('frontend/js/jquery.themepunch.revolution.min4ee1.js?ver=5.3.1.5')); ?>'></script>

    <link rel='stylesheet' id='bootstrap.min-css'
          href=<?php echo e(asset("wp-content/plugins/tbdonations/css/bootstrap.min447e.css?ver=4.7.7")); ?> type='text/css'
          media='all'/>
    <link rel='stylesheet' id='bears_preset-css'
          href=<?php echo e(asset("wp-content/themes/alone/assets/css/presets/default447e.css?ver=4.7.7")); ?> type='text/css'
          media='all'/>


    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<div class="page-wrap">
    <?php echo $__env->make('partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('backend.layouts.partials.global-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>

<link rel='stylesheet' id='vc_google_fonts_montserratregular700-css'
      href='http://fonts.googleapis.com/css?family=Montserrat%3Aregular%2C700&amp;ver=4.7.7' type='text/css'
      media='all'/>

<script type='text/javascript' src='<?php echo e(asset('frontend/js/bootstrap.minfe9d.js?ver=4.7.3')); ?>'></script>
<script type='text/javascript' src='<?php echo e(asset('frontend/js/dscountdown.minfe9d.js?ver=4.7.3')); ?>'></script>
<script type='text/javascript' src='<?php echo e(asset('frontend/js/jquery.appearfe9d.js?ver=4.7.3')); ?>'></script>
<script type='text/javascript' src='<?php echo e(asset('frontend/js/jquery.prettyPhotofe9d.js?ver=4.7.3')); ?>'></script>
<script type='text/javascript'
        src='<?php echo e(asset('frontend/js/jquery.carouFredSel-6.2.1-packedfe9d.js?ver=4.7.3')); ?>'></script>
<script type='text/javascript' src='<?php echo e(asset('frontend/js/scriptfe9d.js?ver=4.7.3')); ?>'></script>
<script type='text/javascript' src='<?php echo e(asset('frontend/js/jflickrfeed.minfe9d.js?ver=4.7.3')); ?>'></script>
<script type='text/javascript' src='<?php echo e(asset('frontend/js/comment-reply.minfe9d.js?ver=4.7.3')); ?>'></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
