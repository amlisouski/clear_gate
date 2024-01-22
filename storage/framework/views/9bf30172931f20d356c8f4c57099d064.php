<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>







    <div class="card card border-0 shadow mb-4">
        <div class="card-header text-end">
            <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.tasks.create')); ?>">Create new task</a>
        </div>
        <div class="card-body">
            <?php if(!$tasks->count()): ?>
                <span>There are no tasks yet.</span>
            <?php else: ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                        <td>Description</td>
                        <td>Is Complete</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($task->id); ?></td>
                            <td><?php echo e($task->title); ?></td>
                            <td><?php echo e($task->description); ?></td>
                            <td data-url="<?php echo e(route('admin.tasks.complete', $task)); ?>">
                                <?php if($task->is_complete): ?>
                                    <button type="button" class="btn btn-success btn-sm task-complete">
                                        <i class="fa fa-check"></i>
                                    </button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-info btn-sm task-complete">
                                        <i class="fa fa-times"></i>
                                    </button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.tasks.edit', $task)); ?>">
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm remove-task" data-url="<?php echo e(route('admin.tasks.destroy', $task)); ?>">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <?php $__env->startPush('footer-scripts'); ?>
        <script type="text/javascript">
            let TASKS = {
                init () {
                    $('.remove-task').on('click', TASKS.removeTask);
                    $('.task-complete').on('click', TASKS.completeTask);
                },

                completeTask() {
                    let btn = $(this);
                    let url = $(this).parent().attr('data-url');
                    $.ajax({
                        url: url,
                        data: {
                            '_token': '<?php echo e(csrf_token()); ?>',
                        },
                        dataType: "json",
                        type: "PATCH",
                        cache: false,
                        success: function (response) {
                            const notyf = new Notyf();
                            notyf.success('<?php echo e(__('Task successfully updated.')); ?>')
                            if (response.is_complete) {
                                btn.removeClass('btn-info').addClass('btn-success')
                                        .find('.fa').removeClass('fa-times').addClass('fa-check');
                            } else {
                                btn.removeClass('btn-success').addClass('btn-info')
                                        .find('.fa').removeClass('fa-check').addClass('fa-times');
                            }
                        },
                        error: function (response) {
                            console.log(response);
                            alert('Something goes wrong during task updating.');
                        }
                    });
                },

                removeTask() {
                    if (confirm('Are you sure you want to delete this task?')) {
                        let url = $(this).attr('data-url');
                        let row = $(this).parents('.row:first');
                        $.ajax({
                            url: url,
                            data: {
                                '_token': '<?php echo e(csrf_token()); ?>',
                            },
                            dataType: "json",
                            type: "DELETE",
                            cache: false,
                            success: function (response) {
                                const notyf = new Notyf();
                                notyf.success('<?php echo e(__('Task successfully deleted.')); ?>')
                                row.remove();
                            },
                            error: function (response) {
                                console.log(response);
                                alert('Something goes wrong during task deletion');
                            }
                        });
                    }
                }
            };

            $(document).ready(TASKS.init);
        </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /var/www/html/resources/views/tasks/index.blade.php ENDPATH**/ ?>