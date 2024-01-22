<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    <img src="../../assets/img/team/profile-picture-6.jpg"
                         class="card-img-top rounded-circle border-white"
                         alt="<?php echo e(auth()->user()->name); ?>">
                </div>
                <div class="d-block">
                    <h2 class="h5 mb-3">Hi, <?php echo e(auth()->user()->getFullName()); ?></h2>
                    <!-- Authentication -->
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu"
                   data-bs-toggle="collapse"
                   data-bs-target="#sidebarMenu"
                   aria-controls="sidebarMenu"
                   aria-expanded="true"
                   aria-label="Toggle navigation">
                    <svg class="icon icon-xs"
                         fill="currentColor"
                         viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
        <ul class="nav flex-column pt-3 pt-md-0">
            <li class="nav-item">
                <a href="/" class="nav-link d-flex align-items-center">
                      <span class="sidebar-icon">
                        <img src="../../assets/img/brand/light.svg" height="20" width="20" alt="Logo">
                      </span>
                    <span class="mt-1 ms-1"><strong><?php echo e(config('app.name')); ?></strong></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-link">
                      <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-grid-1x2" viewBox="0 0 16 16">
                          <path
                              d="M6 1H1v14h5zm9 0h-5v5h5zm0 9v5h-5v-5zM0 1a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm9 0a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1zm1 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1z"/>
                        </svg>
                      </span>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>


            <li class="nav-item">
                <a href="<?php echo e(route('admin.tasks.index')); ?>" class="nav-link">
                      <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-grid-1x2" viewBox="0 0 16 16">
                          <path
                                  d="M6 1H1v14h5zm9 0h-5v5h5zm0 9v5h-5v-5zM0 1a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm9 0a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1zm1 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1z"/>
                        </svg>
                      </span>
                    <span class="sidebar-text">Tasks</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH /var/www/html/resources/views/layouts/dashboard/_sidenav.blade.php ENDPATH**/ ?>