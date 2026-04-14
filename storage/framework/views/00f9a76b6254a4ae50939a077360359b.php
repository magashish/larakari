
<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success" role="alert">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>
<div class="container-fluid">

    <div class="container-fluid nss_style">
       <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"><span class="insert_dates"><a href="<?php echo e(route('assigncleaner.index')); ?>">Assign Cleaner</a></span></h1> 
     </div>


     <div class="row">
      <div class="col-xl-12 col-md-12 mb-4 col-form-label text-md-end">
        <form class="service-assigncleaner"  action="<?php echo e(route('assigncleaner.index')); ?>" method="GET"  enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-4 offset-md-4 col-form-label text-md-end">
                    <label for="unit_type" class="col-form-label text-md-end"><?php echo e(__('Select The Date to View Cleaner')); ?></label>
                    <input class="form-control" type="date" name="dateInput" id="dateInput" value="<?php echo e($currentDate); ?>">
                    <span class="all_dates"><a href="<?php echo e(route('services.services_assigncleaners')); ?>">View All Assign Cleaner</a></span>
                </div>
                <div class="col-md-6">              
                </div>
            </div>
        </form>

        <?php if($servicesin->isNotEmpty() || $servicesout->isNotEmpty()): ?>
        <span class="print_all_dates"> <a type="button" onclick="printDiv('printableArea')">Print Date</a></span>
        <?php endif; ?>


    </div>
</div>




<div class="col-xl-12 col-md-12 mb-4">
    <div class="date_mobile_section">
        <div>
            <div><strong>C/OUTS</strong></div>
        </div>

        <?php if($servicesout->isNotEmpty()): ?>
        <?php $__currentLoopData = $servicesout; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php    $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); ?>
        <div class="services_date_detail">
          <div class="services_date_name">
            <div class="guest_name">Unit <?php echo e(get_unit_detail($service->unit)->name); ?></div>
            <div><strong> Date </strong> <span class="arrival_departure_date_value"> <?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('F d')); ?></span></div>
            <div><strong>Time Out</strong> <?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->departure_date)->format('h:i A') : '---'); ?></div>
            <div><strong>B/B </strong> <span class="text_red"><?php echo e($service->b2b == 1 ? 'B/B' : ''); ?></span></div>   
        </div>
        <div class="services_date_detail_more"> 
           <div class="services_date_detail_action" style="display: none;"> 
              <div><strong>Old Code</strong> <?php echo e($service->room_code); ?> </div>      
              <div><strong>I.D.</strong> <?php echo e(get_unit_detail($service->unit)->master_code); ?></div>
              
                <?php if($service->b2b == 1): ?>
                <div><strong>New Code</strong> 
                    <?php echo e(assigncleaner_get_new_code($service->id,$service->departure_date,$service->unit,$service->room_code)); ?>

                </div>
               <?php endif; ?>
            
             <div><strong>Bed</strong> <?php if(!empty($unserializedbed_size)): ?>
                <?php echo e(implode(', ', $unserializedbed_size)); ?>

                <?php else: ?>
                No data available
            <?php endif; ?></div>
            <div><strong>Sofa </strong><?php echo e(get_unit_detail($service->unit)->sofa_size); ?></div>
            <div><strong>Notes </strong> <?php echo e($service->notes); ?></div> 
            <div><strong>Created At </strong> <?php echo e(\Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A')); ?></div>     
            <form class="input-form service-edit-mobile"  method="POST" action="<?php echo e(route('services.update', $service->id)); ?>" enctype="multipart/form-data">
               <?php echo csrf_field(); ?>
               <?php echo method_field('PUT'); ?>
               <input type="hidden" name="check" value="assigncleaner">
               <div class="row mb-3">
                <label for="name" class="col-md-2 col-form-label text-md-end"><?php echo e(__('Runner')); ?></label>
                <div class="col-md-10">
                  <select id="runner" name="runner" class="form-control" tabindex="-1" aria-hidden="true">
                    <option value="">Select Runner</option>
                    <?php $__currentLoopData = get_cleaner_Users(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php if($service->runner == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="name" class="col-md-2 col-form-label text-md-end"><?php echo e(__('Cleaner')); ?></label>
            <div class="col-md-10">
               <select id="cleaner" name="cleaner" class="form-control" tabindex="-1" aria-hidden="true">
                <option value="">Select Cleaner</option>
                <?php $__currentLoopData = get_cleaner_Users(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($user->id); ?>" <?php if($service->cleaner == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-md-2 col-form-label text-md-end"><?php echo e(__('   Cleaner Carry Over Date')); ?></label>
        <div class="col-md-10">
            <?php if($service->b2b == 1): ?>
       
        <?php else: ?>
        <input type="date" class="form-control carry_over_date" name="carry_over_date" value="<?php echo e($service->carry_over_date); ?>">
        <?php endif; ?>
           <!-- <input type="date" class="form-control carry_over_date" name="carry_over_date" value="<?php echo e($service->carry_over_date); ?>"> -->
       </div>
   </div>
   <div class="">
       <button type="submit" class="btn btn-success">Save</button>     
   </div> 
</form> 
</div>
<span class="date_detail_more"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<p>No dates are available right now.</p>
<?php endif; ?>

<div>
    <div><strong>C/IN</strong></div>
</div>
<?php if($servicesin->isNotEmpty()): ?>
<?php $__currentLoopData = $servicesin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if(!in_array($service->unit, $services_checkout_ids_array)): ?> 


<?php    $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); ?>
<div class="services_date_detail">
  <div class="services_date_name">
    <div class="guest_name">Unit <?php echo e(get_unit_detail($service->unit)->name); ?></div>
    <div><strong> Date </strong> <span class="arrival_departure_date_value"> <?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('F d')); ?></span></div>
    <div><strong>Time In</strong> <?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') : '---'); ?></div>
</div>
<div class="services_date_detail_more"> 
   <div class="services_date_detail_action" style="display: none;"> 
      <div><strong>I.D.</strong> <?php echo e(get_unit_detail($service->unit)->master_code); ?></div>

      
      <?php if(!in_array($service->unit, $services_checkout_ids_array)): ?> 
      <div ><strong>New Code</strong> 
         <?php echo e($service->room_code); ?> 
     </div>
     <?php endif; ?> 
            

      <div><strong>Bed</strong> <?php if(!empty($unserializedbed_size)): ?>
        <?php echo e(implode(', ', $unserializedbed_size)); ?>

        <?php else: ?>
        No data available
    <?php endif; ?></div>
    <div><strong>Sofa </strong><?php echo e(get_unit_detail($service->unit)->sofa_size); ?></div>
    <div><strong>Notes </strong> <?php echo e($service->notes); ?></div> 
    <div><strong>Created At </strong> <?php echo e(\Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A')); ?></div>         
     
</div>
<span class="date_detail_more"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
</div>
</div>
 <?php endif; ?> 
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<p>No dates are available right now.</p>
<?php endif; ?>
</div>
</div>








<div class="date_desktop_section service-table">
    <table class="service-table table table-bordered">
        <tr>
            <th>Unit</th>
            <th>Date</th>
            <th>Time Out</th>
            <th>B/B</th>
            <th>Old Code</th>
            <th>I.D.</th>
            <th>New Code</th>                
            <th>Bed</th>
            <th>Sofa</th>
            <th>Runner</th>
            <th>Cleaner</th>
            <th>Cleaner Carry Over Date</th>
            <th class="service_notes">Notes</th>  
            <th>Action</th> 
            <th>Created At</th>            
        </tr>
        <tr>
            <td colspan="13">C/OUTS</td>
        </tr>
        <?php $__currentLoopData = $servicesout; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php    $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); ?>
        <tr class="service_tr td_service_<?php echo e($service->id); ?>">
         <form class="input-form service-add"  method="POST" action="<?php echo e(route('services.update', $service->id)); ?>" enctype="multipart/form-data">
           <?php echo csrf_field(); ?>
           <?php echo method_field('PUT'); ?>
           <input type="hidden" name="check" value="assigncleaner">
           <td><?php echo e(get_unit_detail($service->unit)->name); ?></td>
           <td><span class="table_arrival_departure_date_value"><?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('F d')); ?></span></td>
           <td><?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->departure_date)->format('h:i A') : '---'); ?></td>           
           <td class="text_red"><?php echo e($service->b2b == 1 ? 'B/B' : ''); ?></td>
           <td><?php echo e($service->room_code); ?></td> 
           <td><?php echo e(get_unit_detail($service->unit)->master_code); ?> </td>      
           <td>
            <?php if($service->b2b == 1): ?>
               <?php echo e(assigncleaner_get_new_code($service->id,$service->departure_date,$service->unit,$service->room_code)); ?>

            <?php endif; ?>
           </td>


           <td style="text-transform: capitalize;"><?php if(!empty($unserializedbed_size)): ?>
            <?php echo e(implode(', ', $unserializedbed_size)); ?>

            <?php else: ?>
            No data available
        <?php endif; ?></td>
        <td style="text-transform: capitalize;"><?php echo e(get_unit_detail($service->unit)->sofa_size); ?></td>
        <td>
         <select id="runner" name="runner" class="form-control" tabindex="-1" aria-hidden="true">
            <option value="">Select Runner</option>
            <?php $__currentLoopData = get_cleaner_Users(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($user->id); ?>" <?php if($service->runner == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </td>
    <td>
        <select id="cleaner" name="cleaner" class="form-control" tabindex="-1" aria-hidden="true">
            <option value="">Select Cleaner</option>
            <?php $__currentLoopData = get_cleaner_Users(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($user->id); ?>" <?php if($service->cleaner == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </td>
    <td>
        <?php if($service->b2b == 1): ?>
       
        <?php else: ?>
        <input type="date" class="form-control carry_over_date" name="carry_over_date" value="<?php echo e($service->carry_over_date); ?>">
        <?php endif; ?>
    </td>

    <td class="notes">
        <div id="notes-<?php echo e($service->id); ?>" class="notes-div" data-truncated-notes="<?php echo e(mb_substr($service->notes, 0, 50)); ?> <?php if(strlen($service->notes) > 50): ?>....  <?php endif; ?>" data-full-notes="<?php echo e($service->notes); ?>">
            <?php echo e(mb_substr($service->notes, 0, 50)); ?> <?php if(strlen($service->notes) > 50): ?>....  <?php endif; ?> 
        </div>
        <?php if(strlen($service->notes) > 50): ?>
        <a href="#" class="read-more-link" data-service-id="<?php echo e($service->id); ?>">Read more</a>
        <?php endif; ?>
    </td>
    <td class="">
       <button type="submit" class="btn btn-success">Save</button>     
   </td> 
    <td><?php echo e(\Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A')); ?></td>
</form>       

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td colspan="13">C/IN</td>
</tr>
<?php $__currentLoopData = $servicesin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if(!in_array($service->unit, $services_checkout_ids_array)): ?> 

<?php    $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); ?>
<tr class="service_tr td_service_<?php echo e($service->id); ?> <?php echo e($service->b2b == 1 ? 'service_yellow' : ''); ?>">
    <form class="input-form service-add"  method="POST" action="<?php echo e(route('services.update', $service->id)); ?>" enctype="multipart/form-data">
       <?php echo csrf_field(); ?>
       <?php echo method_field('PUT'); ?>
       <input type="hidden" name="check" value="assigncleaner">
       <td><?php echo e(get_unit_detail($service->unit)->name); ?></td>
       <td><span class="table_arrival_departure_date_value"><?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('F d')); ?></td>
           <td><?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') : '---'); ?></td>           
           <td class="text_red"></td>
           <td></td> 
           <td><?php echo e(get_unit_detail($service->unit)->master_code); ?>  </td>      
           <td>
                <?php if(!in_array($service->unit, $services_checkout_ids_array)): ?> 
                   <?php echo e($service->room_code); ?> 
                <?php endif; ?> 
          </td>

        <td style="text-transform: capitalize;"><?php if(!empty($unserializedbed_size)): ?>
            <?php echo e(implode(', ', $unserializedbed_size)); ?>

            <?php else: ?>
            No data available
        <?php endif; ?></td>
        <td style="text-transform: capitalize;"><?php echo e(get_unit_detail($service->unit)->sofa_size); ?></td>
        <td>
          
    </td>
    <td>
     
    </td>
    <td>
     
    </td>
    <td class="notes">
        <div id="notes-in-<?php echo e($service->id); ?>" class="notes-div" data-truncated-notes="<?php echo e(mb_substr($service->notes, 0, 50)); ?> <?php if(strlen($service->notes) > 50): ?>....  <?php endif; ?>" data-full-notes="<?php echo e($service->notes); ?>">
            <?php echo e(mb_substr($service->notes, 0, 50)); ?> <?php if(strlen($service->notes) > 50): ?>....  <?php endif; ?> 
        </div>
        <?php if(strlen($service->notes) > 50): ?>
        <a href="#" class="read-more-link-in" data-service-id="<?php echo e($service->id); ?>">Read more</a>
        <?php endif; ?>
    </td>  
    <td class="">
      
  </td>  

  <td><?php echo e(\Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A')); ?></td>
</form>   

</tr>

<?php endif; ?> 


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
</div>

</div>


<div class="modal fade" id="unitinfo" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="unitinfoBody">

        </div>
    </div>
</div>
</div>
</div>








<div class="date_desktop_section service-table" id="printableArea" style="display:none">

    
    <div class="print-only-header">
        <span id="print-datetime"></span>
        <span class="print-title">Rental Project Database</span>
        <span></span>
    </div>

    <table style="border: 2px solid #000; border-collapse: collapse; width: 100%;">
        <tr style="border: 2px solid #000; padding: 8px; color: #000;">
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Unit</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Date</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Time Out</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>B/B</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Old Code</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>I.D.</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>New Code</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Run</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Clean</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Bed</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Notes</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Created At</strong></th>
        </tr>

        <tr style="border: 2px solid #000; padding: 8px; color: #000; background-color: #FFFF00;">
            <td colspan="13" style="border: 2px solid #000; padding: 8px; color: #000;"><strong>C/OUTS</strong></td>
        </tr>

        <?php $__currentLoopData = $servicesout; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); ?>
        <tr class="service_tr td_service_<?php echo e($service->id); ?>" style="border: 2px solid #000; padding: 8px; color: #000;">
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong><?php echo e(get_unit_detail($service->unit)->name); ?></strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong><?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('d-m-y')); ?></strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong><?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->departure_date)->format('h:i A') : '---'); ?></strong></td>
            <td style="border: 2px solid #000; padding: 8px; color:red;"><strong><?php echo e($service->b2b == 1 ? 'B/B' : ''); ?></strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong><?php echo e($service->room_code); ?></strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong><?php echo e(get_unit_detail($service->unit)->master_code); ?></strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>
                <?php if($service->b2b == 1): ?>
                    <?php echo e(assigncleaner_get_new_code($service->id,$service->departure_date,$service->unit,$service->room_code)); ?>

                <?php endif; ?>
            </strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>
                <?php $__currentLoopData = get_cleaner_Users(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($service->runner == $user->id): ?> <?php echo e($user->name); ?> <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>
                <?php $__currentLoopData = get_cleaner_Users(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($service->cleaner == $user->id): ?> <?php echo e($user->name); ?> <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </strong></td>
            <td style="border: 2px solid #000; padding: 8px; text-transform: capitalize;"><strong>
                <?php if(!empty($unserializedbed_size)): ?> <?php echo e(implode(', ', $unserializedbed_size)); ?> <?php else: ?> No data available <?php endif; ?>
            </strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;" class="notes">
                <strong><div id="notes-<?php echo e($service->id); ?>" class="notes-div">
                    <?php echo e(mb_substr($service->notes, 0, 50)); ?><?php if(strlen($service->notes) > 50): ?>...<?php endif; ?>
                </div></strong>
            </td>
            <td><?php echo e(\Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A')); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <tr style="border: 2px solid #000; padding: 8px; color: #000; background-color: #FFFF00;">
            <td colspan="13" style="border: 2px solid #000; padding: 8px; color: #000;"><strong>C/IN</strong></td>
        </tr>

        <?php $__currentLoopData = $servicesin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!in_array($service->unit, $services_checkout_ids_array)): ?>
        <?php $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); ?>
        <tr class="service_tr td_service_<?php echo e($service->id); ?>" style="border: 2px solid #000; padding: 8px; color: #000;">
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong><?php echo e(get_unit_detail($service->unit)->name); ?></strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong><?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('d-m-y')); ?></strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong><?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') : '---'); ?></strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong><?php echo e(get_unit_detail($service->unit)->master_code); ?></strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong><?php echo e($service->room_code); ?></strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"></td>
            <td style="border: 2px solid #000; padding: 8px; text-transform: capitalize;"><strong>
                <?php if(!empty($unserializedbed_size)): ?> <?php echo e(implode(', ', $unserializedbed_size)); ?> <?php else: ?> No data available <?php endif; ?>
            </strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;" class="notes">
                <strong><div id="notes-in-<?php echo e($service->id); ?>" class="notes-div">
                    <?php echo e(mb_substr($service->notes, 0, 50)); ?><?php if(strlen($service->notes) > 50): ?>...<?php endif; ?>
                </div></strong>
            </td>
            <td><?php echo e(\Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A')); ?></td>
        </tr>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    
    <div class="print-only-footer">
        <span id="print-footer-datetime"></span>
        <span class="print-footer-title">Rental Project Database</span>
        <span>Page 1</span>
    </div>

</div>



<style>
    /* Hide custom header/footer on screen — only show during print */
    .print-only-header,
    .print-only-footer {
        display: none;
    }

    @media print {

        /* ✅ Force browser to NOT show its own URL/title header/footer */
        /* The user should uncheck "Headers and footers" in the print dialog */

        @page {
            size: A4 landscape;
            margin: 15mm 10mm;
        }

        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            font-family: Arial, sans-serif;
        }

        /* ✅ Show our custom header */
        .print-only-header {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding-bottom: 6px;
            margin-bottom: 8px;
            border-bottom: 2px solid #000;
            font-size: 12px;
            font-weight: bold;
        }

        .print-only-header .print-title {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        /* ✅ Show our custom footer */
        .print-only-footer {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding-top: 6px;
            margin-top: 8px;
            border-top: 2px solid #000;
            font-size: 11px;
            font-family: Arial, sans-serif;
        }

        .print-only-footer .print-footer-title {
            font-weight: bold;
            text-align: center;
        }
    }
</style>



<script type="text/javascript">

    // Returns formatted date/time: Thursday, 05 February 2026 at 11:21 PM
    function getCurrentDateTime() {
        var now       = new Date();
        var days      = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        var months    = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        var dayName   = days[now.getDay()];
        var dd        = String(now.getDate()).padStart(2, '0');
        var monthName = months[now.getMonth()];
        var yyyy      = now.getFullYear();
        var hh        = now.getHours();
        var min       = String(now.getMinutes()).padStart(2, '0');
        var ampm      = hh >= 12 ? 'PM' : 'AM';
        hh            = hh % 12 || 12;
        hh            = String(hh).padStart(2, '0');
        return dayName + ', ' + dd + ' ' + monthName + ' ' + yyyy + ' at ' + hh + ':' + min + ' ' + ampm;
    }

    function printDiv(divId) {

        // ✅ Inject live date/time right before printing
        var dateTimeStr = getCurrentDateTime();
        document.getElementById('print-datetime').innerText        = dateTimeStr;
        document.getElementById('print-footer-datetime').innerText = 'Printed: ' + dateTimeStr;

        var printContents    = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        var style = `
            <style>
                @page {
                    size: A4 landscape;
                    margin: 15mm 10mm;
                }
                body {
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                }
                .print-only-header {
                    display: flex !important;
                    justify-content: space-between;
                    align-items: center;
                    width: 100%;
                    padding-bottom: 6px;
                    margin-bottom: 8px;
                    border-bottom: 2px solid #000;
                    font-size: 12px;
                    font-weight: bold;
                }
                .print-only-header .print-title {
                    font-size: 14px;
                    font-weight: bold;
                }
                .print-only-footer {
                    display: flex !important;
                    justify-content: space-between;
                    align-items: center;
                    width: 100%;
                    padding-top: 6px;
                    margin-top: 8px;
                    border-top: 2px solid #000;
                    font-size: 11px;
                }
                .print-only-footer .print-footer-title {
                    font-weight: bold;
                }
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
            </style>
        `;

        document.body.innerHTML = style + printContents;
        window.print();
        document.body.innerHTML = originalContents;

        // Restore any JS event bindings if needed
        location.reload();
    }
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/services_assign_cleaners_table.blade.php ENDPATH**/ ?>