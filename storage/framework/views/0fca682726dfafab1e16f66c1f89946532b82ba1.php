<?php $__env->startSection('title', 'How We Work?'); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <div class="section-body">
            <?php echo e(Form::open(['route' =>'how.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate'])); ?>

            <?php echo $__env->make('backend.how.partials.form', ['header' => 'Create how we work'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo e(Form::close()); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>