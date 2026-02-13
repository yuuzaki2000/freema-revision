<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/member_login.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
ログイン    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form class="inner" action="/login" method="post">
    <?php echo csrf_field(); ?>
        <div class="content">
            <div>
                <p>メールアドレス</p>
                <input class="input" type="text" name="email">
            </div>
            <div>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($errors->first('email')); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <p>パスワード</p>
                <input class="input" type="password" name="password">
            </div>
            <div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error-message"><?php echo e($errors->first('password')); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button type="submit" class="btn">ログインする</button>
            <div class="register-text-container"><a href="/register" class="register-text">会員登録はこちら</a></div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/auth/login.blade.php ENDPATH**/ ?>