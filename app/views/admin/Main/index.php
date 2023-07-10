    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
    <!--               </всього замовлень-->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $orders ?></h3>
                                <p>Заказов</p>
                            </div>
    <!--                        всього замовлень /> -->
                            <div class="icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <a href="<?php echo ADMIN ?>/order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
    <!--                </ К-сть нових замовлень -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo $new_orders ?></h3>
                                <p>Новых заказов</p>
                            </div>
    <!--                       к-сть нових замовлень />-->
                            <div class="icon">
                                <i class="fas fa-luggage-cart"></i>
                            </div>
                            <a href="<?php echo ADMIN ?>/orders?status=0" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <!--          </   К-сть користувачів       -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $users ?></h3>
                                <p>Пользователей</p>
                            </div>
    <!--                    к-сть користувачів  /> -->
                            <div class="icon">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <a href="<?php echo ADMIN ?>/user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <!--                          </ Продукти-->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">

                                <h3><?php echo $products ?></h3>
                                <p>Товаров</p>
    <!--                            Продукти />-->
                            </div>
                            <div class="icon">
                                <i class="fas fa-barcode"></i>
                            </div>
                            <a href="<?php echo ADMIN ?>/product" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->

