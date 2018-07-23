<div class="row">
    <div class="col-md-12">
        <?php echo $__env->make('partials.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-head">
                <header><?php echo $header; ?></header>
                <div class="tools visible-xs">
                    <a class="btn btn-default btn-ink" onclick="history.go(-1);return false;">
                        <i class="md md-arrow-back"></i>
                        Back
                    </a>
                    <input type="submit" name="draft" class="btn btn-info ink-reaction" value="Save Draft">
                    <input type="submit" name="publish" class="btn btn-primary ink-reaction" value="Publish">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php echo e(Form::text('title',old('title'),['class'=>'form-control', 'required'])); ?>

                            <?php echo e(Form::label('title','Title*')); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php echo e(Form::text('quote',old('quote'),['class'=>'form-control', 'required'])); ?>

                            <?php echo e(Form::label('quote','Quote*')); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php echo e(Form::text('author',old('author'),['class'=>'form-control', 'rows'=>2])); ?>

                            <?php echo e(Form::label('author','author*')); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php echo e(Form::textarea('type',old('type'),['class'=>'form-control', 'rows'=>2])); ?>

                            <?php echo e(Form::label('type','Article Type*')); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php echo e(Form::textarea('body',old('body'),['class'=>'form-control', 'rows'=>2])); ?>

                            <?php echo e(Form::label('body','News Body*')); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label class="text-default-light">News Image</label>
                        <?php if(isset($news) && $news->image): ?>
                            <input type="file" name="image" class="dropify" data-default-file="<?php echo e(asset($news->image->thumbnail(260,198))); ?>"/>
                        <?php else: ?>
                            <input type="file" name="image" class="dropify"/>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            </div>
            <div class="card-actionbar">
                <div class="card-actionbar-row">
                    <button type="reset" class="btn btn-default ink-reaction">Reset</button>
                    <input type="submit" name="draft" class="btn btn-info ink-reaction" value="Save Draft">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-affix affix-4">
            <div class="card-head">
                <div class="tools">
                    <a class="btn btn-default btn-ink" href="<?php echo e(route('project.index')); ?>">
                        <i class="md md-arrow-back"></i>
                        Back
                    </a>
                </div>
            </div>
            <?php echo e(Form::hidden('view', old('view'))); ?>

            <div class="card-body">
                <div class="row">
                    <div class="col-xs-6 col-sm-12">
                    </div>
                    <div class="col-xs-6 col-sm-12">
                        <div class="checkbox checkbox-styled">
                            <label>
                                <?php echo e(Form::checkbox('is_featured', 1, old('is_featured'))); ?>

                                <span>Feature this Project in Home Page</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-actionbar">
                <div class="card-actionbar-row">
                    <button type="reset" class="btn btn-default ink-reaction">Reset</button>
                    <input type="submit" name="draft" class="btn btn-info ink-reaction" value="Save Draft">
                    <input type="submit" name="publish" class="btn btn-primary ink-reaction" value="<?php echo e(isset($news) && $news->is_published ? 'Save' : 'Publish'); ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('backend/css/libs/dropify/dropify.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/css/bootstrap-select.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('backend/js/libs/jquery-validation/dist/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/libs/jquery-validation/dist/additional-methods.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/libs/dropify/dropify.min.js')); ?>"></script>
<script src="<?php echo e(asset('/backend/js/bootstrap-select.js')); ?>"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('my-editor', {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=<?php echo e(csrf_token()); ?>',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=<?php echo e(csrf_token()); ?>'
    });
</script>
<?php $__env->stopPush(); ?>