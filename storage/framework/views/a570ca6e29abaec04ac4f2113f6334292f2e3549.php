<?php $__env->startSection('title', 'News'); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">All News</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="<?php echo e(route('project.create')); ?>">
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
                            <th width="10%">Title</th>
                            <th width="10%" class="text-center">Author</th>
                            <th width="10%" class="text-center">Title</th>
                            <th width="10%" class="text-center">Type</th>
                            <th width="15%" class="text-center">Quote</th>
                            <th width="15%" class="text-center">body</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($news->id); ?></td>
                                <td><?php echo e(str_limit($news->title, 27)); ?></td>
                                <td class="text-center"><?php echo e(str_limit($news->author, 15)); ?></td>
                                <td class="text-center"><?php echo e(str_limit($news->title, 15)); ?></td>
                                <td class="text-center"><?php echo e(str_limit($news->type, 15)); ?></td>
                                <td class="text-center"><?php echo e(str_limit($news->quote, 15)); ?></td>
                                <td class="text-center"><?php echo e(str_limit($news->body, 15)); ?></td>
                                <td class="text-right">
                                    <a href="<?php echo e(route('project.edit', $news->id)); ?>" class="btn btn-flat btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <button type="button" data-url="<?php echo e(route('project.destroy', $news->id)); ?>" class="btn btn-flat btn-primary btn-xs item-delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center">No News available.</td>
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