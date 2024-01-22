<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <form method="POST"
          <?php if($task): ?>
              action="<?php echo e(route('admin.tasks.update', $task)); ?>"
          <?php else: ?>
              action="<?php echo e(route('admin.tasks.store')); ?>"
          <?php endif; ?>
    >
        <?php if($task): ?>
            <?php echo method_field('PATCH'); ?>
        <?php endif; ?>
        <?php echo csrf_field(); ?>
        <div class="card card border-0 shadow mb-4">
            <div class="card-header text-end">
                <a class="btn btn-link btn-sm" href="<?php echo e(route('admin.tasks.index')); ?>">Cancel</a>
            </div>
            <div class="card-body">
                <div class="row form-group mb-2">
                    <label class="col-1 required">Title</label>
                    <div class="col-11">
                        <input type="text" class="form-control" name="title" value="<?php echo e($task?->title); ?>" />
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-1 required">Description</label>
                    <div class="col-11">
                        <textarea class="form-control" rows="10" name="description"><?php echo e($task?->description); ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <label class="col-1">Is Complete</label>
                    <div class="col-11">
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input"
                                   name="is_complete"
                                   value="1"
                                   <?php echo e($task?->is_complete ? 'checked' : ''); ?>

                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success btn-sm">Save task</button>
            </div>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/tasks/manage.blade.php ENDPATH**/ ?>