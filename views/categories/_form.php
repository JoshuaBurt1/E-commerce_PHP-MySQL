<?php
    // Convert category object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];
    if (count($form_fields) === 0 && isset($category)) $form_fields = (array) $category;
?>

<!--A. User clicked on Categories drop down menu > New ; current url: http://localhost/FinalProject3/categories/new OR
    B. User clicked on Categories table > "edit" button ; current url: http://localhost/FinalProject3/categories/edit/4 -->

<!-- required for submit button TO ADD TO CATEGORY LIST -->
<form action="<?= ROOT_PATH ?>/categories/<?= $action ?>" method="post"> 
    <?php if ($action === "update"): ?>
        <input type="hidden" name="id" value="<?= $form_fields["id"] ?>">
    <?php endif ?>

    <!--HTML & CSS FORMATTING-->
    <div class="form-group my-3">
        <label for="name">Category name</label>
        <input class="form-control" type="text" name="c_name" value="<?= $form_fields["c_name"] ?? "" ?>">
    </div>

    <div>
        <button class="btn btn-primary">Submit</button>
    </div>
</form>

