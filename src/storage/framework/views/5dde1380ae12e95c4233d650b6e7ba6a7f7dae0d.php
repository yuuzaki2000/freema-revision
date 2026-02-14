<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/trade.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <div>
        <div class="header">
            <div class="header-text">
                <img src="<?php echo e(asset('img/logo.svg')); ?>" alt="ロゴ">
            </div>
        </div>
        <div class="main">
            <?php echo $__env->yieldContent('total-container'); ?>
        </div>
    </div>
</body>
</html><?php /**PATH /var/www/resources/views/layouts/trade.blade.php ENDPATH**/ ?>