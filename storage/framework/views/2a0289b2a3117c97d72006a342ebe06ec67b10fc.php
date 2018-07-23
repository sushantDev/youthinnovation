<script>
//Session messages
var successMsg = "<?php echo e(session('success')); ?>";
var infoMsg = "<?php echo e(session('info')); ?>";
var warningMsg = "<?php echo e(session('warning')); ?>";
var dangerMsg = "<?php echo e(session('danger')); ?>";
var errorMsg;
<?php if(count($errors)): ?>
    <?php $allErrors = '<ul>'; ?>

    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $errors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $allErrors .= '<li>'.$errors.'</li>'; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php $allErrors .= '</ul>'; ?>

    var errorMsg = "<?php echo $allErrors; ?>";
<?php endif; ?>

//Active links
var requestUrl = "<?php echo e(request()->url()); ?>";
</script>