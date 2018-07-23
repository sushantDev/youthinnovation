<?php $__env->startSection('title', 'Mission'); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">All Missions</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="<?php echo e(route('mission.create')); ?>">
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
                            <th width="10%">Learn</th>
                            <th width="20%" class="text-center">Connect</th>
                            <th width="20%" class="text">Serve</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $missions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($mission->id); ?></td>
                                <td><?php echo e(str_limit($mission->learn, 27)); ?></td>
                                <td class="text-center"><?php echo e(str_limit($mission->connect, 27)); ?></td>
                                <td><?php echo e(str_limit($mission->serve, 27)); ?></td>

                                <td class="text-right">
                                    <a href="<?php echo e(route('mission.edit', $mission->id)); ?>" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="<?php echo e(route('mission.destroy', $mission->id)); ?>" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center">No missions available.</td>
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