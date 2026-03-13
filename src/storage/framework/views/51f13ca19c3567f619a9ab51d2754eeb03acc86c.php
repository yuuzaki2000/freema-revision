<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/trade_chat.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<?php echo \Livewire\Livewire::styles(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('total-container'); ?>
<div class="total-container">
    <div class="side-bar">
        <p class="side-bar-title">その他の取引</p>
        <?php $__currentLoopData = $side_trades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form action="/products/<?php echo e($trade->product->id); ?>/trades" method="GET">
                <?php echo csrf_field(); ?>
                <button type="submit">取引<?php echo e($trade->id); ?></button>
            </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="center">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('seller', ['sideTrades' => $side_trades,'product' => $product,'side_trades' => $side_trades,'partner' => $product->trade->buyer])->html();
} elseif ($_instance->childHasBeenRendered('PIS1MeT')) {
    $componentId = $_instance->getRenderedChildComponentId('PIS1MeT');
    $componentTag = $_instance->getRenderedChildComponentTagName('PIS1MeT');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('PIS1MeT');
} else {
    $response = \Livewire\Livewire::mount('seller', ['sideTrades' => $side_trades,'product' => $product,'side_trades' => $side_trades,'partner' => $product->trade->buyer]);
    $html = $response->html();
    $_instance->logRenderedChild('PIS1MeT', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <div class="modal" id="modal">
            <a href="#!" class="modal-overlay"></a>
            <div class="modal__inner">
                <div class="modal__content">
                    <div class="modal-container">
                        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('count', ['partner' => $product->trade->buyer,'product' => $product])->html();
} elseif ($_instance->childHasBeenRendered('0hupKUJ')) {
    $componentId = $_instance->getRenderedChildComponentId('0hupKUJ');
    $componentTag = $_instance->getRenderedChildComponentTagName('0hupKUJ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('0hupKUJ');
} else {
    $response = \Livewire\Livewire::mount('count', ['partner' => $product->trade->buyer,'product' => $product]);
    $html = $response->html();
    $_instance->logRenderedChild('0hupKUJ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo \Livewire\Livewire::scripts(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.trade', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/trade_chat_seller.blade.php ENDPATH**/ ?>