<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['status', 'message']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['status', 'message']); ?>
<?php foreach (array_filter((['status', 'message']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php $__env->startPush('footer-scripts'); ?>
    <script type="text/javascript">
        const notyf = new Notyf();
        notyf.<?php echo e($status?'success':'error'); ?>('<?php echo e(__($message)); ?>');
    </script>
<?php $__env->stopPush(); ?>

<?php /**PATH /var/www/html/resources/views/components/notyf.blade.php ENDPATH**/ ?>