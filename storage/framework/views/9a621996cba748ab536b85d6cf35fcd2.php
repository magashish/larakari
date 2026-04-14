<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success">
   <?php echo e(session('status')); ?>

</div>
<?php endif; ?>

<?php echo $__env->make('breadcrumb.owner_breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container-fluid nss_style add-service-date">  

   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><span class="rental">Rental Info </span> >> <span class="insert_dates">Insert Dates </span></h1>
      <p>We take care of everything necessary to ensure rooms are ready for occupancy. With over a decade of experience in hotel rental vacation rooms, our
      certified cleaners and maintenance professionals take pride in providing expert service to sustain an enjoyable environment for your guests.</p>
  </div>

  <?php if(!isset($id)): ?>

  <div class="row">
      <div class="col-xl-12 col-md-12 mb-4">
        <div class="row mb-3">
            <div class="col-md-4 col-form-label text-md-end  offset-md-4">
                <label for="unit_type" class="col-form-label text-md-end"><?php echo e(__('Select The Unit # to Insert Dates')); ?></label>
                <select id="unit_type" class="form-control">
                    <option value="">Select Unit #</option>
                    <?php $__currentLoopData = unit_type_owner_array(auth()->user()->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e(route('owner.owner_create_date', $value->id)); ?>" ><?php echo e($value->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

        </div>
    </div>
</div>
<?php else: ?>

<?php
    $data = get_unit_detail($id);
    $room_code = $data->room_code; 
    $checkinTime = get_unit_detail($id)->checkin;
    $checkoutTime =get_unit_detail($id)->checkout;
?>

<div class="row">
    <div class="col-xl-12 col-md-12 mb-4" id="message">     
    </div>
    <div class="col-xl-12 col-md-12 mb-4 unit_title">
        <div class="row mb-3">
            <div class="col-md-12 col-form-label text-md-end">
                <label for="unit_type" class="col-form-label text-md-end"><?php echo e(__('Unit #:')); ?>  <span class="unit_id"><?php echo e(get_unit_detail($id)->name); ?></span></label>           
            </div>

        </div>
    </div>
</div>


<div class="row mobile_section d-md-none">
  <div class="col-xl-12 col-md-12 mb-4 mobile_service_section">
    <form id="service_form_mobile" class="input-form user-add"  method="POST" action="<?php echo e(route('owner-services.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> 
        <div class="rental_dates_div"> 
            <div class="rental_dates mt-4 rental_date_1"> 
                <div class="row mb-3 service_minus_div" style="display:none;">
                    <label for="notes" class="col-6 col-md-4 col-form-label text-md-end"></label>
                    <div class="col-6 text-end">  
                       <span class="service_minus btn btn-danger btn-circle" ><i class="fa fa-minus" aria-hidden="true"></i></span>                    
                   </div>
               </div>
               <div class="row mb-3" style="display:none;">
                <label for="unit" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Unit')); ?></label>
                <div class="col-6">
                    <input  type="number" class="copy_value form-control <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][unit]" value="<?php echo e($id); ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <label for="guest_name" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Guest Name')); ?></label>
                <div class="col-6">
                    <input  type="text" class="form-control <?php $__errorArgs = ['guest_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][guest_name]" value="<?php echo e(old('guest_name')); ?>" required>

                </div>
            </div>

            <div class="row mb-3">
                <label for="arrival_date" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Arrival Date')); ?></label>
                <div class="col-6">
                    <input  type="date" class="form-control arrival_date <?php $__errorArgs = ['arrival_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][arrival_date]" value="<?php echo e(old('arrival_date')); ?>" required onkeydown="return false;">

                </div>
            </div>
            <div class="row mb-3">
                <label for="arrival_date" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Arrival Time')); ?></label>
                <div class="col-6">
                 <span class="form-control-data"><?php echo e(date('h:i A', strtotime(get_unit_detail($id)->checkin))); ?></span>                         
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
unset($__errorArgs, $__bag); ?>" name="service[1][checkin]" value="1">            
            </div>
        </div>

        <div class="arrival_time_div">
            <div class="row mb-3">
                <label for="arrival_time" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Time')); ?></label>
                <div class="col-6">
                    <!-- <input  type="time" class="arrival_time form-control <?php $__errorArgs = ['arrival_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][arrival_time]" value="<?php echo e(old('arrival_time')); ?>">                         -->

                <select class="arrival_time form-control <?php $__errorArgs = ['arrival_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][arrival_time]" tabindex="-1" aria-hidden="true"> 
                    <?php $__currentLoopData = insert_checkin_time_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $arrival_time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <option value="<?php echo e($key); ?>"  <?php echo e($checkinTime === $key ? 'selected' : ''); ?>><?php echo e($arrival_time); ?></option> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select> 

                </div>
            </div>
        </div>


        <div class="row mb-3">
            <label for="departure_date" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Checkout Date')); ?></label>
            <div class="col-6">
                <input  type="date" class="form-control departure_date <?php $__errorArgs = ['departure_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][departure_date]" value="<?php echo e(old('departure_date')); ?>" required onkeydown="return false;">

            </div>
        </div>

        <div class="row mb-3">
            <label for="arrival_date" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Checkout Time')); ?></label>
            <div class="col-6">
             <span class="form-control-data"><?php echo e(date('h:i A', strtotime(get_unit_detail($id)->checkout))); ?></span>                         
         </div>
     </div>


     <div class="row mb-3">
        <label for="checkout" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Late Checkout')); ?></label>
        <div class="col-6">
            <input type="checkbox" class="form-control checkout <?php $__errorArgs = ['checkout'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][checkout]" value="1">         
        </div>
    </div>

    <div class="departure_time_div">
        <div class="row mb-3">
            <label for="departure_time" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Time')); ?></label>
            <div class="col-6">
                <!-- <input  type="time" class="departure_time form-control <?php $__errorArgs = ['departure_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][departure_time]" value="<?php echo e(old('departure_time')); ?>"> -->         

                <select class="form-control departure_time <?php $__errorArgs = ['departure_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][departure_time]" tabindex="-1" aria-hidden="true"> 
                    <?php $__currentLoopData = insert_checkout_time_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $departure_time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <option value="<?php echo e($key); ?>"  <?php echo e($checkoutTime === $key ? 'selected' : ''); ?>><?php echo e($departure_time); ?></option> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

            </div>
        </div>
    </div>

    <!-- <div class="row mb-3">
        <label for="b2b" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('B/B')); ?></label>
        <div class="col-6">
            <input type="checkbox" class="form-control b2b <?php $__errorArgs = ['b2b'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][b2b]" value="1">
        </div>
    </div> -->


    <div class="row mb-3">
        <label for="room_code" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Room Code')); ?></label>
        <div class="col-6">
            <input  type="text" class="form-control <?php $__errorArgs = ['room_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][room_code]" value="<?php echo e(old('room_code')); ?>"  <?php if($room_code): ?> required <?php endif; ?>>

        </div>
    </div>

    <div class="row mb-3">
        <label for="notes" class="col-6 col-md-4 col-form-label text-md-end"><?php echo e(__('Notes')); ?></label>
        <div class="col-6">
            <textarea class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][notes]"><?php echo e(old('notes')); ?></textarea>

        </div>
    </div> 


</div>
</div>


<div class="row mb-3">
    <label for="notes" class="col-6 col-md-4 col-form-label text-md-end">
        <span id="service_add_more" newIndex="1" class="btn  btn-circle"><i class="fa fa-plus" aria-hidden="true"></i></span>
    </label>
    <div class="col-6 mb-3">
        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
    </div>
</div>
</form>
</div>
</div>



<div class="row desktop_section d-none d-md-block">
  <div class="col-xl-12 col-md-12 mb-4">
     <form id="service_form" class="input-form user-add"  method="POST" action="<?php echo e(route('owner-services.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="add-service-table"> 
            <div class="service-table-div"> 
                <table class="services_table date_services_table">
                  <thead>
                   <tr>
                    <th style="display: none"><?php echo e(__('Unit')); ?></th>
                    <th><?php echo e(__('Guest Name')); ?></th>
                    <th><?php echo e(__('Arrival Date')); ?></th>
                    <th><?php echo e(__('Arrival Time')); ?></th>
                    <th><?php echo e(__('Early Check In')); ?></th>
                    <th><?php echo e(__('Time')); ?></th>
                    <th><?php echo e(__('Checkout Date')); ?></th>
                    <th><?php echo e(__('Checkout Time')); ?></th>
                    <th><?php echo e(__('Late Checkout')); ?></th>
                    <th><?php echo e(__('Time')); ?></th>
                    <th><?php echo e(__('Room Code')); ?></th>
                    <!-- <th><?php echo e(__('B/B')); ?></th> -->
                    <th><?php echo e(__('Notes')); ?></th>
                    <th><?php echo e(__('')); ?></th>
                </tr>
            </thead>
            <tbody>               
                <tr class="clone_tr unit_item_1">
                 <td style="display:none;">  
                     <input type="number" class="form-control copy_value" name="service[1][unit]" value="<?php echo e($id); ?>" readonly> 

                 </td>

                 <td>
                    <input type="text" class="form-control guest_name <?php $__errorArgs = ['guest_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][guest_name]" value="<?php echo e(old('guest_name')); ?>" required>
                </td>
                <td>
                    <input  type="date" class="form-control arrival_date <?php $__errorArgs = ['arrival_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][arrival_date]" value="<?php echo e(old('arrival_date')); ?>" required onkeydown="return false;">
                </td>

                <td>
                 <span class="form-control-data"><?php echo e(date('h:i A', strtotime(get_unit_detail($id)->checkin))); ?></span> 
             </td>

             <td>
                <input type="checkbox" class="form-control checkin <?php $__errorArgs = ['checkin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][checkin]" value="1">
            </td>

            <td>
                <!-- <input type="time" class="form-control arrival_time <?php $__errorArgs = ['arrival_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][arrival_time]" value="<?php echo e(old('arrival_time')); ?>"> -->
            <select class="form-control arrival_time <?php $__errorArgs = ['arrival_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][arrival_time]" tabindex="-1" aria-hidden="true"> 
                    <?php $__currentLoopData = insert_checkin_time_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $arrival_time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <option value="<?php echo e($key); ?>" <?php echo e($checkinTime == $key ? 'selected' : ''); ?>><?php echo e($arrival_time); ?></option> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select> 
            </td>
            <td>
                <input type="date" class="form-control departure_date <?php $__errorArgs = ['departure_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][departure_date]" value="<?php echo e(old('departure_date')); ?>" required onkeydown="return false;">
            </td>

            <td>
             <span class="form-control-data"><?php echo e(date('h:i A', strtotime(get_unit_detail($id)->checkout))); ?></span> 
         </td>

         <td>
            <input type="checkbox" class="form-control checkout <?php $__errorArgs = ['checkout'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][checkout]" value="1">
        </td>

        <td>
            <!-- <input type="time" class="form-control departure_time <?php $__errorArgs = ['departure_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][departure_time]" value="<?php echo e(old('departure_time')); ?>"> -->

            <select class="form-control departure_time <?php $__errorArgs = ['departure_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][departure_time]" tabindex="-1" aria-hidden="true"> 
                    <?php $__currentLoopData = insert_checkout_time_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $departure_time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <option value="<?php echo e($key); ?>" <?php echo e($checkoutTime == $key ? 'selected' : ''); ?>><?php echo e($departure_time); ?></option> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

        </td>
        <td>
            <input type="text" class="form-control  room_code <?php $__errorArgs = ['room_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][room_code]" value="<?php echo e(old('room_code')); ?>" <?php if($room_code): ?> required <?php endif; ?>>
        </td>

        <!-- <td>
            <input type="checkbox" class="form-control b2b <?php $__errorArgs = ['b2b'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][b2b]" value="1">
        </td> -->

        <td>
            <textarea class="form-control notes <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="service[1][notes]"><?php echo e(old('notes')); ?></textarea>
        </td>
        <td class="service_minus_more_tr" style="display:none">
         <span class="service_minus_more" ><i class="fa fa-minus" aria-hidden="true"></i></span>
     </td>

 </tr>
</tbody>
</table>
</div>
</div>
<div class="service_add_more_div">
    <span class="service_add_more_tr" newIndex="1" class="btn btn-danger btn-circle"><i class="fa fa-plus" aria-hidden="true"></i></span>
    <span>Click on + to enter more dates</span>        
</div>
<div class="col-md-12">
    <div class="col-md-12 col-form-label text-right">
       <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
   </div>
</div>
</form>
</div>
</div>
<?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/owner/add_service.blade.php ENDPATH**/ ?>