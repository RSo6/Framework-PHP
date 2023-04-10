<?php
/** @var $products array */
use wfm\View;
/** @var $this View */
?>
<header>

                    <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Корзина</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table text-start">
                                        <thead>
                                        <tr>
                                            <th scope="col">Фото</th>
                                            <th scope="col">Товар</th>
                                            <th scope="col">Кол-во</th>
                                            <th scope="col">Цена</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <a href="#"><img src="img/products/apple_cinema_30.jpg" alt=""></a>
                                            </td>
                                            <td><a href="#">Apple cinema</a></td>
                                            <td>1</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#"><img src="img/products/canon_eos_5d_1.jpg" alt=""></a>
                                            </td>
                                            <td><a href="#">Canon EOS</a></td>
                                            <td>1</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#"><img src="img/products/hp_1.jpg" alt=""></a>
                                            </td>
                                            <td><a href="#">HP</a></td>
                                            <td>1</td>
                                            <td>100</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger ripple" data-bs-dismiss="modal">Продолжить покупки</button>
                                    <button type="button" class="btn btn-primary">Оформить заказ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- header-top -->


</header>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Ноутбуки</a></li>
            <li class="breadcrumb-item active" aria-current="page">MacBook</li>
        </ol>
    </nav>
</div>


<div class="container py-3">
    <div class="row">

        <div class="col-md-4 order-md-2">

            <h1>MacBook</h1>

            <ul class="list-unstyled">
                <li><i class="fas fa-check text-success"></i> В наличии</li>
                <li><i class="fas fa-shipping-fast text-muted"></i> Ожидается</li>
                <li><i class="fas fa-hand-holding-usd"></i> <span class="product-price"><small>$250.00</small>$230.99</li>
            </ul>

            <div id="product">
                <div class="input-group mb-3">
                    <input id="input-quantity" type="text" class="form-control" name="quantity" value="1">
                    <button class="btn btn-danger" type="button" id="button-addon2">Купить</button>
                </div>
            </div>

        </div>

        <div class="col-md-8 order-md-1">

            <ul class="thumbnails list-unstyled clearfix">
                <li class="thumb-main text-center"><a class="thumbnail" href="img/products/apple_cinema_30.jpg" data-effect="mfp-zoom-in"><img src="img/products/imac_1.jpg" alt=""></a></li>

                <li class="thumb-additional"><a class="thumbnail" href="img/products/1.jpg" data-effect="mfp-zoom-in"><img src="img/products/1.jpg" alt=""></a></li>
                <li class="thumb-additional"><a class="thumbnail" href="img/products/2.jpg" data-effect="mfp-zoom-in"><img src="img/products/2.jpg" alt=""></a></li>
                <li class="thumb-additional"><a class="thumbnail" href="img/products/3.jpg" data-effect="mfp-zoom-in"><img src="img/products/3.jpg" alt=""></a></li>
                <li class="thumb-additional"><a class="thumbnail" href="img/products/4.jpg" data-effect="mfp-zoom-in"><img src="img/products/4.jpg" alt=""></a></li>
            </ul>

            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi quas esse at odio modi enim, libero, inventore veniam eveniet! Nesciunt incidunt perferendis earum cum minus assumenda fugit labore quidem rem.</p>
            <p>Aliquam voluptatem, dignissimos eaque, cum adipisci esse fugit illo ea quae perspiciatis suscipit. Nesciunt aspernatur similique recusandae, vitae maiores sit accusantium! Nostrum, aliquam ad quisquam corrupti itaque, eveniet quo velit!</p>
            <p>Explicabo, culpa, sit! Quod eum, aperiam odit reiciendis repellendus vitae, quam laboriosam possimus fugiat rerum facilis dolor, molestiae magnam culpa numquam praesentium soluta molestias quaerat officiis, fuga aliquam! Quidem, possimus.</p>
            <p>Quo nihil in doloremque, cupiditate quam sunt inventore, nesciunt asperiores provident deleniti, explicabo fugit maiores accusantium omnis sed amet? Quos optio sit delectus architecto vero accusantium tenetur, ducimus, nobis ad.</p>
            <p>Asperiores, commodi provident eum sed repellat ut recusandae optio est dicta praesentium facere culpa unde obcaecati eveniet laborum amet nulla distinctio consectetur, iste, ipsum, soluta. Explicabo, repudiandae nemo ab quasi.</p>


        </div>

    </div>
</div>
