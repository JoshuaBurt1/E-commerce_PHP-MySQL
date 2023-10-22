<div class="container">
    <h1><?= $title ?></h1>
</div>
<div class="container">
    <!--HTML & CSS FORMATTING-->
    <?php if (isset($resources) && count($resources) > 0): ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($resources as $resource): ?>
                <tr>
                    <td><?= $resource->r_name ?></td> <!--INFORMATION PRESENT IN TABLE FROM SQL-->
                    <td>$<?= $resource->price ?></td>
                    <td> <!--ACTION BUTTONS IN FAR RIGHT COLUMN-->
                        <a class="btn btn-danger" href="<?= ROOT_PATH ?>/resources/delete/<?= $resource->id ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
            
        </tbody>
    </table>
    <?php endif ?>
</div>
<div class="container">
<p>Total: $<?=$total?></p>
</div>
<br>

<!--METHOD 1: The goal is to populate the orders SQL table from within resources/index.php-->
<!--METHOD 2: link to resource/_form.php; complete form there (modify orders table)--> 
<div class="container">
    <h1>Payment</h1>
    <form action="submit.php" method="POST" id="paymentFrm">
    <div class="form-group my-3">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="user_name" value="<?= $form_fields["user_name"] ?? "" ?>">
    </div>
    <div class="form-group my-3">
        <label for="name">Email</label>
        <input class="form-control" type="text" name="user_email" value="<?= $form_fields["user_email"] ?? "" ?>">
    </div>
    <div class="form-group my-3">
        <label for="name">Billing Address</label>
        <input class="form-control" type="text" name="billing" value="<?= $form_fields["billing"] ?? "" ?>">
    </div>
    <div class="form-group my-3">
        <label for="name">Card Number</label>
        <input class="form-control" type="text" name="card_num" size="20" autocomplete="off"  value="<?= $form_fields["card_"] ?? "" ?>">
    </div>
    <div class="form-group my-3">
        <label for="name">CVC</label>
        <input class="form-control" type="text" name="card_cvc" size="4" autocomplete="off" class="card-cvc"  value="<?= $form_fields["card_"] ?? "" ?>">
    </div>
    <div class="form-group my-3">
        <label for="name">Expiration (MM/YYYY)</label>
        <input class="form-control" type="text" name="card_exp"size="7" autocomplete="off"  value="<?= $form_fields["card_"] ?? "" ?>">
    </div>

        <button type="submit" id="payBtn">Submit Payment</button>
    </form>
</div>


<?php
    // Convert resource object into form_fields associative array ONLY if form_fields are not set
    //$form_fields = $form_fields ?? [];
    //if (count($form_fields) === 0 && isset($resource)) $form_fields = (array) $resource;
    //$products = $products ??[];
?>

