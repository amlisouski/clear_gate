<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <div class="d-flex align-items-center"></div>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle pt-1 px-0"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img
                                class="avatar rounded-circle"
                                alt="<?php echo e(auth()->user()->first_name.' '.auth()->user()->last_name); ?>"
                                src="../../assets/img/team/profile-picture-6.jpg"
                            >
                            <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-small fw-bold text-gray-900">
                                    <?php echo e(auth()->user()->first_name.' '.auth()->user()->last_name); ?>

                                </span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                        <div class="dropdown-item d-flex align-items-start" href="#">
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('logout'),'onclick' => '
                            event.preventDefault();
                            this.closest(\'form\').submit();
                            ','style' => 'padding: 0 !important; color: orangered !important;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => '
                            event.preventDefault();
                            this.closest(\'form\').submit();
                            ','style' => 'padding: 0 !important; color: orangered !important;']); ?>
                                <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <?php echo e(__('Log Out')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH /var/www/html/resources/views/layouts/dashboard/_topbar.blade.php ENDPATH**/ ?>