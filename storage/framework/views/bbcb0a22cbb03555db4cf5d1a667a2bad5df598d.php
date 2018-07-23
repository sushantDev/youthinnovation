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
                            <?php echo e(Form::text('learn',old('learn'),['class'=>'form-control', 'required'])); ?>

                            <?php echo e(Form::label('learn','Learn*')); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php echo e(Form::text('connect',old('connect'),['class'=>'form-control', 'required'])); ?>

                            <?php echo e(Form::label('connect','Connect*')); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?php echo e(Form::text('serve',old('serve'),['class'=>'form-control', 'required'])); ?>

                            <?php echo e(Form::label('serve','Serve*')); ?>

                        </div>
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
<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('backend/css/libs/dropify/dropify.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/css/bootstrap-select.min.css')); ?>">
<?php $__env->stopPush(); ?>

