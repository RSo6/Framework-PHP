<?php
use wfm\View;
/** @var $this View */
?>
<footer>
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <h4><?php __('main_index_footer_information'); ?></h4>
                    <ul class="list-unstyled">
                        <li><a href="#"><?php __('main_index_footer_main'); ?></a></li>
                        <li><a href="#"><?php __('main_index_footer_about_shop'); ?></a></li>
                        <li><a href="#"><?php __('main_index_footer_pay_and_delivery'); ?></a></li>
                        <li><a href="#"><?php __('main_index_footer_contacts'); ?></a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?php __('main_index_footer_work-time'); ?></h4>
                    <ul class="list-unstyled">
                        <li><?php __('main_index_footer_address'); ?></li>
                        <li><?php __('main_index_footer_work-days'); ?></li>
                        <li><?php __('main_index_footer_without_brakes'); ?></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?php __('main_index_footer_nameSecond-contacts'); ?></h4>
                    <ul class="list-unstyled">
                        <li><a href="tel:5551234567"><?php __('main_index_footer_call_numbers'); ?></a></li>
                        <li><a href="tel:5551234567"><?php __('main_index_footer_call_numbers'); ?></a></li>
                        <li><a href="tel:5551234567"><?php __('main_index_footer_call_numbers'); ?></a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?php __('main_index_footer_We_in_network'); ?></h4>
                    <div class="footer-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>

<button id="top">
    <i class="fas fa-angle-double-up"></i>
</button>

<div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php __('main_index_footer_top_cart'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table text-start">
                    <thead>
                    <tr>
                        <th scope="col"><?php __('main_index_footer_top_cart_photo'); ?></th>
                        <th scope="col"><?php __('main_index_footer_top_cart_product'); ?></th>
                        <th scope="col"><?php __('main_index_footer_top_cart_quantity'); ?></th>
                        <th scope="col"><?php __('main_index_footer_top_cart_price'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <a href="#"><img src="<?php echo PATH ?>/assets/img/products/apple_cinema_30.jpg" alt=""></a>
                        </td>
                        <td><a href="#">Apple cinema</a></td>
                        <td>1</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#"><img src="<?php echo PATH ?>/assets/img/products/canon_eos_5d_1.jpg" alt=""></a>
                        </td>
                        <td><a href="#">Canon EOS</a></td>
                        <td>1</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#"><img src="<?php echo PATH ?>/assets/img/products/hp_1.jpg" alt=""></a>
                        </td>
                        <td><a href="#">HP</a></td>
                        <td>1</td>
                        <td>100</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger ripple" data-bs-dismiss="modal"><?php __('main_index_footer_top_cart_continue_shop'); ?></button>
                <button type="button" class="btn btn-primary"><?php __('main_index_footer_top_cart_complete_order'); ?></button>
            </div>
        </div>
    </div>
</div>

<?php $this->getDbLogs(); ?>

<script>
    const PATH = '<?php echo PATH ?>';
</script>
<script src="<?php echo PATH ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="<?php echo PATH ?>/assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo PATH ?>/assets/js/main.js"></script>

</body>
</html>
