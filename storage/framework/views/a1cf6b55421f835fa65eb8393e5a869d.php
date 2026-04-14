<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success">
   <?php echo e(session('status')); ?>

</div>
<?php endif; ?>
<div class="container-fluid nss_style unit-service-edit">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <span class="rental insert_dates"><a href="<?php echo e(route('home.manage')); ?>">Manage</a> </span> 
        >>
        <span class="rental insert_dates"><a href="<?php echo e(route('services.index')); ?>">View Dates</a> </span>
        >>
        <span class="insert_dates">Edit Date </span>
    </h1>
</div>
<div class="row">
  <div class="col-xl-12 col-md-12 mb-4 service-edit">
    <?php if($errors->has('custom_error')): ?>
    <div class="alert alert-danger">
        <?php echo e($errors->first('custom_error')); ?>

    </div>
    <?php endif; ?>

    <form class="input-form service-add"  method="POST" action="<?php echo e(route('services.update', $service->id)); ?>" enctype="multipart/form-data">
     <?php echo csrf_field(); ?>
     <?php echo method_field('PUT'); ?>

     <?php
     $room_code=get_unit_detail($service->unit)->room_code;
     ?>
    <!-- <div class="row mb-3">
        <label for="unit" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Unit')); ?></label>

        <div class="col-md-6">
         <select id="unit" class="form-control unit_select_bedroom_type_value  <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="unit" required>
            <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($unit->id); ?>" data-id="<?php echo e($unit->bedroom_type); ?>" <?php if( $service->unit == $unit->id): ?> selected <?php endif; ?>><?php echo e($unit->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['unit'];
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
        <label for="bedroom_type" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Bedroom Type')); ?></label>
        <div class="col-md-6">
            <span class="form-control bedroom_type_value"> </span>
        </div>
    </div> -->

    <div class="row mb-3">
        <label for="guest_name" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Guest Name')); ?></label>

        <div class="col-md-6">
            <input id="guest_name" type="text" class="form-control <?php $__errorArgs = ['guest_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="guest_name" value="<?php echo e($service->guest_name); ?>" required>

            <?php $__errorArgs = ['guest_name'];
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
        <label for="arrival_date" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Arrival Date')); ?></label>

        <div class="col-md-6">
         <input id="arrival_date" type="date" class="form-control <?php $__errorArgs = ['arrival_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="arrival_date" value="<?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('Y-m-d')); ?>" required>

         <?php $__errorArgs = ['arrival_date'];
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
    <label for="arrival_date" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Arrival Time')); ?></label>
    <div class="col-6">
        
        <span class="form-control"><?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('H:i:s') !== '00:00:00' ? \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') : ''); ?></span>
    </div>
</div>

<div class="row mb-3">
    <label for="checkin" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Early Check In')); ?></label>
    <div class="col-6">
        <input type="checkbox" class="form-control checkin <?php $__errorArgs = ['checkin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="checkin" value="1" <?php echo e($service->checkin == 1 ? 'checked' : ''); ?>>         

    </div>
</div>

<div class="arrival_time_div" style="display:<?php echo e($service->checkin == 1 ? 'block;' : 'none;'); ?>">
    <div class="row mb-3">
        <label for="arrival_time" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Time')); ?></label>
        <div class="col-md-6">
            

            <select id="arrival_time" name="arrival_time" class="form-control " tabindex="-1" aria-hidden="true" required> 
                <?php $__currentLoopData = insert_checkin_time_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $arrival_time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <option value="<?php echo e($key); ?>" <?php echo e($service->arrival_time == $key ? 'selected' : ''); ?>><?php echo e($arrival_time); ?></option> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <?php $__errorArgs = ['arrival_time'];
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
</div>

<div class="row mb-3">
    <label for="departure_date" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Checkout Date')); ?></label>

    <div class="col-md-6">
        <input id="departure_date" type="date" class="form-control <?php $__errorArgs = ['departure_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="departure_date" value="<?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('Y-m-d')); ?>" required>


        <?php $__errorArgs = ['departure_date'];
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
    <label for="arrival_date" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Checkout Time')); ?></label>
    <div class="col-6">
       
       <span class="form-control"><?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('H:i:s') !== '00:00:00' ? \Carbon\Carbon::parse($service->departure_date)->format('h:i A') : ''); ?></span> 
   </div>
</div>


<div class="row mb-3">
    <label for="checkout" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Late Checkout')); ?></label>
    <div class="col-6">
        <input type="checkbox" class="form-control edit_checkout checkout <?php $__errorArgs = ['checkout'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="checkout" value="1" <?php echo e($service->checkout == 1 ? 'checked' : ''); ?>>         
    </div>
</div>

<div class="departure_time_div" style="display:<?php echo e($service->checkout == 1 ? 'block;' : 'none;'); ?>">
    <div class="row mb-3">
        <label for="departure_time" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Time')); ?></label>
        <div class="col-md-6">
          

          <select id="departure_time" name="departure_time" class="form-control " tabindex="-1" aria-hidden="true" required> 
            <?php $__currentLoopData = insert_checkout_time_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $departure_time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <option value="<?php echo e($key); ?>" <?php echo e($service->departure_time == $key ? 'selected' : ''); ?>><?php echo e($departure_time); ?></option> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <?php $__errorArgs = ['departure_time'];
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
</div>




<div class="row mb-3">
    <label for="room_code" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Room Code')); ?></label>

    <div class="col-md-6">
        <input id="room_code" type="text" class="form-control <?php $__errorArgs = ['room_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="room_code" value="<?php echo e($service->room_code); ?>" <?php if($room_code): ?> required <?php endif; ?>>

        <?php $__errorArgs = ['room_code'];
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

<!-- <div class="row mb-3">
    <label for="b2b" class="col-md-4 col-form-label text-md-end"><?php echo e(__('B/B')); ?></label>
    <div class="col-md-6">
        <input type="checkbox" class="form-control edit_b2b b2b <?php $__errorArgs = ['b2b'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="b2b" value="1" <?php echo e($service->b2b ? 'checked' : ''); ?>>
    </div>
</div> -->

<div class="row mb-3">
    <label for="notes" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Notes')); ?></label>
    <div class="col-md-6">
        <textarea id="notes" class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="notes"><?php echo e($service->notes); ?></textarea>

        <?php $__errorArgs = ['notes'];
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
  <label class="col-md-4 col-form-label text-md-end"><?php echo e(__('Cleaner')); ?></label>
  <div class="col-md-6">
    <select id="cleaner" name="cleaner" class="form-control " tabindex="-1" aria-hidden="true"> 
        <option value="">Select Cleaner</option> 
        <?php $__currentLoopData = $user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <option value="<?php echo e($user->id); ?>" <?php if($service->cleaner == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name); ?></option> 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
</div>

<?php if($service->b2b == 1): ?>
<div class="row mb-3">
  <label class="col-md-4 col-form-label text-md-end"><?php echo e(__('Cleaner Carry Over Date')); ?></label>
  <div class="col-md-6">
    <?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('F d')); ?>

</div>
</div>
<?php else: ?>
<div class="row mb-3">
  <label class="col-md-4 col-form-label text-md-end"><?php echo e(__('Cleaner Carry Over Date')); ?></label>
  <div class="col-md-6">
    <input type="date" class="form-control carry_over_date <?php $__errorArgs = ['carry_over_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="carry_over_date" value="<?php echo e($service->carry_over_date); ?>">
</div>
</div>
<?php endif; ?>




<div class="row mb-3">
    <label class="col-md-4 col-form-label text-md-end">

    </label>
    <div class="col-md-6 offset-md-4">
        <a href="<?php echo e(route('services.index')); ?>" class="btn btn-primary"><?php echo e(__('Go Back')); ?></a>
        <button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>
    </div>
</div>
</form>







</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/edit_service.blade.php ENDPATH**/ ?>