<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <div class="section-body">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-bold text-center">Welcome to Youth Innovation AdminPanel.</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>