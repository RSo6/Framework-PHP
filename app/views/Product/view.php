<?php

use app\controllers\ProductController;
use app\controllers\UserController;
use app\models\User;
use wfm\App;
use wfm\View;


/** @var $this View */

$id = get('id');
$lang = App::$app->getProperty('language');



?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <?php echo $bread_crumbs ?>
        </ol>
    </nav>
</div>


<div class="container py-3">
    <div class="row">

        <div class="col-md-4 order-md-2">

            <h1><?php echo $product['title'] ?></h1>

            <ul class="list-unstyled">
                <li><i class="fas fa-check text-success"></i> В наличии</li>
                <li><i class="fas fa-shipping-fast text-muted"></i> Ожидается</li>
                <li><i class="fas fa-hand-holding-usd"></i> <span class="product-price">
                        <?php if ($product['old_price']): ?>
                            <small>$<?php echo $product['old_price'] ?></small>
                        <?php endif; ?>
                        $<?php echo $product['price'] ?>
                </li>
            </ul>
            <?php var_dump($product['id']);?>
    <?php if ($product['is_download'] && User::checkAuth() && User::CheckProductStatus($product['id'])): ?>
<a href="user/download?id=<?php echo User::getDownloadId($product['id'])?>">
    <button class="btn btn-danger download" type="button" >
        <?php __('tpl_product_language_toggler_download'); ?>
    </button></a>
<?php endif; ?>

<?php if (!(User::CheckProductStatus($product['id'])) && User::checkAuth() || User::CheckProductStatus($product['id']) && !($product['is_download']) || !(User::checkAuth())) : ?>
       <button class="btn btn-danger add-to-cart" type="button"
     data-id="<?php echo $product['id'] ?>"><?php __('tpl_product_language_toggler_buy'); ?></button>
   <?php endif; ?>
<!-- </a>-->
 </div>


        </div>

        <div class="col-md-8 order-md-1">

            <ul class="thumbnails list-unstyled clearfix">

                <li class="thumb-main text-center"><a class="thumbnail" href="<?php echo PATH . $product['img'] ?>"
                                                      data-effect="mfp-zoom-in"><img src="<?php echo PATH . $product['img'] ?>"
                                                                                     alt=""></a></li>

                <?php if (!empty($gallery)): ?>
                    <?php foreach ($gallery as $item): ?>
                        <li class="thumb-additional"><a class="thumbnail" href="<?php echo PATH . $item['img'] ?>" data-effect="mfp-zoom-in"><img src="<?= PATH . $item['img'] ?>" alt=""></a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>

            <?php echo $product['content']; ?>


        </div>

    </div>
</div>