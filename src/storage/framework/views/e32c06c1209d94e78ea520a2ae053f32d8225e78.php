<div  class="container">
    <div class="left-side">
        <div class="upper">
            <div class="upper-left">
                <img src="<?php echo e(asset($productImage)); ?>" alt="" width="60%">
            </div>
            <div class="upper-right">
                <p><?php echo e($productName); ?></p>
                <p>&yen<?php echo e($productPrice); ?></p>
            </div>
        </div>
        <div class="middle">
            <div>
                <p>支払い方法</p>
            </div>
            <select wire:model="paymentMethod" name="payment_method" class="select">
                <option value="選択してください" selected disabled>選択してください</option>
                <option value="コンビニ支払">コンビニ支払</option>
                <option value="カード支払い">カード支払い</option>
            </select>
            <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($errors->first('payment_method')); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="bottom">
            <div class="shipping">
                <p>配送先:</p>
                <button wire:click="getAddressChange(<?php echo e($product->id); ?>)">変更する</button>
            </div>
            <div>
                <?php if(isset($post_code)): ?>
                    <input type="text" value="<?php echo e($post_code); ?>">
                <?php endif; ?>
                <?php if(isset($address)): ?>
                    <input type="text" value="<?php echo e($address); ?>">                    
                <?php endif; ?>
                <?php if(isset($building)): ?>
                    <input type="text" value="<?php echo e($building); ?>">                    
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="right-side">
        <table border="1" class="table">
            <tr>
                <td>商品代金</td>
                <th>&yen<?php echo e($productPrice); ?></th>
            </tr>
            <tr class="payment">
                <td>支払方法</td>
                <th><?php echo e($paymentMethod); ?></th>
            </tr>
        </table>
        <form  action="/checkout" method="post">
        <?php echo csrf_field(); ?>
            <div>
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            </div>
            <div>
                <?php if(isset($post_code)): ?>
                    <input type="hidden" name="post_code" value="<?php echo e($post_code); ?>">
                <?php endif; ?>
                <?php if(isset($address)): ?>
                    <input type="hidden" name="address" value="<?php echo e($address); ?>">                    
                <?php endif; ?>
                <?php if(isset($building)): ?>
                    <input type="hidden" name="building" value="<?php echo e($building); ?>">                    
                <?php endif; ?>
            </div>
            <div>
                <input type="hidden" name="payment_method" value="<?php echo e($paymentMethod); ?>">
            </div>
            <div>
                <button type="submit" class="btn">購入する</button>
            </div>
        </form>
    </div>
</div>
<style>
    .error-message {
        color: #FF5555;
    }
    
    .upper {
        width:100%;
        display: flex;
        padding-bottom: 40px;
        border-bottom: 1px solid #000;
    }

    .container {
        display: flex;
        justify-content: space-between;
    }

    .left-side {
        width:60%;
    }

    .right-side {
        width:30%;
    }

    .upper {

    }

    .upper-left {
        width:25%;
    }

    .upper-right {
        width:75%;
    }

    .middle {
        height:200px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        padding-bottom: 40px;
        border-bottom: 1px solid #000;
        margin-bottom: 30px;
    }

    .select {
        border:1px solid #000;
    }

    .shipping {
        display: flex;
        justify-content:space-between;
    }

    .table {
        border:1px solid #000;
        width:400px;
        border-collapse: collapse;
    }

    .payment {
        border-top:1px solid #000;
    }

    .btn {
        width: 400px;
        height: 40px;
        background-color: #FF5555;
        color: #fff;
        margin-top: 60px;
    }

    th, td{
        padding:10px 30px;
    }
</style>
<?php /**PATH /var/www/resources/views/livewire/purchase-cover.blade.php ENDPATH**/ ?>