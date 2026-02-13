<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/app_auth.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <header  class="header">
        <div class="header-text">
            <img src="<?php echo e(asset('img/logo.svg')); ?>" alt="ロゴ">
        </div>
    </header>
    <div class="main">
        <h2 class="inner-header">
            <?php echo $__env->yieldContent('title'); ?>
        </h2>
        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</body>
</html><?php /**PATH /var/www/resources/views/layouts/auth.blade.php ENDPATH**/ ?>