<?php
$parent_id = \wfm\App::$app->getProperty('parent_id');
$get_id = get('id');
?>

<option value="<?php echo $id ?>" <?php if ($id == $parent_id) echo ' selected'; ?> <?php if ($get_id == $id) echo ' disabled'; ?>>
    <?php echo $tab . $category['title'] ?>
</option>
<?php if(isset($category['children'])): ?>
    <?php echo $this->getMenuHtml($category['children'], '&nbsp;' . $tab. '-') ?>
<?php endif; ?>
