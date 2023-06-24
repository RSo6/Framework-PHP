<div class="modal-body">
    <?php if (!empty($_SESSION['cart'])) :  ?>
    <div class="table-responsive cart-table">
    <table class="table text-start">
        <thead>
        <tr>
            <th scope="col"><?php __('tpl_footer_top_cart_photo'); ?></th>
            <th scope="col"><?php __('tpl_footer_top_cart_product'); ?></th>
            <th scope="col"><?php __('tpl_footer_top_cart_quantity'); ?></th>
            <th scope="col"><?php __('tpl_footer_top_cart_price'); ?></th>
            <th scope="col"><i class="far fa-trash-alt"></i></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['cart'] as $id => $item) : ?>
        <tr>
            <td>
                <a href="product/<?php echo $item['slug'] ?>"><img src ="<?php echo PATH . $item['img']?>" alt=""></a>
            </td>
            <td><a href="product/<?php echo $item['slug'] ?>"<?php echo $item['title']?></a></td>
            <td><?php
                echo $item['qty']; ?></td>
            <td><?php echo $item['price']?></td>
            <td><a href="cart/delete?id=<?php
                echo $id ?>" data-id= "<?php echo $id ?>" class="del-item"><i class="far fa-trash-alt"></i></a></td>
        </tr>
        <?php endforeach;  ?>
        <tr>
            <td colspan="4" class="text-end"><?php __('tpl_cart_total_qty') ?></td>
            <td class="cart-qty"><?php echo $_SESSION['cart.qty'] ?></td>
        </tr>
        <tr>
            <td colspan="4" class="text-end"><?php __('tpl_cart_total_sum') ?></td>
            <td class="cart-sum">$<?php echo $_SESSION['cart.sum'] ?></td>
        </tr>
        </tbody>
    </table>
    </div>
    <?php else: ?>
    <h4 class = "text-start"><?php __('tpl_cart_empty')?></h4>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success ripple" data-bs-dismiss="modal">
        <?php __('tpl_footer_top_cart_continue_shop'); ?></button>
    <?php if (!empty($_SESSION['cart'])) : ?>
    <a href="cart/view" class="btn btn-primary"><?php __('tpl_footer_top_cart_complete_order') ?></a>
    <button type="button" id="clear-cart" class="btn btn-danger"><?php __('tpl_footer_top_clear_cart') ?></button>
    <?php endif; ?>
</div>