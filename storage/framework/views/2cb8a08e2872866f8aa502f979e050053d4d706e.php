<?php $__env->startSection('title', 'Mission'); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <div class="section-body">
            <?php echo e(Form::open(['route' =>'mission.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate'])); ?>

            <?php echo $__env->make('backend.mission.partials.form', ['header' => 'Create an Mission'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo e(Form::close()); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>