<?php
    // Convert category object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];
    if (count($form_fields) === 0 && isset($product)) $form_fields = (array) $product;
    $categories = $categories ?? [];
?>

<form action="<?= ROOT_PATH ?>/products/<?= $action ?>" method="post">
    <?php if ($action === "update"): ?>
        <input type="hidden" name="id" value="<?= $form_fields["id"] ?>">
    <?php endif ?>


    <div class="form-group my-3">
        <label for="name">Product name</label>
        <input class="form-control" type="text" name="p_name" value="<?= $form_fields["p_name"] ?? "" ?>">
    </div>
    <div class="form-group my-3">
        <label for="name">Price</label>
        <input class="form-control" type="text" name="price" value="<?= $form_fields["price"] ?? "" ?>">
    </div>
    <div class="form-group my-3">
        <label for="category">Category</label>
        <select name="category_id" class="form-select">
            <option selected>Select a Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->id ?>" <?= isset($form_fields["category_id"]) && $form_fields["category_id"] == $category->id ? "selected" : "" ?>><?= $category->c_name ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div>
        <button class="btn btn-primary">Submit</button>
    </div>
</form>
