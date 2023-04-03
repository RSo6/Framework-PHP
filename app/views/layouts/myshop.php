<?php

use wfm\View;

/** @var $this View */
?>
<?php //$this->getPart('parts/header'); ?>
<?php //echo $this->content; ?>
<?php //$this->getPart('parts/footer'); ?>
<!doctype html>
<html lang="en">
<head>
    <style type="text/css">
        body{
            background-image: url("https://photographylife.com/wp-content/uploads/2016/06/Mass.jpg");
            background-repeat: no-repeat;
            background-position: top center;
            background-attachment: fixed;
        }
    </style>
    <!-- Required meta tags -->
    <base href="/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= PATH ?>/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= PATH ?>/public/assets/css/main.css">

    <title>ModernShop</title>
</head>
<body>

<header>
    <div class="header-top py-3">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col">
                    <a href="tel:+380-686-997-876">
                        <span class="icon-phone">&#9743;</span> +380-686-997-876
                    </a>
                </div>
                <div class="col text-end icons">
                    <form>
                        <div class="input-group" id="search">
                            <input type="text" class="form-control" placeholder="Search..." name="s">
                            <button class="btn close-search" type="button"><i class="fas fa-times"></i></i></button>
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a href="#" class="open-search"><i class="fas fa-search"></i></a>

                    <a href="#" class="relative" data-bs-toggle="modal" data-bs-target="#cart-modal">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge bg-danger rounded-pill count-items">0</span>
                    </a>
                    <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Кошик</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table text-start">
                                        <thead>
                                        <tr>
                                            <th scope="col">Фото</th>
                                            <th scope="col">Товар</th>
                                            <th scope="col">К-сть</th>
                                            <th scope="col">Ціна</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <a href="#"><img src="<?= PATH ?>/public/assets/img/products/macbook.jpg" alt=""></a>
                                            </td>
                                            <td><a href="#">Назва товару</a></td>
                                            <td>1</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#"><img src="https://bigmag.ua/image/cache/catalog/new/kumunren/bu%20iphone/iphone_xr/coral/A10A9305-500x500.jpg" alt=""></a>
                                            </td>
                                            <td><a href="#">iPhone Xr</a></td>
                                            <td>1</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#"><img src="https://static.digitecgalaxus.ch/Files/2/8/8/1/4/7/5/4/iPhone_11_B_1.jpg" alt=""></a>
                                            </td>
                                            <td><a href="#">iPhone 11</a></td>
                                            <td>1</td>
                                            <td>100</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger ripple" data-bs-dismiss="modal">Продовжити покупки</button>
                                    <button type="button" class="btn btn-primary">Оформити замовлення</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#"><i class="far fa-heart"></i></a>

                    <div class="dropdown d-inline-block">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="far fa-user"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Авторизація</a></li>
                            <li><a class="dropdown-item" href="#">Регістрація</a></li>
                        </ul>
                    </div>

                    <div class="dropdown d-inline-block">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="<?= PATH ?>/public/assets/img/ua.png" alt="">
                        </a>
                        <ul class="dropdown-menu" id="languages">
                            <li>
                                <button class="dropdown-item" data-langcode="en">
                                    <img src="<?= PATH ?>/public/assets/img/sss.png" alt="">
                                    English</button>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div><!-- header-top -->

    <div class="header-bottom py-2">
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid p-0">
                    <a class="navbar-brand" href="index.html">ModernShop</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="category.html">Компьютери</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="category.html">Планшети</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Ноутбуки
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="category.html">Macbook</a></li>
                                    <li><a class="dropdown-item" href="category.html">MacOS</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="category.html">IPhone</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="category.html">Камери</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>

        </div>
    </div><!-- header-bottom -->
</header>

<div class="container-fluid my-carousel">

    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://ibluetech.ca/wp-content/uploads/2021/08/informatique-bluetech-autorized-service-provider-provider-saint-lambert.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://cdn.dribbble.com/users/1161517/screenshots/7896076/apple-logo-animation.gif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://w.wallhaven.cc/full/nk/wallhaven-nk5ev7.jpg" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


</div>

<section class="featured-products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="section-title">Ласкаво просимо до нашого ассортименту</h3>
            </div>

            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="product-card">
                    <div class="product-tumb">
                        <a href="product.html"><img src="https://media.wired.com/photos/6332360740fe1e8870aa3bc0/master/w_2560%2Cc_limit/iPhone-14-Review-Gear.jpg" alt=""></a>
                    </div>
                    <div class="product-details">
                        <h4><a href="product.html">iPhone 14 Pro Max</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum! 2Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                        <div class="product-bottom-details d-flex justify-content-between">
                            <div class="product-price"><small>$350</small>$500</div>
                            <div class="product-links">
                                <a href="#"><i class="fas fa-shopping-cart"></i></a>
                                <a href="#"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="product-card">
                    <div class="product-tumb">
                        <a href="product.html"><img src="https://www.apple.com/v/macbook-pro-14-and-16/d/images/overview/hero/hero_intro_endframe__e6khcva4hkeq_large.jpg" alt=""></a>
                    </div>
                    <div class="product-details">
                        <h4><a href="product.html">Macbook pro</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                        <div class="product-bottom-details d-flex justify-content-between">
                            <div class="product-price"><small>$1999</small>$1599</div>
                            <div class="product-links">
                                <a href="#"><i class="fas fa-shopping-cart"></i></a>
                                <a href="#"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="product-card">
                    <div class="product-tumb">
                        <a href="<?= PATH ?>/assets/product.html"><img src="https://www.techhive.com/wp-content/uploads/2022/01/appletv4k2021hero-100890176-orig.jpg?quality=50&strip=all" alt=""></a>
                    </div>
                    <div class="product-details">
                        <h4><a href="<?= PATH ?>/assets/product.html">Apple TV</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                        <div class="product-bottom-details d-flex justify-content-between">
                            <div class="product-price"><small></small>$159.99</div>
                            <div class="product-links">
                                <a href="#"><i class="fas fa-shopping-cart"></i></a>
                                <a href="#"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="product-card">
                    <div class="product-tumb">
                        <a href="<?= PATH ?>/assets/product.html"><img src="https://www.ixbt.com/img/r30/00/02/18/73/AppleiMacgets2xmoreperformance03192019.jpg" alt=""></a>
                    </div>
                    <div class="product-details">
                        <h4><a href="<?= PATH ?>/assets/product.html">Apple iMac 5K 27″ (Early 2019)</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                        <div class="product-bottom-details d-flex justify-content-between">
                            <div class="product-price"><small>$1499</small>$230.99</div>
                            <div class="product-links">
                                <a href="#"><i class="fas fa-shopping-cart"></i></a>
                                <a href="#"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="product-card">
                    <div class="product-tumb">
                        <a href="<?= PATH ?>/assets/product.html"><img src="<?= PATH ?>/assets/img/products/imac_1.jpg" alt=""></a>
                    </div>
                    <div class="product-details">
                        <h4><a href="<?= PATH ?>/assets/product.html">iMac</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                        <div class="product-bottom-details d-flex justify-content-between">
                            <div class="product-price"><small>$96.00</small>$230.99</div>
                            <div class="product-links">
                                <a href="#"><i class="fas fa-shopping-cart"></i></a>
                                <a href="#"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="product-card">
                    <div class="product-tumb">
                        <a href="<?= PATH ?>/assets/product.html"><img src="<?= PATH ?>/assets/img/products/imac_1.jpg" alt=""></a>
                    </div>
                    <div class="product-details">
                        <h4><a href="<?= PATH ?>/assets/product.html">iMac</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                        <div class="product-bottom-details d-flex justify-content-between">
                            <div class="product-price"><small>$96.00</small>$230.99</div>
                            <div class="product-links">
                                <a href="#"><i class="fas fa-shopping-cart"></i></a>
                                <a href="#"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="services">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="section-title">Наші переваги</h3>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <p class="text-center"><i class="fas fa-shipping-fast"></i></p>
                    <p>Прємні поставки від виробника</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <p class="text-center"><i class="fas fa-cubes"></i></p>
                    <p>Широкий ассортимент товара</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <p class="text-center"><i class="fas fa-hand-holding-usd"></i></p>
                    <p>Приємні ціни</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <p class="text-center"><i class="fas fa-user-cog"></i></p>
                    <p>Професійна консультаціяс</p>
                </div>
            </div>

        </div>
    </div>
</section>

<footer>
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <h4>Інформація</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Головна</a></li>
                        <li><a href="#">Про магазин</a></li>
                        <li><a href="#">Оплата і доставка</a></li>
                        <li><a href="#">Контакти</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4>Час работи</h4>
                    <ul class="list-unstyled">
                        <li>г. Київ, вул. Пушкіна, 10</li>
                        <li>пн-вс: 9:00 - 18:00</li>
                        <li>без переривів</li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4>Контакты</h4>
                    <ul class="list-unstyled">
                        <li><a href="tel:5551234567">+380-686-997-876</a></li>
                        <li><a href="tel:5551234567">+380-686-997-876</a></li>
                        <li><a href="tel:5551234567">+380-686-997-876</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4>Ми в соціальних мережах</h4>
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


<script src="<?= PATH ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="<?= PATH ?>/assets/js/main.js"></script>

</body>
</html>

