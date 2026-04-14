
<form class="input-form service-add"  method="POST" action="<?php echo e(route('services.update', $service->id)); ?>" enctype="multipart/form-data">
 <?php echo csrf_field(); ?>
 <?php echo method_field('PUT'); ?>
 <input type="hidden" name="check" value="assigncleaner">
 <div class="row mb-3">
    <label for="unit" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Unit#')); ?></label>
    <div class="col-md-6">
        <span class="form-control-span"><?php echo e($service->unit); ?></span>         
    </div>
</div>

<div class="row mb-3">
    <label for="bed_type" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Bedroom Type')); ?></label>
    <div class="col-md-6">           
      <span class="form-control-span"><?php echo e(get_unit_detail($service->unit)->bedroom_type); ?></span> 
  </div>
</div>
<div class="row mb-3">
    <label for="guest_name" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Guest Name')); ?></label>
    <div class="col-md-8">
        <span class="form-control-span"><?php echo e($service->guest_name); ?></span> 
    </div>
</div>
<div class="row mb-3">
    <label for="arrival_date" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Arrival Date')); ?></label>

    <div class="col-md-8">
       <span class="form-control-span"><?php echo e($service->arrival_date); ?></span> 
    </div>
</div>

<div class="row mb-3">
    <label for="arrival_time" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Arrival Time')); ?></label>

    <div class="col-md-8">
       <span class="form-control-span"><?php echo e($service->arrival_time); ?></span> 
    </div>
</div>

<div class="row mb-3">
    <label for="departure_date" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Checkout Date')); ?></label>
    <div class="col-md-8">
       <span class="form-control-span"><?php echo e($service->departure_date); ?></span> 
    </div>
</div>

<div class="row mb-3">
    <label for="departure_time" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Checkout Time')); ?></label>
    <div class="col-md-8">
       <span class="form-control-span"><?php echo e($service->departure_time); ?></span> 
    </div>
</div>

<div class="row mb-3">
    <label for="room_code" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Room Code')); ?></label>
    <div class="col-md-8">
        <span class="form-control-span"><?php echo e($service->room_code); ?></span>    
    </div>
</div>
<div class="row mb-3">
    <label for="notes" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Notes')); ?></label>
    <div class="col-md-8">
        <span class="form-control-span"><?php echo e($service->notes); ?></span>    
    </div>
</div>
<div class="row mb-3">
  <label class="col-md-4 col-form-label text-md-end"><?php echo e(__('Runner')); ?></label>
  <div class="col-md-8">
    <select id="runner" name="runner" class="form-control " tabindex="-1" aria-hidden="true" required> 
        <option value="">Select Runner</option>
        <?php $__currentLoopData = $user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <option value="<?php echo e($user->id); ?>" <?php if($service->runner == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name); ?></option> 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
</div>
<div class="row mb-3">
  <label class="col-md-4 col-form-label text-md-end"><?php echo e(__('Cleaner')); ?></label>
  <div class="col-md-8">
    <select id="cleaner" name="cleaner" class="form-control " tabindex="-1" aria-hidden="true" required> 
        <option value="">Select Cleaner</option>
        <?php $__currentLoopData = $user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <option value="<?php echo e($user->id); ?>" <?php if($service->cleaner == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name); ?></option> 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
</div>

<div class="row mb-3">
  <label class="col-md-4 col-form-label text-md-end"><?php echo e(__('Carry Over Date ')); ?></label>
  <div class="col-md-8">
    <input type="date" class="form-control carry_over_date" name="carry_over_date" value="<?php echo e($service->carry_over_date); ?>">
</div>
</div>

<div class="row mb-3">
    <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>
    </div>
</div>
</form>
<?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/unit_assigncleaner.blade.php ENDPATH**/ ?>