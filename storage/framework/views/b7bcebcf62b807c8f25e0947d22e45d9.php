<header>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="mobile_logo">
         <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">        
       <img class="logo" src="<?php echo e(asset('images/hawaiiproclean.jpg')); ?>" />
    </a>
    </div>
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>



    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-lock"></i>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Login/Logout</span>
                
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                
                <?php if(auth()->guard()->guest()): ?>
                    <?php if(Route::has('login')): ?>
                        <a class="dropdown-item" href="<?php echo e(route('login')); ?>">
                            <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            <?php echo e(__('Login')); ?></a>
                    <?php endif; ?>
                    <?php if(Route::has('register')): ?>
                        <a class="dropdown-item" href="<?php echo e(route('register')); ?>">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            <?php echo e(__('Register')); ?></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a id="navbarDropdown" class="dropdown-item" href="#" role="button" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo e(Auth::user()->name); ?>

                    </a>
                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <?php echo e(__('Logout')); ?>

                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>

                <?php endif; ?>
            </div>
        </li>

    </ul>

</nav>
</header><?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/includes/header.blade.php ENDPATH**/ ?>