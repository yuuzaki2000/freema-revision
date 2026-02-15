<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/trade_chat.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        <div class="center-container">
            <div class="title-bar-container">
                <div>
                    <div style="height:50px;width:50px;">
                        <img src="<?php echo e(asset('storage/profile_img/' . $product->trade->buyer->profile->image)); ?>" alt="ユーザー画像" style="width:100%;">
                    </div>
                    <h2>「<?php echo e($product->trade->buyer->name); ?>」さんとの取引画面</h2>
                </div>
            </div>
            <div class="product-info-container">
                <div style="height:130px;width:130px;">
                    <img src="<?php echo e(asset($product->image)); ?>" alt="商品画像" style="width:100%;">
                </div>
                <div class="product-info">
                    <div class="product-name"><?php echo e($product->name); ?></div>
                    <div class="product-price"><?php echo e($product->price); ?>円</div>
                </div>
            </div>
            <div class="message-container">
                <div class="message-group">
                    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($content->user_id == Auth::id()): ?>
                            <div style="margin-left: 60%;"><p><?php echo e($content->content); ?></p></div>
                            <?php if($content->image): ?>
                            <div style="margin-left: 60%;">
                                <img src="<?php echo e(asset('storage/message_img/' . $content->image)); ?>" alt="画像メッセージ">
                            </div>
                            <?php endif; ?>
                            <div class="update-delete-btn" style="margin-left: 60%;font-weight:200;">
                                <form action="/products/<?php echo e($product->id); ?>/trades/messages/<?php echo e($content->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                    <button type="submit">編集</button>
                                </form>
                                <form class="delete-btn" action="/products/<?php echo e($product->id); ?>/trades/messages/<?php echo e($content->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                    <button type="submit">削除</button>
                                </form>
                            </div>
                        <?php else: ?>
                            <div><p><?php echo e($content->content); ?></p></div>
                            <?php if($content->image): ?>
                            <div>
                                <img src="<?php echo e(asset('storage/message_img/' . $content->image)); ?>" alt="画像メッセージ">
                            </div>
                            <div class="update-delete-btn" style="font-weight:200;">
                                <form action="/products/<?php echo e($product->id); ?>/trades/messages/<?php echo e($content->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                    <button type="submit">編集</button>
                                </form>
                                <form class="delete-btn" action="/products/<?php echo e($product->id); ?>/trades/messages/<?php echo e($content->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                    <button type="submit">削除</button>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <form action="/products/<?php echo e($product->id); ?>/trades/messages" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                    <input type="text" name="content" style="width:400px;" placeholder="取引メッセージを入力してください">
                    <label class="file-label">
                        画像を追加
                        <input type="file" name="file" class="file-input">
                    </label>
                    <input type="hidden" name="page" value="buyer">
                    <button type="submit"><i class="fa-regular fa-paper-plane"></i></button>
                    <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color:red;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color:red;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </form>
            </div>
        </div>
        <div class="modal" id="modal">
            <a href="#!" class="modal-overlay"></a>
            <div class="modal__inner">
                <div class="modal__content">
                    <div class="modal-container">
                        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('count', ['seller' => $product->trade->seller,'product' => $product])->html();
} elseif ($_instance->childHasBeenRendered('EOYdvCd')) {
    $componentId = $_instance->getRenderedChildComponentId('EOYdvCd');
    $componentTag = $_instance->getRenderedChildComponentTagName('EOYdvCd');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('EOYdvCd');
} else {
    $response = \Livewire\Livewire::mount('count', ['seller' => $product->trade->seller,'product' => $product]);
    $html = $response->html();
    $_instance->logRenderedChild('EOYdvCd', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.trade', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/trade_chat_seller.blade.php ENDPATH**/ ?>