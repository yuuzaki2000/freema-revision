<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/mypage.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div class="upper">
        <?php if(isset($profile)): ?>
        <div>
            <img src="<?php echo e(asset('storage/profile_img/' . $profile->image)); ?>" alt="プロフィール画像">
        </div>
        <?php endif; ?>
        <h2><?php echo e($profile->user->name); ?></h2>
        <?php
            $stars = App\Models\Star::where('user_id', $profile->user_id)->get();
            $stars_count = $stars->count();
            if($stars){
                $star_point = round($stars->pluck('point')->avg());
            }else{
                $star_point = 0;
            }
            
        ?>
        <div class="stars">
            <?php if($star_point < 1): ?>
                <div></div>
            <?php else: ?>
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <span class="<?php echo e($i <= $star_point ? 'filled' : ''); ?>">★</span>
                <?php endfor; ?>   
            <?php endif; ?>
        </div>
        <a href="/mypage/profile" class="skt-btn">プロフィールを編集</a>
    </div>
    <div class="bottom">
        <form action="/mypage" method="get" class="exhibition">
            <input type="hidden" name="page" value="sell">
            <button type="submit" class="exhibition-btn">出品した商品</button>
        </form>
        <form action="/mypage" method="get" class="purchase">
            <input type="hidden" name="page" value="buy">
            <button type="submit" class="purchase-btn">購入した商品</button>
        </form>
        <form action="/mypage" method="get" class="purchase">
            <input type="hidden" name="page" value="trade">
            <button type="submit" class="purchase-btn">取引中の商品</button>
            
            <?php
                $message_count = App\Models\Trade::where('seller_id', Auth::id())->get()->count();
            ?>
            <?php if($message_count): ?>
                <div class="icon-wrapper">
                    <span class="badge"><?php echo e($message_count); ?></span>
                </div>
            <?php else: ?>
                <div><p></p></div>
            <?php endif; ?>
        </form>
    </div>
    <div class="container">
        <?php
            $particularProducts = $products->sortBy('created_at');
            //変更要
        ?>
        <ul class="group">
                <?php if($products->count() > 0): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        if($product->trade){
                            $message_count = App\Models\Message::where('trade_id', $product->trade->id)
                                        ->whereHas('trade', function ($query) {
                                                $query->where('seller_id', Auth::id());
                                        })->count();
                        }else{
                            $message_count = 0;
                        }
                    ?>
                    <li class="compartment">
                        <form action="/products/<?php echo e($product->id); ?>/trades" class="item" method="GET">
                            <?php echo csrf_field(); ?>
                                    <?php if($message_count): ?>
                                        <div class="icon-wrapper">
                                            <span class="badge"><?php echo e($message_count); ?></span>
                                        </div>
                                    <?php else: ?>
                                        <div><p></p></div>
                                    <?php endif; ?>
                                <button type="submit"><img src="<?php echo e(asset($product->image)); ?>" alt="商品画像" width="100%"></button>
                                <div class="product-info">
                                    <p><?php echo e($product->name); ?></p>
                                </div>
                        </form>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/mypage.blade.php ENDPATH**/ ?>