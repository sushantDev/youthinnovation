<?php $__env->startSection('title', 'What we do'); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <div class="section-body">
            <?php echo e(Form::open(['route' =>'what.store','class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate'])); ?>

            <?php echo $__env->make('backend.what.partials.form', ['header' => 'Create what we do'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo e(Form::close()); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>