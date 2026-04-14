<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>

  <?php echo $__env->make('breadcrumb.owner_breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container-fluid nss_style accountinfo">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Account Info</h1>
    </div>

    <div class="col-xl-12 col-md-12 mb-4 accountinfo_title">
        <div class="row mb-3">
            <div class="col-md-4 col-form-label text-md-end">
                <h3 class="col-form-label text-md-end">General Information</h3>           
            </div>
            <div class="col-md-8">  
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#usereditinfo">Edit Info </button>           
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
                <label for="name" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Hotel Name')); ?></label>
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
                <label for="email" class="col-md-4 col-form-label text-md-end"><?php echo e(__('E-Mail Address')); ?></label>
                <div class="col-md-6">
                    <span class="userinfo"> <?php echo e($user->email); ?>  <?php if(!empty($user->email2)): ?>
                    , <?php echo e($user->email2); ?>

                    <?php endif; ?></span>

                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-12 col-md-12 mb-4 accountinfo_title">
        <div class="row mb-3">
            <div class="col-md-4 col-form-label text-md-end">
                <h3 class="col-form-label text-md-end">Login Information</h3>           
            </div>
            <div class="col-md-8">  
            </div>
        </div>
    </div>

    <form  class="input-form user-add" method="POST" action="<?php echo e(route('owner.user_update', $user->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-xl-6 col-md-12 mb-4">          
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Name')); ?></label>
                    <div class="col-md-6">
                        <span class="userinfo"> <?php echo e($user->name); ?> </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Password')); ?></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="password" name="password" required >
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
             <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>
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
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-12 mb-4">
        <div class="row mb-3">
            <div class="col-md-2 col-form-label text-md-end unitleft">
                <label for="unit_type" class="col-form-label text-md-end">Unit:</label>           
            </div>
            <div class="col-md-10 unitright"> 
            <table style="width: 100%; border-collapse: collapse;">
                <?php $__currentLoopData = $services_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit_id => $servicecount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="unitid">
                    <td><span><?php echo e(get_unit_detail($unit_id)->name); ?></span></td> 
                    <td> <span> (<?php echo e($servicecount); ?>)</span> </td>
                    <td> <span><a href="<?php echo e(route('owner.owner_get_date', $unit_id)); ?>">View</a></span> </td>
                </tr>              
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            </div>
        </div>
    </div>

    




   <div class="modal fade" id="usereditinfo" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  class="input-form user-add" method="POST" action="<?php echo e(route('owner.user_update', $user->id)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">          
                            <div class="row mb-3">
                                <label for="name" class="col-md-3 col-form-label text-md-end"><?php echo e(__('Name')); ?></label>
                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                                    value="<?php echo e($user->name); ?>" required autocomplete="name" autofocus>

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
                                <label for="hotel_name" class="col-md-3 col-form-label text-md-end"><?php echo e(__('Hotel Name')); ?></label>
                                <div class="col-md-9">
                                    <input id="hotel_name" type="text" class="form-control <?php $__errorArgs = ['hotel_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="hotel_name"
                                    value="<?php echo e($user->hotel_name); ?>" required autocomplete="hotel_name" autofocus>

                                    <?php $__errorArgs = ['hotel_name'];
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
                                <label for="address" class="col-md-3 col-form-label text-md-end"><?php echo e(__('Address')); ?></label>
                                <div class="col-md-9">
                                    <input id="address" type="text" class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="address"
                                    value="<?php echo e($user->address); ?>" required autocomplete="address">

                                    <?php $__errorArgs = ['address'];
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
                                <label for="city" class="col-md-3 col-form-label text-md-end"><?php echo e(__('City')); ?></label>
                                <div class="col-md-9">
                                    <input id="city" type="text" class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="city" value="<?php echo e($user->city); ?>" required autocomplete="city">
                                    <?php $__errorArgs = ['city'];
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
                                <label for="state" class="col-md-3 col-form-label text-md-end"><?php echo e(__('State')); ?></label>
                                <div class="col-md-9">
                                    <input id="state" type="text" class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="state" value="<?php echo e($user->state); ?>" required autocomplete="state">
                                    <?php $__errorArgs = ['state'];
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
                                <label for="zip" class="col-md-3 col-form-label text-md-end"><?php echo e(__('Zip')); ?></label>
                                <div class="col-md-9">
                                    <input id="zip" type="text" class="form-control <?php $__errorArgs = ['zip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="zip" value="<?php echo e($user->zip); ?>" required autocomplete="zip">
                                    <?php $__errorArgs = ['zip'];
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
                                <label for="phone" class="col-md-3 col-form-label text-md-end"><?php echo e(__('Phone')); ?></label>
                                <div class="col-md-9">
                                    <input id="phone" type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone"
                                    value="<?php echo e($user->phone); ?>" autocomplete="phone">

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
                                <label for="email" class="col-md-3 col-form-label text-md-end"><?php echo e(__('E-Mail')); ?></label>
                                <div class="col-md-9">
                                    <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                    value="<?php echo e($user->email); ?>" required autocomplete="email">

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
                                <label for="email2" class="col-md-3 col-form-label text-md-end"><?php echo e(__('Second E-Mail')); ?></label>
                                <div class="col-md-9">
                                    <input id="email2" type="email2" class="form-control <?php $__errorArgs = ['email2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email2"
                                    value="<?php echo e($user->email2); ?>"  autocomplete="email2">

                                    <?php $__errorArgs = ['email2'];
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Update Info')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>









</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/owner/account_info.blade.php ENDPATH**/ ?>