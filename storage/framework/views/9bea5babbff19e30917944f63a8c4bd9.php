
<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success" role="alert">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>


<div class="container-fluid nss_style">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">              
         <span class="insert_dates">Manage Admins </span>
     </h1>
  </div>
  <div class="d-sm-flex align-items justify-content-between mb-4">
    <div></div>
    <a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary">Insert Admin</a>
</div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="service-table"> 
            <table class="table thead-dark table-striped ">
                <tr>
                    <th>Name Testing</th>
                    <th>Email</th>
                    <th>Role</th>
                    
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->role); ?></td>
                    
                    <td><?php echo e(date('d F Y, h:i:s A', strtotime($user->created_at))); ?></td>
                    <td class="action"> <a href="<?php echo e(route('user.edit',$user->id)); ?>" class="btn btn-success btn-sm"><i class="fas fa-pen"></i></a>
                       <form method="post" action="<?php echo e(route('user.destroy',$user->id)); ?>">
                        <?php echo method_field('delete'); ?>
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger btn-sm mb-1"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
        <?php echo $users->links(); ?>

    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/users_admin.blade.php ENDPATH**/ ?>