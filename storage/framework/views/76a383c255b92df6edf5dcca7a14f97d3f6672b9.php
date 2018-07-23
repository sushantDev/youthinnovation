<div class="row" id="projects">
    <div class="col-md-12">
        <article class="parallex-section" style="background-image:url(<?php echo e(asset('images/event6.jpg')); ?>);">
            <div class="container">
                <div class="col-md-3 col-sm-6 col-xs-12 animated" data-animation="flipInX" data-delay="0">
                    <div class="portfolio-left">
                        <header class="heading text-center">
                            <h3>Our Projects</h3>
                        </header>
                        <p class="text-center"></p>
                    </div>
                </div>

<?php $__currentLoopData = $main_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-md-3 col-sm-6 col-xs-12 animated" data-animation="flipInX" data-delay="200">
                    <a href="<?php echo e(url('/yic')); ?>">

                    <div class="portfolio-box">
                        <figure>
                            <img width="150" height="150" src="<?php echo e(asset('images/event1-150x150.jpg')); ?>" class="attachment-thumbnail size-thumbnail wp-post-image" alt=""/>
                            
                                
                                    
                                
                            
                        </figure>
                        <div class="portfolio-detail">
                            <h4><?php echo e($main_project->title); ?></h4>
                            <p style="font-family: Montserrat"><?php echo e(str_limit($main_project->title_description, 250)); ?></p>
                            <a href="<?php echo route('mainproject.show', $main_project); ?>" target="_blank"></a>
                        </div>
                    </div>
                </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                  
                    
                        
                            
                            
                                
                                    
                                
                            
                        
                        
                            
                            
                            
                        
                    
                  
                
                
                   
                    
                        
                            
                            
                                
                                    
                                
                            
                        
                        
                            
                            
                            
                        
                    
                   
            
        </article>
    </div>
</div>
