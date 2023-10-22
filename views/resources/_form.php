<?php
    // Convert resource object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];
    if (count($form_fields) === 0 && isset($resource)) $form_fields = (array) $resource;
    $products = $products ??[];
?>

<form action="<?= ROOT_PATH ?>/resources/<?= $action ?>" method="post">
    <?php if ($action === "update"): ?>
        <input type="hidden" name="id" value="<?= $form_fields["id"] ?>">
    <?php endif ?>

    <div class="form-group my-3">
        <label for="r_name">Resource Name</label>
        <input class="form-control" type="text" name="r_name" value="<?= $form_fields["r_name"] ?? "" ?>">
    </div>

    <div class="form-group my-3">
        <label for="price">Price</label>
        <textarea class="form-control" type="text" name="price"><?= $form_fields["price"] ?? "" ?></textarea>
    </div>
    <div>
        <button class="btn btn-primary">Submit</button>
    </div>
    
</form>
