<form class="input-form service-add"  method="POST" action="<?php echo e(route('services.update', $service->id)); ?>" enctype="multipart/form-data">
 <?php echo csrf_field(); ?>
 <?php echo method_field('PUT'); ?>
 <div class="row mb-3">
    <label for="unit" class="col-md-6 col-form-label text-md-end"><?php echo e(__('Unit#')); ?></label>
    <div class="col-md-6">
        <span class="form-control-span"><?php echo e(get_unit_detail($service->unit)->name); ?></span>         
       
</div>
</div>

<div class="row mb-3">
    <label for="bed_type" class="col-md-6 col-form-label text-md-end"><?php echo e(__('Bed Type')); ?></label>
    <div class="col-md-6">
        <span class="form-control-span"><?php echo e(get_unit_detail($service->unit)->bedroom_type); ?></span> 
        
    </div>
</div>

<div class="row mb-3">
    <label for="guest_name" class="col-md-6 col-form-label text-md-end"><?php echo e(__('Guest Name')); ?></label>

    <div class="col-md-6">
       <span class="form-control-span"><?php echo e($service->guest_name); ?></span>
    </div>
</div>
<div class="row mb-3">
    <label for="arrival_date" class="col-md-6 col-form-label text-md-end"><?php echo e(__('Arrival Date')); ?></label>

    <div class="col-md-6">
        <span class="form-control-span"><?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('Y-m-d')); ?></span>
    </div>
</div>

<div class="row mb-3">
    <label for="arrival_time" class="col-md-6 col-form-label text-md-end"><?php echo e(__('Arrival Time')); ?></label>

    <div class="col-md-6">
        <span class="form-control-span"><?php echo e(\Carbon\Carbon::parse($service->arrival_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') : '---'); ?></span>

    </div>
</div>

<div class="row mb-3">
    <label for="departure_date" class="col-md-6 col-form-label text-md-end"><?php echo e(__('Checkout Date')); ?></label>
    <div class="col-md-6">
        <span class="form-control-span"><?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('Y-m-d')); ?></span>
    </div>
</div>

<div class="row mb-3">
    <label for="departure_time" class="col-md-6 col-form-label text-md-end"><?php echo e(__('Checkout Time')); ?></label>
    <div class="col-md-6">
        <span class="form-control-span"> <?php echo e(\Carbon\Carbon::parse($service->departure_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->departure_date)->format('h:i A') : '---'); ?></span>
    </div>
</div>


<?php if($service->room_code): ?>
<div class="row mb-3">
    <label for="room_code" class="col-md-6 col-form-label text-md-end"><?php echo e(__('Room Code')); ?></label>
    <div class="col-md-6">
        <span class="form-control-span"><?php echo e($service->room_code); ?></span>
    </div>
</div>
<?php endif; ?>

<?php if($service->b2b == 1): ?>
<div class="row mb-3">
    <label for="room_code" class="col-md-6 col-form-label text-md-end"><?php echo e(__('New Room Code')); ?></label>
    <div class="col-md-6">
        <span class="form-control-span"> <?php echo e(assigncleaner_get_new_code($service->id,$service->departure_date,$service->unit,$service->room_code)); ?></span>
    </div>
</div>
<?php endif; ?>



<div class="row mb-3">
    <label for="notes" class="col-md-6 col-form-label text-md-end"><?php echo e(__('Notes')); ?></label>
    <div class="col-md-6">
        <span class="form-control-span"><?php echo e($service->notes); ?></span>
    </div>
</div>
<div class="row mb-3">
  <label class="col-md-6 col-form-label text-md-end"><?php echo e(__('Cleaner')); ?></label>
  <div class="col-md-6">
    <?php if(!empty($service->cleaner)): ?>
    <?php echo e(get_userdata($service->cleaner)->name); ?>

<?php endif; ?>
</div>
</div>

<div class="row mb-3">
  <label class="col-md-6 col-form-label text-md-end"><?php echo e(__('Runner')); ?></label>
  <div class="col-md-6">
     <?php if(!empty($service->runner)): ?>
    <?php echo e(get_userdata($service->runner)->name); ?>

<?php endif; ?>
</div>
</div>

<div class="row mb-3">
  <label class="col-md-6 col-form-label text-md-end"><?php echo e(__('Cleaner Carry Over Date')); ?></label>
  <div class="col-md-6">
    <span class="form-control-span"><?php echo e($service->carry_over_date); ?></span>
</div>
</div>

</form>
<?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/edit_calendar_service.blade.php ENDPATH**/ ?>