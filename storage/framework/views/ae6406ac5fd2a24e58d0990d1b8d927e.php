<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success">
 <?php echo e(session('status')); ?>

</div>
<?php endif; ?>

<?php echo $__env->make('breadcrumb.owner_breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>







<div class="container-fluid nss_style add-service-date">  


    <?php if(isset($serviceserrors) && count($serviceserrors) > 0): ?>
    <div class="alert alert-danger" role="alert">
        <div class="error-message">
            <h2>Import Errors Found:</h2>
            <ul>
                <?php $__currentLoopData = $serviceserrors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>



    <?php if(isset($servicessuccess) && count($servicessuccess) > 0): ?>
    <div class="alert alert-success" role="alert">
        <div class="error-message">
            <ul>
                <?php $__currentLoopData = $servicessuccess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $success): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($success); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
    



    <div class="d-sm-flex align-items-center justify-content-between mb-4">


      <h1 class="h3 mb-0 text-gray-800">
        <span class="rental insert_dates"><a href="<?php echo e(route('home.manage')); ?>">Manage</a> </span> 
        >>
        <span class="rental insert_dates"><a href="<?php echo e(route('services.index')); ?>">View Dates</a> </span>
        >>
        <span class="insert_dates">Import Dates </span>
    </h1>

    <p class="mb-1">
        <a href="<?php echo e(asset('images/services (1).csv')); ?>" class="text-blue-600 hover:text-blue-800 underline">
            <i class="fas fa-download mr-1"></i> Download sample CSV file
        </a>
        <span class="text-sm text-gray-600 block mt-1">This demo file shows the required format for successful imports.</span>
    </p>

    <p>Please verify that the Checkout Date is always after the Arrival Date, and confirm each unit exists in the database. Any records with invalid dates (Checkout ≤ Arrival) or non-existent units should be automatically skipped.</p>
</div>

<div class="row justify-content-center"> 
    <div class="col-xl-12 col-lg-12 col-md-12 mb-4"> 
        <div class="card shadow mb-4"> 
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-boldx">Import Dates from CSV</h6>
            </div>

            <div class="card-body">
                <form id="import_dates_form" class="user-add" method="POST" action="" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> 
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12"> 
                            <div class="mb-3">
                                <label for="file" class="form-label"><?php echo e(__('Select The File to Import Dates')); ?></label>
                                <input id="file" type="file" class="form-control" name="file" accept=".csv" required>

                                <div class="form-text text-muted">
                                    Please select a CSV file containing the dates to import.
                                </div>
                            </div>

                            <div class="mb-3"> 
                                <button type="submit" class="btn btn-primary" id="submit_import_btn">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    <span class="button-text">Submit</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/services_import.blade.php ENDPATH**/ ?>