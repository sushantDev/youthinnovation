<!-- BEGIN MENUBAR-->
<div id="menubar" class="animate">
    <div class="menubar-fixed-panel">
        <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="expanded">
            <a href="<?php echo e(url('/')); ?>">
                <span class="text-lg text-bold text-primary text-uppercase">Bancotec</span>
            </a>
        </div>
    </div>
    <div class="menubar-scroll-panel">
        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">
            <?php $__currentLoopData = $allMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="menu <?php echo e($menu['class'] ?: ''); ?>">
                    <a href="<?php echo e($menu['route']); ?>">
                        <?php if(isset($menu['icon'])): ?>
                            <div class="gui-icon">
                                <i class="<?php echo e($menu['icon']); ?>"></i>
                            </div>
                        <?php else: ?>
                            <div class="gui-icon gui-text">
                                <?php echo e($menu['text']); ?>

                            </div>
                        <?php endif; ?>
                        <span class="title"><?php echo e($menu['title']); ?></span>
                    </a>
                    <?php if(isset($menu['items'])): ?>
                        <ul>
                            <?php $__currentLoopData = $menu['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($item['items'])): ?>
                                    <li class="gui-folder">
                                        <a href="javascript:void(0);">
                                            <span class="title sub"><?php echo e($item['title']); ?></span>
                                        </a>
                                        <ul>
                                            <?php $__currentLoopData = $item['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="<?php echo e($subItem['route']); ?>">
                                                        <span class="title"><?php echo e($subItem['title']); ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <li class="sub-menu">
                                        <a href="<?php echo e($item['route']); ?>">
                                            <span class="title sub"><?php echo e($item['title']); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul><!--end .main-menu -->
        <!-- END MAIN MENU -->
        <div class="menubar-foot-panel">
            <small class="no-linebreak hidden-folded">
                <span class="opacity-75">Copyright &#183; <?php echo e(date('Y')); ?> &#183;</span>
                <strong>
                    <a href="<?php echo e(url('/')); ?>">Bancotec</a>
                </strong>
            </small>
        </div>
    </div><!--end .menubar-scroll-panel-->
</div><!--end #menubar-->
<!-- END MENUBAR -->
