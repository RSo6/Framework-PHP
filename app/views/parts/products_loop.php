<?php
/** @var $products array */
?>
<?php foreach ($products as $product): ?>
    <div class="col-lg-4 col-sm-6 mb-3">
        <div class="product-card">
            <div class="product-tumb">
                <a href="product/<?php echo $product['slug'] ?>"><img src="<?php echo PATH . $product['img'] ?>" alt=""></a>
            </div>
            <div class="product-details">
                <h4><a href="product/<?php echo $product['slug'] ?>"><?php echo $product['title'] ?></a></h4>
                <p><?= $product['exerpt'] ?></p>
                <div class="product-bottom-details d-flex justify-content-between">
                    <div class="product-price">
                        <?php if ($product['old_price']): ?>
                            <small>$<?php echo $product['old_price'] ?></small>
                        <?php endif; ?>
                        $<?php echo $product['price'] ?></div>
                    <div class="product-links">
                        <a href="#"><i class="fas fa-shopping-cart"></i></a>
                        <a href="#"><i class="far fa-heart"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
