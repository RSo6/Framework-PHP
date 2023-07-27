<!-- Default box -->
<div class="card">

    <div class="card-header">
        <a href="<?php echo ADMIN ?>/product/add" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить товар</a>
    </div>

    <div class="card-body">

        <?php if (!empty($products)): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Фото</th>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Статус</th>
                        <th>Цифровой товар</th>
                        <td width="50"><i class="fas fa-pencil-alt"></i></td>
                        <td width="50"><i class="far fa-trash-alt"></i></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id'] ?></td>
                            <td>
                                <img src="<?php echo PATH ?>/<?php echo $product['img'] ?>" alt="" height="40">
                            </td>
                            <td>
                                <?php echo $product['title'] ?>
                            </td>
                            <td>
                                $<?php echo $product['price'] ?>
                            </td>
                            <td>
                                <?php echo $product['status'] ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>' ?>
                            </td>
                            <td>
                                <?php echo $product['is_download'] ? 'Цифровой товар' : 'Обычный товар'; ?>
                            </td>
                            <td width="50">
                                <a class="btn btn-info btn-sm"
                                   href="<?php echo ADMIN ?>/product/edit?id=<?php echo $product['id'] ?>"><i
                                        class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td width="50">
                                <a class="btn btn-danger btn-sm delete"
                                   href="<?php echo ADMIN ?>/product/delete?id=<?php echo $product['id'] ?>">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p><?php echo count($products) ?> товар(ов) из: <?php echo $total; ?></p>
                    <?php if ($pagination->count_pages > 1): ?>
                        <?php echo $pagination; ?>
                    <?php endif; ?>
                </div>
            </div>

        <?php else: ?>
            <p>Товаров не найдено...</p>
        <?php endif; ?>

    </div>
</div>
<!-- /.card -->
