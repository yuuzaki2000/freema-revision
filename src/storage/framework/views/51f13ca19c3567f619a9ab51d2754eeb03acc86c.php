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
                    <div>
                        <img src="<?php echo e(asset($product->trade->seller->profile->image)); ?>" alt="ユーザー画像">
                    </div>
                    <h2>「<?php echo e($product->trade->seller->name); ?>」さんとの取引画面</h2>
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
                <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($content->user_id == Auth::id()): ?>
                    <div style="margin-left: 60%;"><p><?php echo e($content->content); ?></p></div>
                <?php else: ?>
                    <div><p><?php echo e($content->content); ?></p></div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <form action="/products/<?php echo e($product->id); ?>/trades/messages" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                    <input type="text" name="content" style="width:400px;" placeholder="取引メッセージを入力してください">
                    <label class="file-label">
                        画像を追加
                        <input type="file" name="file" class="file-input">
                    </label>
                    <input type="hidden" name="page" value="seller">
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
        <div class="modal" id="modal">
            <a href="#!" class="modal-overlay"></a>
            <div class="modal__inner">
                <div class="modal__content">
                    <form action="/star/<?php echo e($product->trade->id); ?>" method="POST" class="modal-container">
                        <?php echo csrf_field(); ?>
                        <h3>取引が完了しました</h3>
                        <p>今回の取引相手はどうでしたか？</p>
                        <select name="star_point">
                            <option value="">星の数を選択</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <input type="hidden" name="star_receiver_id" value="<?php echo e($product->trade->seller->id); ?>">
                        <button type="submit" class="star__btn">送信する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.trade', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/trade_chat_seller.blade.php ENDPATH**/ ?>