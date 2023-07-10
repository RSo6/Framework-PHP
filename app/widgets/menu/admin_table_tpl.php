    <?php
    $parent = isset($category['children']);
//    debug($parent);
    if (!$parent) {
        $delete = '<a class="btn btn-danger btn-sm delete" href="'
            . ADMIN . '/category/delete?id=' . $id . '"><i class="far fa-trash-alt"></i></a>';

    } else {
        $delete = '';
    }

    $edit = '<a class="btn btn-info btn-sm" href="'
        . ADMIN . '/category/edit?id=' . $id . '"><i class="fas fa-pencil-alt"></i></a>';
    ?>
    <tr>
        <td>
            <a href="<?php echo ADMIN ?>/category/edit/?id=<?php echo $id ?>"
               style="padding-left: <?php echo strlen($tab)*3 ?>px"><?php echo $tab . $category['title'] ?></a>
        </td>
        <td width="50"><?php echo $edit ?></td>
        <td width="50"><?php echo $delete ?></td>
    </tr>
    <?php if (isset($category['children'])): ?>
        <?php echo $this->getMenuHtml($category['children'], $tab . '&#8211;');?>
    <?php endif; ?>
