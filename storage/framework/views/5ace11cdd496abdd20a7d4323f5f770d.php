
<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success" role="alert">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>
  <?php echo $__env->make('breadcrumb.owner_breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container-fluid nss_style">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><span class="rental">Rental Info </span> >> <span class="insert_dates">Edit Dates </span></h1>
  </div>

  <?php if(!isset($id)): ?>
  <div class="row">
      <div class="col-xl-12 col-md-12 mb-4">
        <div class="row mb-3">
            <div class="col-md-4 offset-md-4 col-form-label text-md-end">
                <label for="unit_type" class="col-form-label text-md-end"><?php echo e(__('Select The Unit # to Edit Dates')); ?></label>
                <select id="unit_type" class="form-control">
                    <option value="">Select Unit #</option>
                    <?php $__currentLoopData = unit_type_owner_array(auth()->user()->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e(route('owner.owner_edit_date', $value->id)); ?>" ><?php echo e($value->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="all_dates"><a href="<?php echo e(route('owner.owner_edit_date', 'all')); ?>">Edit All Dates</a></span>
            </div>
            <div class="col-md-6">              
            </div>
        </div>
    </div>
</div>
<?php else: ?>

<?php $__currentLoopData = $services_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $services): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row">
  <div class="col-xl-12 col-md-12 mb-4 unit_title">
    <div class="row mb-3">
        <div class="col-md-12 col-form-label text-md-end">
            <label for="unit_type" class="col-form-label text-md-end"><?php echo e(__('Unit #:')); ?>  <span class="unit_id"><?php echo e(get_unit_detail($key)->name); ?></span></label>        
        </div>
        
    </div>
</div>

<div class="col-xl-12 col-md-12 mb-4">
   <?php if($services->isNotEmpty()): ?>

   <div class="date_mobile_section">
       <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

           <div class="services_date_detail">
           <div class="services_date_name">
            <div class="guest_name"><?php echo e($service->guest_name); ?></div>
            <div class="unit"><strong>Unit# </strong><?php echo e($service->unit); ?></div>
            <div class="unit"><strong>Early Check In </strong> <?php echo e($service->checkin == 1 ? 'Yes' : 'No'); ?></div>
            <div class="arrival_date"> <strong>Arrival Date </strong> <span class="arrival_departure_date_value"> <?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('F d')); ?>

               <?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') : ''); ?>


               </span>
            </div>
            <div class="unit"><strong>Late Departure </strong><?php echo e($service->checkout == 1 ? 'Yes' : 'No'); ?></div>
            <div class="departure_date"><strong>Departure Date </strong> <span class="arrival_departure_date_value">  <?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('F d')); ?>

                 <?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->departure_date)->format('h:i A') : ''); ?>

             </span>
            </div>
        </div>

        <div class="services_date_detail_more"> 
         <div class="services_date_detail_action" style="display: none;">       
            <div><strong>Room Code </strong> <?php echo e($service->room_code); ?></div> 
            <div><strong>Notes </strong> <?php echo e($service->notes); ?></div>&nbsp;   
            <div class="action">
              <a href="<?php echo e(route('owner-services.edit', $service->id)); ?>" class="btn btn-success btn-sm mb-1"><i class="fas fa-pen"></i></a>              
              <form method="post" action="<?php echo e(route('owner-services.destroy', $service->id)); ?>" class="delete-form">
                <?php echo method_field('delete'); ?>
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger btn-sm mb-1 delete-btn"><i class="fas fa-trash"></i></button>
            </form>
        </div>
    </div>
    <span class="date_detail_more"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
</div>
</div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <?php echo $services->links(); ?>

</div>

   <div class="date_desktop_section">
    <table class="service-table table table-bordered">
        <tr>
            <th>Guest Name</th>
            <th>Arrival Date</th>
            <th>Arrival Time</th>
            <th>Departure Date</th>
            <th>Departure Time</th>
            <th>Room Code</th>
            <th>B2B</th>
            <th class="service_notes">Notes</th>
            <th>Actions</th>
        </tr>
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($service->guest_name); ?></td>
            <td> <span class="table_arrival_departure_date_value"><?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('F d')); ?></span></td>
            <td>
                <?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') : '---'); ?>

            </td>
            <td><span class="table_arrival_departure_date_value"><?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('F d')); ?> </span></td>
            <td>
               <?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->departure_date)->format('h:i A') : '---'); ?>

            </td>
            <td><?php echo e($service->room_code); ?></td>
            <td>
                <?php if(!empty($service->b2b) && $service->b2b == 1): ?>
                B2B
                <?php endif; ?>
            </td>
            <td class="notes">
                <div id="notes-<?php echo e($service->id); ?>" class="notes-div" data-truncated-notes="<?php echo e(mb_substr($service->notes, 0, 50)); ?> <?php if(strlen($service->notes) > 50): ?>....  <?php endif; ?>"           data-full-notes="<?php echo e($service->notes); ?>">
                    <?php echo e(mb_substr($service->notes, 0, 50)); ?> <?php if(strlen($service->notes) > 50): ?>....  <?php endif; ?> 
                </div>
                <?php if(strlen($service->notes) > 50): ?>
                <a href="#" class="read-more-link" data-service-id="<?php echo e($service->id); ?>">Read more</a>
                <?php endif; ?>
            </td>
            <td class="action">
                <a href="<?php echo e(route('owner-services.edit', $service->id)); ?>" class="btn btn-success btn-sm mb-1"><i class="fas fa-pen"></i></a>
                <form method="post" action="<?php echo e(route('owner-services.destroy', $service->id)); ?>" class="delete-form">
                    <?php echo method_field('delete'); ?>
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger btn-sm mb-1 delete-btn"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
     <?php echo $services->links(); ?>

</div>
    <?php else: ?>
    <p>No dates are available for this unit right now.</p>
    <?php endif; ?>
</div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</div>

<div class="modal fade" id="serviceconfirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="sample_form" class="form-horizontal">
                <div class="modal-body">
                    <h4 align="center" style="margin: 0;">Are you sure you want to delete this date?</h4>
                    <p>You cannot undo this action.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/owner/edit_unit_services.blade.php ENDPATH**/ ?>