<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> 
        <?php echo e(__('Dashboard')); ?>

     <?php $__env->endSlot(); ?>

    <div class="row w-100">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <p>Services provided in the amount of</p>
                    <h2 class="h2 total_provided_amount"></h2>
                </div>
                <div class="card-body">
                    <div class="provided_amount_chart"></div>
                </div>
            </div>

        </div>
    </div>

    <?php $__env->startSection('footer-scripts'); ?>
        <script src="<?php echo e(mix('js/dashboard.js')); ?>"></script>
        <script>
            let dashboard = new Dashboard();
            dashboard.init();
        </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/dashboard.blade.php ENDPATH**/ ?>