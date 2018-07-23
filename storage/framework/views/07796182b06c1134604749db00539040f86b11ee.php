<?php $__env->startSection('title', 'What we do'); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <div class="section-body">
            <?php echo e(Form::model($what, ['route' =>['what.update', $what->id],'class'=>'form form-validate','role'=>'form', 'files'=>true, 'novalidate'])); ?>

            <?php echo e(method_field('PUT')); ?> <?php echo $__env->make('backend.what.partials.form', ['header' => 'Edit What we do <span class="text-primary">('.str_limit($what->title, 27).')</span>'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo e(Form::close()); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>