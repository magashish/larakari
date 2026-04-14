<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3"><img class="logo" src="<?php echo e(asset('images/hawaiiproclean.jpg')); ?>" /></div>
    </a>
    <?php
    $user = auth()->user();
    $currentUrl = Request::url();
    ?>
    <li class="nav-item active">
        <a class="nav-link" href="/home">
            <span>Welcome <?php echo e($user->name); ?> </span></a>
        </li> 
        <li class="nav-item">
            <a class="nav-link collapsed <?php echo e($currentUrl === url('/home') ? 'active' : ''); ?>" href="/home" data-toggle="" data-target=""
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fa fa-home" aria-hidden="true"></i>
            <span>Dashboard</span>
        </a>        
    </li> 
    
    <?php if($user && $user->role === 'admin'): ?>    
     <li class="nav-item">
            <a class="nav-link collapsed <?php echo e($currentUrl === route('services.services_calendar') ? 'active' : ''); ?>" href="<?php echo e(route('services.services_calendar')); ?>" data-toggle="" data-target=""
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <span>Rental Calendar</span>
        </a>        
    </li>  
   


  <li class="nav-item">
        <a class="nav-link collapsed manage-link" href="<?php echo e(route('home.manage')); ?>" data-toggle="collapse" data-target="#collapseservicesr"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fa fa-calendar" aria-hidden="true"></i>
        <span>Rental Info</span>
    </a>
    <div id="collapseservicesr" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <ul>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo e(route('home.manage')); ?>" data-toggle="collapse" data-target="#collapseservices_inner" aria-expanded="true" aria-controls="collapsePages">
                    <span>Rental Dates</span>
                </a>
                <div id="collapseservices_inner" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?php echo e($currentUrl === route('services.index') ? 'active' : ''); ?> <?php echo e(Str::contains(url()->current(), ['/services/unit/']) ? 'active' : ''); ?>" href="<?php echo e(route('services.index')); ?>">View Dates</a>
                            <a class="collapse-item <?php echo e(Str::contains(url()->current(), ['/oldservices']) ? 'active' : ''); ?>" href="<?php echo e(route('admin.get_old_services')); ?>">View Old Dates</a>
                            <a class="collapse-item <?php echo e($currentUrl === route('services.create') ? 'active' : ''); ?>" href="<?php echo e(route('services.create')); ?>">Insert Dates</a>
                            <a class="collapse-item <?php echo e($currentUrl === route('services.services_calendar') ? 'active' : ''); ?>" href="<?php echo e(route('services.services_calendar')); ?>">Calendar</a>
                    </div>
                </div>
            </li>           
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo e(route('home.manage')); ?>" data-toggle="collapse" data-target="#collapseservices_Owners" aria-expanded="true" aria-controls="collapsePages">
                    <span>Owners</span>
                </a>
                <div id="collapseservices_Owners" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php echo e($currentUrl === route('user.userowner') ? 'active' : ''); ?> <?php echo e(Str::contains(url()->current(), ['/user/owner/show']) ? 'active' : ''); ?>" href="<?php echo e(route('user.userowner')); ?>">View Owners</a>
                        <a class="collapse-item <?php echo e($currentUrl === route('user.ownercreate') ? 'active' : ''); ?>" href="<?php echo e(route('user.ownercreate')); ?>">Insert Owners</a>
                        <a class="collapse-item <?php echo e($currentUrl === route('user.userowner') ? 'active' : ''); ?>" href="<?php echo e(route('user.userowner')); ?>">Manage Units</a>          
                    </div>
                </div>
           </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo e(route('user.usercleaner')); ?>" data-toggle="collapse" data-target="#collapseservices_cleaners" aria-expanded="true" aria-controls="collapsePages">
                    <span>Cleaners</span>
                </a>
                <div id="collapseservices_cleaners" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                       <a class="collapse-item <?php echo e($currentUrl === route('user.usercleaner') ? 'active' : ''); ?>" href="<?php echo e(route('user.usercleaner')); ?>">View Cleaners</a>
                       <a class="collapse-item <?php echo e($currentUrl === route('user.cleanercreate') ? 'active' : ''); ?>" href="<?php echo e(route('user.cleanercreate')); ?>">Insert Cleaner</a>
                       <a class="collapse-item <?php echo e($currentUrl === route('assigncleaner.index') ? 'active' : ''); ?>" href="<?php echo e(route('assigncleaner.index')); ?>">Assign Cleaner</a>                  
                    </div>
                </div>
           </li>                
           
       </ul>
        </div>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link collapsed <?php echo e(Str::contains(url()->current(), ['/user/admin','user/create','/edit']) ? 'active' : ''); ?>" href="<?php echo e(route('user.useradmin')); ?>">
        <i class="fa fa-user" aria-hidden="true"></i>
        <span>Manage Admins</span>
    </a>
</li>


<li class="nav-item">
    <a class="nav-link collapsed <?php echo e($currentUrl === route('assigncleaner.index') ? 'active' : ''); ?>" href="<?php echo e(route('assigncleaner.index')); ?>">
        <i class="fa fa-envelope" aria-hidden="true"></i>
        <span>Assign Cleaners</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed <?php echo e($currentUrl === route('contactowner.create') ? 'active' : ''); ?>" href="<?php echo e(route('contactowner.create')); ?>">
        <i class="fa fa-envelope" aria-hidden="true"></i>
        <span>Contact Owner</span>
    </a>
</li>

<?php elseif($user && $user->role === 'owner'): ?>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseservicesr"
    aria-expanded="true" aria-controls="collapsePages">
    <i class="fa fa-calendar" aria-hidden="true"></i>
    <span>Rental Info</span>
</a>
<div id="collapseservicesr" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded"> 
           
        <a class="collapse-item <?php echo e(Str::contains(url()->current(), '/create') ? 'active' : ''); ?>" href="<?php echo e(route('owner-services.create')); ?>">Insert Dates</a>
        <a class="collapse-item <?php echo e(Str::contains(url()->current(), '/service') ? 'active' : ''); ?>" href="<?php echo e(route('owner.owner_get_date')); ?>">View Dates</a>
        <a class="collapse-item <?php echo e(Str::contains(url()->current(), '/edit') ? 'active' : ''); ?>" href="<?php echo e(route('owner.owner_edit_date')); ?>">Edit Dates</a>
    </div>
</div>
</li>
<li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('owner.owner_account_info')); ?>" >
    <i class="fas fa-fw fa-address-book"></i>
    <span>Account Info</span>
</a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo e(route('owner.owner_contact_bclean')); ?>">
        <i class="fa fa-envelope" aria-hidden="true"></i>
        <span>Contact Hawaii pro clean</span>
    </a>
</li>
<?php endif; ?>

<li class="nav-item mobile-nav-item">
    <?php if(auth()->guard()->guest()): ?>
        <?php if(Route::has('login')): ?>
            <a class="nav-link collapsed" href="<?php echo e(route('login')); ?>">
                <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                <?php echo e(__('Login')); ?></a>
        <?php endif; ?>
        <?php if(Route::has('register')): ?>
            <a class="nav-link collapsed" href="<?php echo e(route('register')); ?>">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                <?php echo e(__('Register')); ?></a>
        <?php endif; ?>
    <?php else: ?>        
        <a class="nav-link collapsed" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-lock"></i>
            <?php echo e(__('Logout')); ?>

        </a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
    <?php endif; ?>
</li>



<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>


<?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/includes/sidebar.blade.php ENDPATH**/ ?>