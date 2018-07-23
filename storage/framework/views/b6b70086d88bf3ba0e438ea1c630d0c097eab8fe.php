<?php if( ! empty($errors->all())): ?>
    <div class="alert alert-callout alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <?php $dumpErrors = []; ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos => $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if( !in_array($error, $dumpErrors) ): ?>
                    <li><?php echo e($error); ?></li>
                    <?php $dumpErrors[] = $error; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php if(session('status')): ?>
    <div class="alert alert-callout alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p><?php echo session('status'); ?></p>
    </div>
<?php endif; ?>