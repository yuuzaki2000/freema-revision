<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/product_detail.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="total-container">
    <div class="left-container">
        <div><img src="<?php echo e(asset($product->image)); ?>" alt="商品画像" width="400px"></div>
    </div>
    <div class="right-container">
        <div>
            <div class="title-name"><p><?php echo e($product->name); ?></p></div>
            <div class="title-price"><p><?php echo e($product->brand); ?></p></div>
            <div><p class="subtitle">&yen<?php echo e($product->price); ?></p></div>
            <div class="btn-group">
                <form action="/favorite/<?php echo e($product->id); ?>" method="post">
                <?php echo csrf_field(); ?>
                    <div>
                        <button type="submit">
                            <img src="<?php echo e(asset($imageUrl)); ?>" alt="いいね" width="30px" height="30px">
                        </button>
                        <p class="favorite-count"><?php echo e($favoriteCount); ?></p>
                    </div>
                </form>
                <div>
                    <div>
                        <img src="<?php echo e(asset('img/comment_icon.png')); ?>" alt="いいね" width="30px" height="30px">
                    </div>
                    <p class="comment-count"><?php echo e($comments->count()); ?></p>
                </div>
            </div>
            <form action="/purchase/<?php echo e($product->id); ?>" method="get">
                <button type="submit" class="btn">購入手続きへ</button>
            </form>
        </div>
        <div>
            <div class="subtitle"><p>商品説明</p></div>
            <div><?php echo e($product->description); ?></div>
        </div>
        <div>
            <div class="subtitle">商品の情報</div>
            <div class="category">
                <div class="item-label">カテゴリー</div>
                <div class="category-content">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="checkbox" id="category" class="checkbox" value="<?php echo e($category->id); ?>" <?php echo e(in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'checked' : ''); ?> name="category_product[]">
                    <label for="category" class="category-label"><?php echo e($category->content); ?></label>                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="condition">
                <div class="item-label">商品の状態</div>
                <div class="condition-content"><?php echo e($product->condition); ?></div>
            </div>
        </div>
        <div>
            <div class="subtitle">コメント（<?php echo e($comments->count()); ?>）</div>
            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="comment-container">
                    <div class="comment-header">
                        <?php if(isset($comment->user->profile->image)): ?>
                        <div class="profile-image-wrapper">
                            <img src="<?php echo e(asset($comment->user->profile->image)); ?>" alt="プロフィール画像" width="50px">
                        </div>
                        <?php endif; ?>
                        <div><?php echo e($comment->user->name); ?></div>
                    </div>
                    <div class="comment-content"><?php echo e($comment->content); ?></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </div>
        <form action="/comment/<?php echo e($product->id); ?>" method="post">
        <?php echo csrf_field(); ?>
            <div>
                <p>商品へのコメント</p>
            </div>
            <textarea name="content" cols="80" rows="8" class="product-comment"></textarea>
            <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div><p class="error-message"><?php echo e($errors->first('content')); ?></p></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <button type="submit" class="btn">コメントを送信する</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/product_detail.blade.php ENDPATH**/ ?>