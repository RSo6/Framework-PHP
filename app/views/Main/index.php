<h1>Hello Main/index!</h1>
<?php if (!empty($names)): ?>
    <?php foreach ($names as $name): ?>
        <?php echo $name->id ?> => <?php echo$name->name ?><br>
    <?php endforeach; ?>
<?php endif; ?>
