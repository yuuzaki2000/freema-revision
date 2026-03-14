        <div class="center-container">
            <div class="title-bar-container">
                <div class="partner-user-info">
                    <div style="height:50px;width:50px;">
                        <img src="<?php echo e(asset('storage/profile_img/' . $product->trade->seller->profile->image)); ?>" alt="ユーザー画像" style="width:100%;">
                    </div>
                    <h2>「<?php echo e($product->trade->seller->name); ?>」さんとの取引画面</h2>
                </div>
                <form action="/products/<?php echo e($product->id); ?>/trades/<?php echo e($product->trade->id); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="trade-complete__btn">取引を完了する</button>
                </form>
            </div>
            <div class="product-info-container">
                <div class="product-img" style="height:130px;width:130px;">
                    <img src="<?php echo e(asset($product->image)); ?>" alt="商品画像" style="width:100%;">
                </div>
                <div class="product-info">
                    <div class="product-name"><?php echo e($product->name); ?></div>
                    <div class="product-price"><?php echo e($product->price); ?>円</div>
                </div>
            </div>
            <div class="message-container">
                <div class="message-group">
                    <?php
                        $messages = App\Models\Message::where('trade_id', $product->trade->id)->get();
                    ?>
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($message->user_id == Auth::id()): ?>
                            <form action="/products/<?php echo e($product->id); ?>/trades/messages/<?php echo e($message->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="update-delete-btn">
                                    <div class="partner-user-info" style="height:50px;width:50px;">
                                        <img src="<?php echo e(asset('storage/profile_img/' . $product->trade->buyer->profile->image)); ?>" alt="ユーザー画像" style="width:100%;">
                                        <p><?php echo e($product->trade->buyer->name); ?></p>
                                    </div>
                                </div>
                                <?php if($message->image): ?>
                                <div class="update-delete-btn">
                                    <img src="<?php echo e(asset('storage/message_img/' . $message->image)); ?>" alt="画像メッセージ">
                                </div>
                                <?php endif; ?>
                                <div class="update-delete-btn" x-data="{ editable: false, msg : '<?php echo e(addslashes($message->content)); ?>' }">
                                    <input type="text" 
                                        class="input-message"
                                        name="message"
                                        x-model ="msg"
                                        :readonly="!editable" 
                                        :style="editable ? 'border: 1px solid #000;' : 'border: none; outline: none;'">
                                    <?php echo method_field('PATCH'); ?>
                                    <div>
                                        <template x-if="!editable">
                                            <button type="button" @click="editable = true">編集</button>
                                        </template>

                                        <template x-if="editable">
                                            <button type="button" @click="editable = false; $wire.save(<?php echo e($message->id); ?>, msg);">保存</button>
                                        </template>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit">削除</button>
                                    </div>
                                </div>
                            </form>
                        <?php else: ?>
                            <div class="user-info_chat" style="height:50px;width:50px;">
                                <img src="<?php echo e(asset('storage/profile_img/' . $product->trade->seller->profile->image)); ?>" alt="ユーザー画像" style="width:100%;">
                                <p><?php echo e($product->trade->seller->name); ?></p>
                            </div>
                            <div class="my-message-container"><p><?php echo e($message->content); ?></p></div>
                            <?php if($message->image): ?>
                            <div>
                                <img src="<?php echo e(asset('storage/message_img/' . $message->image)); ?>" alt="画像メッセージ">
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <form action="/products/<?php echo e($product->id); ?>/trades/messages" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                    <input type="text" name="content" wire:model="content" style="width:400px;" placeholder="取引メッセージを入力してください" class="content-decolation">
                    <label class="file-label">
                        画像を追加
                        <input type="file" name="file" class="file-input">
                    </label>
                    <input type="hidden" name="page" value="buyer">
                    <button type="submit"><i class="fa-regular fa-paper-plane"></i></button>
                    <?php $__errorArgs = ['message'];
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
        <style> 
.center-container {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.title-bar-container {
    height: 15%;
    display: flex;
    flex-direction: row;
    justify-message: space-between;
}

.trade-complete__btn {
    background-color: #FF8282;
    color: #FFF;
    width: 20vh;
    height: 4vh;
    border-radius: 2vh;
}

.product-info-container {
    height: 20%;
    border-top: 2px solid #000;
    display: flex;
    flex-direction: row;
}

.product-name {
    font-weight: bold;
    font-size: 20px;
}

.product-info {
    display: flex;
    flex-direction: column;
    justify-message: space-around;
    margin-left: 20px;
}

.message-container {
    height: 65%;
    border-top: 2px solid #000;
    display: flex;
    flex-direction: column;
    justify-message: space-between;
}

.product-img__wrapper {
    width: 50px;
}

.product-img {
    width: 100%;
}

.file-input {
    display: none;
}

.file-label {
    display: inline-block;
    padding: 10px 20px;
    background-color: blue;
    color: #FFF;
    border-radius: 4px;
    cursor: pointer;
}

.delete-btn {
    margin-left: 15px;
}

.product-info-container {
    height: 160px;
}

.product-img {
    margin: 10px 0 5px 10px;
}

.user-info_chat {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.content-decolation {
    border: 1px solid #000;
}

.my-message-container {
    background-color: #D9D9D9;
    width:300px;
}

.partner-user-info {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.input-message {
    background-color: #D9D9D9;
    width:300px;
}

.update-delete-btn {
    display: flex;
    flex-direction: column;
    margin-left:50%;
}

@media  screen and (min-width: 768px) and (max-width: 850px) {
    .update-delete-btn {
        display: flex;
        flex-direction: column;
        margin-left:30%;
    }
}

@media  screen and (min-width: 1400px) and (max-width: 1540px) {
    .update-delete-btn {
        display: flex;
        flex-direction: column;
        margin-left:70%;
    }
}
        </style>

<?php /**PATH /var/www/resources/views/livewire/buyer.blade.php ENDPATH**/ ?>