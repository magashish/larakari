<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>

  <?php echo $__env->make('breadcrumb.owner_breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container-fluid nss_style accountinfo">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
    <span class="rental insert_dates"><a href="<?php echo e(route('home.manage')); ?>">Manage</a> </span> 
    >>
    <span class="rental insert_dates"><a href="<?php echo e(route('user.userowner')); ?>">Owners</a> </span>
    >>
    Information
  </h1>
    </div>

    <div class="col-xl-12 col-md-12 mb-4 accountinfo_title">
        <div class="row mb-3">
            <div class="col-md-4 col-form-label text-md-end">
                <h3 class="col-form-label text-md-end">General Information</h3>           
            </div>
            <div class="col-md-8">  
                <button type="button" class="btn btn-primary usereditinfo InsertUpdateunitinfo"  data-url="<?php echo e(route('user.editowneruser', $user->id)); ?>">Edit Info </button>           
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-12 mb-4">          
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Name')); ?></label>
                <div class="col-md-6">
                   <span class="userinfo"> <?php echo e($user->name); ?></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="hotel_name" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Hotel Name')); ?></label>
                <div class="col-md-6">
                   <span class="userinfo"> <?php echo e($user->hotel_name); ?></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="address" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Address')); ?></label>
                <div class="col-md-6">
                 <span class="userinfo">
                    <?php echo e($user->address); ?>

                    <?php if($user->address && ($user->city || $user->state || $user->zip)): ?>, <?php endif; ?>
                    <?php echo e($user->city); ?>

                    <?php if($user->city && ($user->state || $user->zip)): ?>, <?php endif; ?>
                    <?php echo e($user->state); ?>

                    <?php if($user->state && $user->zip): ?>, <?php endif; ?>
                    <?php echo e($user->zip); ?>

                </span>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="row mb-3">
                <label for="phone" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Phone')); ?></label>
                <div class="col-md-6">
                   <span class="userinfo"> <?php echo e($user->phone); ?></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Email')); ?></label>
                <div class="col-md-6">
                    <span class="userinfo"> <?php echo e($user->email); ?></span>
                    <?php if(!empty($user->email2)): ?>
                    <span class="userinfo">, <?php echo e($user->email2); ?></span>
                    <?php endif; ?>

                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Status')); ?></label>
                <div class="col-md-6">
                    <span class="userinfo"><td>
                        <?php if(isset($user->status) && !empty($user->status)): ?>
                        <?php echo e(owner_status_array()[$user->status]); ?>

                        <?php else: ?>
                        N/A
                        <?php endif; ?>
                    </td></span>
                </div>
            </div>
        </div>
    </div>

    <form  class="input-form user-add" method="POST" action="<?php echo e(route('admin.admin_user_update', $user->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="col-xl-12 col-md-12 mb-4 accountinfo_title">
            <div class="row mb-3">
                <div class="col-md-4 col-form-label text-md-end">
                    <h3 class="col-form-label text-md-end">Login Information</h3>           
                </div>
                <div class="col-md-8">  
                    <button type="submit" class="btn btn-primary" id="update_password"><?php echo e(__('Update')); ?></button>        
                </div>
            </div>
        </div>    
        <div class="row">
            <div class="col-xl-6 col-md-12 mb-4">          
                <div class="row mb-3">
                    <label for="username" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Username')); ?></label>
                    <div class="col-md-6">
                        <span class="userinfo"> <?php echo e($user->username); ?> </span>
                    </div>
                </div>
              
           </div>
            <div class="col-xl-6 col-md-12 mb-4">         
              
                <div class="row mb-3">
                    <label for="status" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Password')); ?></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="password" name="password" <?php echo e(old('password')); ?> required >
                        <?php $__errorArgs = ['password'];
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
       </div>
   </form>





  <div class="col-xl-12 col-md-12 mb-4 accountinfo_title">
        <div class="row mb-3">
            <div class="col-md-4 col-form-label text-md-end">
                <h3 class="col-form-label text-md-end">Unit Information</h3>           
            </div>
            <div class="col-md-8">  
                
                 <button type="button" class="btn btn-primary InsertUpdateunitinfo"  data-url="<?php echo e(route('admin.create_unit', $user->id)); ?>" >Insert </button> 
            </div>
        </div>
    </div>

     <div class="row date_mobile_section">
    <div class="col-xl-12 col-md-12 mb-4">
        <div class="service-table"> 
            <div class="div div-bordered">             

                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php    $unserializedbed_size = unserialize($unit->bed_size); ?>
                <div class="services_date_detail">
                    <div class="services_date_name">
                         <div><strong>Unit :- <?php echo e($unit->id); ?></strong></div>
                        <div><strong>Unit :- <?php echo e($unit->name); ?></strong></div>
                        <div><strong>Bedroom Type:- </strong><?php echo e($unit->bedroom_type); ?></div>
                    </div>
                    <div class="services_date_detail_more"> 
                        <div class="services_date_detail_action" style="display: none;"> 
                            <div style="text-transform: capitalize;"><strong>Bed Size:- </strong><?php if(!empty($unserializedbed_size)): ?>
                                <?php echo e(implode(', ', $unserializedbed_size)); ?>

                                <?php else: ?>
                                No data available
                            <?php endif; ?></div>
                            <div style="text-transform: capitalize;"><strong>Sofa:- </strong><?php echo e($unit->sofa_size); ?></div>
                            <div><strong>I.D.:- </strong><?php echo e($unit->master_code); ?></div> 
                            <div><strong>Room Code Manually:- </strong><?php echo e($unit->room_code == 1 ? 'Yes' : 'No'); ?></div> &nbsp;   

                            <div class="action">
                                <a  class="btn btn-success btn-sm mb-1 InsertUpdateunitinfo"  data-url="<?php echo e(route('admin.create_unit', [$user->id,$unit->id])); ?>"><i class="fas fa-pen"></i></a>

                                <form method="post" action="<?php echo e(route('unit.destroy',$unit->id)); ?>" class="delete-form">
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
            </div>
        </div>
        <?php echo $units->links(); ?>

    </div>
</div>

    <div class="row date_desktop_section">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="service-table"> 
                <table class="table table-bordered">                    
                    <tr>
                        <th>ID</th>
                        <th>Unit</th>
                        <th>Bedroom Type</th>
                        <th>Bed Size</th>
                        <th>Sofa</th>
                        <th>I.D.</th>
                        <th>Room Code Manually</th>
                        <th>Check in/out</th>
                        <th>Action</th>
                    </tr>
                    <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php    $unserializedbed_size = unserialize($unit->bed_size); ?>
                    <tr>
                        <td><?php echo e($unit->id); ?></td>
                        <td><?php echo e($unit->name); ?></td>
                        <td><?php echo e($unit->bedroom_type); ?></td>
                       <td style="text-transform: capitalize;"><?php if(!empty($unserializedbed_size)): ?>
                                <?php echo e(implode(', ', $unserializedbed_size)); ?>

                                <?php else: ?>
                                No data available
                            <?php endif; ?></td>
                        <td style="text-transform: capitalize;"><?php echo e($unit->sofa_size); ?></td>
                        <td><?php echo e($unit->master_code); ?></td>
                        <td><?php echo e($unit->room_code == 1 ? 'Yes' : 'No'); ?></td>
                        <td><?php echo e(date('h:i A', strtotime($unit->checkin))); ?> / <?php echo e(date('h:i A', strtotime($unit->checkout))); ?></td>

                        <td class="action">
                            
                            <a  class="btn btn-success btn-sm mb-1 InsertUpdateunitinfo"  data-url="<?php echo e(route('admin.create_unit', [$user->id,$unit->id])); ?>"><i class="fas fa-pen"></i></a>
                      
                    <form method="post" action="<?php echo e(route('unit.destroy',$unit->id)); ?>" class="delete-form">
                        <?php echo method_field('delete'); ?>
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger btn-sm mb-1 delete-btn"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
    <?php echo $units->links(); ?>

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

<div class="modal fade" id="serviceconfirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="sample_form" class="form-horizontal">
                <div class="modal-body">
                    <h4 align="center" style="margin: 0;">Are you sure you want to delete this unit?</h4>
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



</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/owner_info.blade.php ENDPATH**/ ?>