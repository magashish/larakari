<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success">
 <?php echo e(session('status')); ?>

</div>
<?php endif; ?>
<div class="container-fluid nss_style">
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">
    <span class="rental insert_dates"><a href="<?php echo e(route('home.manage')); ?>">Manage</a> </span> 
    >>
    <span class="rental insert_dates"><a href="<?php echo e(route('user.usercleaner')); ?>">Cleaners</a> </span>
    >>
    Insert Cleaner
  </h1>
</div>
<div class="row">
  <div class="col-xl-12 col-md-12 mb-4 user-add-cleaner">
   <form class="input-form user-add"  method="POST" action="<?php echo e(isset($user) ? route('user.update', $user->id) : route('user.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <input type="text" name="check" value="cleaner" readonly style="display: none;">
    <input type="text" name="role" value="cleaner" readonly style="display: none;">
      
  <div class="row mb-3">
    <label for="name" class="col-md-2 col-form-label text-md-end"><?php echo e(__('Name')); ?></label>
    <div class="col-md-10">
      <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>
      <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <span class="invalid-feedback" role="alert">
        <strong><?php echo e($message); ?></strong>
      </span>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
  </div>
  <div class="row mb-3">
    <label for="email" class="col-md-2 col-form-label text-md-end"><?php echo e(__('Email')); ?></label>
    <div class="col-md-10">
      <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
      <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <span class="invalid-feedback" role="alert">
        <strong><?php echo e($message); ?></strong>
      </span>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
  </div>
    <div class="row mb-3">
    <label for="phone" class="col-md-2 col-form-label text-md-end"><?php echo e(__('Phone')); ?></label>
    <div class="col-md-10">
      <input id="phone" type="phone" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone" value="<?php echo e(old('phone')); ?>" required autocomplete="phone">
      <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <span class="invalid-feedback" role="alert">
        <strong><?php echo e($message); ?></strong>
      </span>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
  </div>
   





  

  <div class="row mb-3">
    <label for="status" class="col-md-2 col-form-label text-md-end"><?php echo e(__('Status')); ?></label>
    <div class="col-md-10">
      <select id="status" name="status" class="form-control " tabindex="-1" aria-hidden="true"> 
        <?php $__currentLoopData = cleaner_status_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <option value="<?php echo e($key); ?>"><?php echo e($status); ?></option> 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <span class="invalid-feedback" role="alert">
        <strong><?php echo e($message); ?></strong>
      </span>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
  </div>




  <div class="row mb-0">
    <div class="col-md-10 offset-md-4">
      <button type="submit" class="btn btn-primary"><?php echo e(__('Insert')); ?></button>
    </div>
  </div>


</form>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/add_cleaner_user.blade.php ENDPATH**/ ?>