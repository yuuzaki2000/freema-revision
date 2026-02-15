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
            $content = session('content','');
        ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('test', ['sideTrades' => $side_trades,'product' => $product,'contents' => $contents,'side_trades' => $side_trades,'content' => $content])->html();
} elseif ($_instance->childHasBeenRendered('SHphG1x')) {
    $componentId = $_instance->getRenderedChildComponentId('SHphG1x');
    $componentTag = $_instance->getRenderedChildComponentTagName('SHphG1x');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('SHphG1x');
} else {
    $response = \Livewire\Livewire::mount('test', ['sideTrades' => $side_trades,'product' => $product,'contents' => $contents,'side_trades' => $side_trades,'content' => $content]);
    $html = $response->html();
    $_instance->logRenderedChild('SHphG1x', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
    $html = \Livewire\Livewire::mount('count', ['seller' => $product->trade->seller,'product' => $product])->html();
} elseif ($_instance->childHasBeenRendered('EF7dki9')) {
    $componentId = $_instance->getRenderedChildComponentId('EF7dki9');
    $componentTag = $_instance->getRenderedChildComponentTagName('EF7dki9');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('EF7dki9');
} else {
    $response = \Livewire\Livewire::mount('count', ['seller' => $product->trade->seller,'product' => $product]);
    $html = $response->html();
    $_instance->logRenderedChild('EF7dki9', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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


<?php echo $__env->make('layouts.trade', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/trade_chat_buyer.blade.php ENDPATH**/ ?>