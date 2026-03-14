<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <header  class="header">
        <div class="header-text">
            <img src="<?php echo e(asset('img/logo.svg')); ?>" alt="ロゴ">
        </div>
        <form action="/search" method="post">
        <?php echo csrf_field(); ?>
            <input type="text" class="keyword-input" name="keyword" placeholder="    なにをお探しですか？" value="<?php echo e($keyword); ?>">
        </form>
        <nav class="link">
            <form class="logout-form" action="/logout" method="post">
            <?php echo csrf_field(); ?>
                <button>
                    <p style="color:#fff">ログアウト</p>
                </button>
            </form>
            <form class="mypage-form" action="/mypage" method="get">
                <?php echo csrf_field(); ?>
                <button>
                    <p style="color:#fff">マイページ</p>
                </button>
            </form>
            <form class="sell-form" action="/sell" method="get">
            <?php echo csrf_field(); ?>
                <button class="sell-btn">
                    <p class="sell-txt">出品</p>
                </button>
            </form>
        </nav>
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
</html><?php /**PATH /var/www/resources/views/layouts/app_keyword.blade.php ENDPATH**/ ?>