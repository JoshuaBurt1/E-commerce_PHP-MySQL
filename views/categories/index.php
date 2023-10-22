<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $auth = isset($_SESSION["user"]);
?>
<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $authw = isset($_SESSION["userw"]); //either authw or "userw" is case sensitive
?>

<div class="container">
    <h1>Categories</h1>
</div>
<div class="container"><!--LISTS CATEGORIES-->
    <!--User clicked on Categories drop down menu ; current url: http://localhost/FinalProject3/categories -->
    <!--HTML & CSS FORMATTING-->
    <?php if (isset($categories) && count($categories) > 0): ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category->c_name ?></td> <!--INFORMATION PRESENT IN TABLE FROM SQL-->
                    <td class = "col-md-3"><img src='images/categories/<?=$category->image?>' id='<?=$category->image?>' class="w-50"></td> <!--INFORMATION PRESENT IN TABLE FROM SQL-->
                    <td> <!--ACTION BUTTONS IN FAR RIGHT COLUMN-->
                        <a class="btn btn-info" id="cat_view" href="<?= ROOT_PATH ?>/products/products/<?= $category->id ?>">view</a> <!--routes to products page, adds category_id onto url-->
                        <?php if ($authw): ?><!--IF USERW (Manufacturer) LOGGED IN - viewable- ### THIS SHOULD BE MANUFACTURER AUTHORIZATION-->
                        <a class="btn btn-warning" href="<?= ROOT_PATH ?>/categories/edit/<?= $category->id ?>">edit</a>
                        <a class="btn btn-danger" href="<?= ROOT_PATH ?>/categories/delete/<?= $category->id ?>" onclick="return confirm('Are you sure you want to delete this category?')">delete</a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php endif ?>
</div>

