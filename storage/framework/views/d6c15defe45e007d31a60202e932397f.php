<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <?php echo $__env->make('includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body id="page-top" class="<?php echo $__env->yieldContent('class'); ?> <?php echo e(auth()->check() ? 'logged-in' : 'logged-out'); ?>">
    <div id="wrapper">
         <?php if(Route::current()->getName()!='login'  AND Route::current()->getName()!='register' AND Route::current()->getName()!='password.reset' AND Route::current()->getName()!='password.request'): ?>
         <?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <?php else: ?>
         <?php echo $__env->make('includes.logout-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <?php endif; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <div id="app">
                    <?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
            <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</body>
</html><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/layouts/app.blade.php ENDPATH**/ ?>