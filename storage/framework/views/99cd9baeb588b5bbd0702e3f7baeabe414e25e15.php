<?php $__env->startSection('title', 'What we do?'); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">What we do?</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="<?php echo e(route('what.create')); ?>">
                            <i class="md md-add"></i>
                            Add
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Facts</th>
                            <th width="10%">Data</th>
                            <th width="10%">Spirit</th>
                            <th width="10%">Strategy</th>
                            <th width="10%">Advocacy</th>

                        </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $whats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $what): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($what->id); ?></td>
                                <td><?php echo e(str_limit($what->facts, 27)); ?></td>
                                <td><?php echo e(str_limit($what->data, 27)); ?></td>
                                <td><?php echo e(str_limit($what->spirit, 27)); ?></td>
                                <td><?php echo e(str_limit($what->strategy, 27)); ?></td>
                                <td><?php echo e(str_limit($what->advocacy, 27)); ?></td>

                                <td class="text-right">
                                    <a href="<?php echo e(route('what.edit', $what->id)); ?>" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="<?php echo e(route('what.destroy', $what->id)); ?>" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center">No data available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>