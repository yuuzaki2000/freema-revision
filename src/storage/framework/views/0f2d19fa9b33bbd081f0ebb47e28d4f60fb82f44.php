<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/address_change.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<div class="title">住所の変更</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="container">
    <form class="inner" action="/purchase/address/<?php echo e($product->id); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="content">
            <div>
                <p>郵便番号</p>
                <input class="input" type="text" name="post_code" value=<?php echo e($post_code); ?>>
            </div>
            <?php $__errorArgs = ['post_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div>
                <p class="error-message"><?php echo e($errors->first('post_code')); ?></p>
            </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div>
                <p>住所</p>
                <input class="input" type="text" name="address" value=<?php echo e($address); ?>>
            </div>
            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div>
                <p class="error-message"><?php echo e($errors->first('address')); ?></p>
            </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div>
                <p>建物名</p>
                <input class="input" type="text" name="building" value=<?php echo e($building); ?>>
            </div>
            <?php $__errorArgs = ['building'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div>
                <p class="error-message"><?php echo e($errors->first('building')); ?></p>
            </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <button type="submit" class="btn">更新する</button>
        </div>
    </form>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/address_change.blade.php ENDPATH**/ ?>