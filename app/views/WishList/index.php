<?php


/** @var $this \wfm\View */
/** @var $products array */
?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <ol class="breadcrumb bg-light p-2">
                <li class="breadcrumb-item">
                    <a href="<?php echo baseUrl(); ?>"><i class="fas fa-home"></i></a>
                </li>
                <li class="breadcrumb-item"><?php __('wishlist_index_title')?></li></ol>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="container py-3">
            <div class="row">

                <div class="col-lg-12 category-content">
                    <h1 class="section-title"><?php __('wishlist_index_title');?></h1>


                    <div class="row">
                        <?php if (!empty($products)): ?>
                            <?php $this->getPart('parts/products_loop', compact('products')); ?>



                        <?php else: ?>
                            <p><?php __('wishlist_index_not_found'); ?></p>
                        <?php endif; ?>



                    </div>

            </div>

        </div>

    </div>
</div>


