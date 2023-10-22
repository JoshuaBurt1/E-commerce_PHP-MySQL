<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $auth = isset($_SESSION["user"]);
?>
<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $authw = isset($_SESSION["userw"]); //either authw or "userw" is case sensitive
?>

<div class="container">
    <h1><?= $title ?></h1>
</div>

<div class="container">
<?php if (!$auth): ?> <!--If user not authorized, message displayed-->
        <p>Log in to add to cart!</p>
<?php endif ?>
</div>

<div class="container"> <!--LISTS Products-->
    <!--User clicked on Products link ; current url: http://localhost/FinalProject3/products -->
    <!--HTML & CSS FORMATTING-->
    <?php if (isset($products) && count($products) > 0): ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <!--PAGINATION : rows both rows and products are an array of objects--> 
            <?php foreach ($pageValues[0] as $product): ?>
                <tr>
                    <td><?= $product->p_name ?></td>
                    <td>$<?= $product->price ?></td>
                    <td><?= $product->c_name ?></td>
                    <td>
                    <?php if ($auth): ?> <!--If user authorized, add to cart enabled-->
                        <a class="btn btn-primary" href="<?= ROOT_PATH ?>/resources/resources/<?= $product->id ?>">Add to Cart</a>
                    <?php endif ?>
                    <?php if ($authw): ?><!--IF USERW (Manufacturer) LOGGED IN - viewable- ### THIS SHOULD BE MANUFACTURER AUTHORIZATION-->
                        <a class="btn btn-warning" href="<?= ROOT_PATH ?>/products/edit/<?= $product->id?>">edit</a>
                        <a class="btn btn-danger" href="<?= ROOT_PATH ?>/products/delete/<?=$product->id ?>" onclick="return confirm('Are you sure you want to delete this category?')">delete</a>
                    <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?> 
        </tbody>
        </table>

        <!--PAGINATION HTML-->
        <div class="d-flex justify-content-center">
            <?php
            $limit = 6;
            $page = (int) ($_GET["page"] ?? 1);
            $offset = ($page * $limit) - $limit;
                $prev_en = ($page > 1) ? "" : "disabled";
                $prev3_en = ($page > 3) ? "" : "disabled";
                $next_en = ($page * $limit< $total_count) ? "" : "disabled";
                $next3_en = ($page * $limit< $total_count) ? "" : "disabled";
            ?>
            <div class="container2">
            <nav class="paginator">
                <ul class="pagination">
                    <li class="page-item"> <!--the href link (?page=) only changes the table view, not the page-->
                        <a href="?page=<?= $page - 3 ?>" class="page-link <?= $prev3_en ?>"><<<</a>
                    </li>
                    <li class="page-item">
                        <a href="?page=<?= $page - 1 ?>" class="page-link <?= $prev_en ?>"><</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link disabled"><?= $page ?></a>
                    </li>
                    <li class="page-item">
                        <a href="?page=<?= $page + 1 ?>" class="page-link <?= $next_en ?>">></a>
                    </li>
                    <li class="page-item">
                        <a href="?page=<?= $page + 3 ?>" class="page-link <?= $next3_en ?>">>>></a>
                    </li>
                    
                </ul>
            </nav>
            </div>
        </div>
        
        <!--Pagination-->

    <?php endif ?>
</div>

