   <form class="input-form unitinfo-add" id="unitinfoform" method="POST" action="<?php echo e(route('unit.store')); ?>" enctype="multipart/form-data">
             <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4"> 
                            <input type="hidden" name="owner_id" value="<?php echo e($ownerid); ?>" >

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Unit')); ?></label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>"  required>
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
                                <label for="bedroom_type" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Bedroom Type')); ?></label>
                                <div class="col-md-8">
                                    <input id="bedroom_type" type="number" class="form-control <?php $__errorArgs = ['bedroom_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="bedroom_type" value="<?php echo e(old('bedroom_type')); ?>"  min="0" required>
                                    <?php $__errorArgs = ['bedroom_type'];
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
                                <label for="bed_size" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Bed Size')); ?></label>
                                <div class="col-md-8">
                                    <select id="bed_size"  class="form-control js-bed-size-basic-single" name="bed_size[]" multiple="multiple"required> 
                                    <?php $__currentLoopData = bed_size_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $bed_size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <option value="<?php echo e($bed_size); ?>"><?php echo e($bed_size); ?></option> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                    <?php $__errorArgs = ['bed_size'];
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
                                <label for="sofa_size" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Sofa')); ?></label>
                                <div class="col-md-8">
                                   
                                    <select id="sofa_size" name="sofa_size" class="form-control " tabindex="-1" aria-hidden="true"> 
                                    <?php $__currentLoopData = sofa_size_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $sofa_size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <option value="<?php echo e($key); ?>"><?php echo e($sofa_size); ?></option> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                    <?php $__errorArgs = ['sofa_size'];
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
                                <label for="master_code" class="col-md-4 col-form-label text-md-end"><?php echo e(__('I.D.')); ?></label>
                                <div class="col-md-8">
                                    <input id="master_code" type="text" class="form-control <?php $__errorArgs = ['master_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="master_code" value="<?php echo e(old('master_code')); ?>">
                                    <?php $__errorArgs = ['master_code'];
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
                                <label for="room_code" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Room Code Manually')); ?></label>
                                <div class="col-md-8 text-md-start">
                                    <input id="room_code" type="checkbox" class="form-control <?php $__errorArgs = ['room_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="room_code" value="1">                                   
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="checkin" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Check in')); ?></label>
                                <div class="col-md-8">                                   
                                    <select id="checkin" name="checkin" class="form-control " tabindex="-1" aria-hidden="true" required> 
                                        <?php $__currentLoopData = checkin_time_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $checkin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <option value="<?php echo e($key); ?>"><?php echo e($checkin); ?></option> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['checkin'];
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
                                <label for="checkout" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Check out')); ?></label>
                                <div class="col-md-8">
                                    <select id="checkout" name="checkout" class="form-control " tabindex="-1" aria-hidden="true" required> 
                                        <?php $__currentLoopData = checkout_time_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $checkout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <option value="<?php echo e($key); ?>"><?php echo e($checkout); ?></option> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <?php $__errorArgs = ['checkout'];
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
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary"><?php echo e(__('Insert')); ?></button>
                                </div>
                            </div>                         

                        </div>                            
                    </div>
                </div>
               
            </form><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/add_unit.blade.php ENDPATH**/ ?>