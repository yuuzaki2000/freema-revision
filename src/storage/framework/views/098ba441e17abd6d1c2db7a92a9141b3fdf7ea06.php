<div>
    <form action="/mypage/profile" method="post" class="inner" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if(empty($profile)): ?>
        <div class="content">
            <h2 class="inner-header">プロフィール設定</h2>
            <div class="upper-container">
                <div>
                    <img class="profile-image" src="<?php echo e(asset($photo_path)); ?>" alt="プロフィール画像" width="200px" height="200px">
                    <input type="file" class="file-button" name="file" wire:model="photo">
                    <input type="hidden" name="image" value="<?php echo e($photo_path); ?>">
                </div>
            </div>
            <div>
                
            </div>
            <div>
                <p>ユーザー名</p>
                <input class="input" type="text" name="name" value="<?php echo e($user->name); ?>">
                <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
            </div>
            <div>
                <p>郵便番号</p>
                <input class="input" type="text" name="post_code" value=<?php echo e(old('post_code')); ?>>
            </div>
            <div>
                <p>住所</p>
                <input class="input" type="text" name="address" value=<?php echo e(old('address')); ?>>
            </div>
            <div>
                <p>建物名</p>
                <input class="input" type="text" name="building" value=<?php echo e(old('building')); ?>>
            </div>
            <button type="submit" class="btn">更新する</button>
        </div>
    <?php else: ?>
        <?php echo method_field('PATCH'); ?>
        <div class="content">
            <h2 class="inner-header">プロフィール編集</h2>
            <div class="upper-container">
                <div>
                    <img class="profile-image" src="<?php echo e(asset($photo_path)); ?>" alt="プロフィール画像" width="200px" height="200px">
                </div>
                <input type="file" class="file-button" name="file" wire:model="photo">
                <input type="hidden" name="image" value="<?php echo e($photo_path); ?>">
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div><p class="error-message"><?php echo e($errors->first('image')); ?></p></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <p>ユーザー名</p>
                <input class="input" type="text" name="name" value="<?php echo e($user->name); ?>">
                <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div><p class="error-message"><?php echo e($errors->first('user_id')); ?></p></div>                    
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <p>郵便番号</p>
                <input class="input" type="text" name="post_code" value=<?php echo e($profile->post_code); ?>>
                <?php $__errorArgs = ['post_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div><p class="error-message"><?php echo e($errors->first('post_code')); ?></p></div>                    
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <p>住所</p>
                <input class="input" type="text" name="address" value=<?php echo e($profile->address); ?>>
                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div><p class="error-message"><?php echo e($errors->first('address')); ?></p></div>                    
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <p>建物名</p>
                <input class="input" type="text" name="building" value=<?php echo e($profile->building); ?>>
                <?php $__errorArgs = ['building'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div><p class="error-message"><?php echo e($errors->first('building')); ?></p></div>                    
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <button type="submit" class="btn">更新する</button>
            </div>
        </div>
    <?php endif; ?>
    </form>
</div>
<style>
.inner-header {
    text-align: center;
}
.error-message {
    color: #FF5555;
}

.upper-container {
    display: flex;
}

.profile-image {
}

.file-button {
    padding:100px 0px;
    height: 50px;
    width: 200px;
}

.file-button::file-selector-button {
    top: 50%;
    width:195px;
    color: #ff5555;
    background-color: #FFF;
    border: 1px solid #ff5555;
    border-radius: 10px;
    text-align: center;
}
</style>

<?php /**PATH /var/www/resources/views/livewire/profile-cover.blade.php ENDPATH**/ ?>