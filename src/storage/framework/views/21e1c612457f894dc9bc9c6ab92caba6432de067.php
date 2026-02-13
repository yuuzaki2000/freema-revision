<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/app_wide.css')); ?>">
<?php echo \Livewire\Livewire::styles(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('purchase-cover', ['postCode' => ''.e($post_code).'','productId' => ''.e($product->id).'','post_code' => ''.e($post_code).'','address' => ''.e($address).'','building' => ''.e($building).''])->html();
} elseif ($_instance->childHasBeenRendered('RUPswYB')) {
    $componentId = $_instance->getRenderedChildComponentId('RUPswYB');
    $componentTag = $_instance->getRenderedChildComponentTagName('RUPswYB');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('RUPswYB');
} else {
    $response = \Livewire\Livewire::mount('purchase-cover', ['postCode' => ''.e($post_code).'','productId' => ''.e($product->id).'','post_code' => ''.e($post_code).'','address' => ''.e($address).'','building' => ''.e($building).'']);
    $html = $response->html();
    $_instance->logRenderedChild('RUPswYB', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <?php echo \Livewire\Livewire::scripts(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/purchase.blade.php ENDPATH**/ ?>