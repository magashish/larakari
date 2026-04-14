<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success" role="alert">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>
<div class="container-fluid nss_style dashboard">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><span class="rental">Manage </span></h1>
  </div>


  <div class="row">
    <div class="col-xl-4 col-md-6 mb-4 manage_box">
        <div class="card py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h2 class="text-xs font-weight-bold">Rental Dates</h2>
                        <ul class="manage_ul">
                            <li><a href="<?php echo e(route('services.index')); ?>">View Dates</a></li>
                            <li><a href="<?php echo e(route('services.create')); ?>">Insert Dates</a></li>
                            <li><a href="<?php echo e(route('services.services_calendar')); ?>">Calendar</a></li>
                        </ul>
                        <a href="<?php echo e(route('services.index')); ?>" class="btn btn-success btn-icon-split"> <span class="text">Manage</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4 manage_box">
        <div class="card py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h2 class="text-xs font-weight-bold">Owners</h2>
                        <ul class="manage_ul">
                           <li><a href="<?php echo e(route('user.userowner')); ?>">View Owners</a></li>
                           <li><a href="<?php echo e(route('user.ownercreate')); ?>">Insert Owners</a></li>
                           <li><a href="<?php echo e(route('user.userowner')); ?>">Manage Units</a></li>
                       </ul>
                       <a href="<?php echo e(route('user.userowner')); ?>" class="btn btn-success btn-icon-split"> <span class="text">Manage</span></a>
                   </div>
               </div>
           </div>
       </div>
   </div>

   <div class="col-xl-4 col-md-6 mb-4 manage_box">
    <div class="card py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <h2 class="text-xs font-weight-bold">Cleaners</h2>
                    <ul class="manage_ul">
                       <li><a href="<?php echo e(route('user.usercleaner')); ?>">View Cleaners</a></li>
                       <li><a href="<?php echo e(route('user.cleanercreate')); ?>">Insert Cleaner</a></li>
                       <li><a href="<?php echo e(route('assigncleaner.index')); ?>">Assign Cleaner</a></li>
                   </ul>
                   <a href="<?php echo e(route('user.usercleaner')); ?>" class="btn btn-success btn-icon-split"> <span class="text">Manage</span></a>
               </div>
           </div>
       </div>
   </div>
</div>


</div>





</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/manage.blade.php ENDPATH**/ ?>