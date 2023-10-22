<!--Secondary to ResourceModel.php > connects to routes.php ()"action" => "index, about, edit, delete") -->
<!--You can use these variables to display information on the views-->
<?php
    require_once("./models/ResourceModel.php");
    require_once("./models/ProductModel.php");

    function index () {
        $resources = ResourceModel::findAll();
        $total = ProductModel::findTotal(); //$this updates total variable on each page refresh (delete TABLE resource / shopping cart)
        render("resources/index", [
            "title" => "Shopping Cart",
            "resources" => $resources,
            "total" => $total
        ]);
    }

    function _new () {
        $products = ProductModel::findAll();
        render("resources/new", [
            "title" => "New Resource",
            "action" => "create",
            "products" => $products
        ]);
    }

    function edit ($request) {
        $resource = ResourceModel::find($request["params"]["id"]); //to edit a particular resource name > find id
        $products = ProductModel::findAll();
        render("resources/edit", [
            "title" => "Edit Resource",
            "resource" => $resource,
            "action" => "update",
            "products" => $products
        ]);
    }

    function create () {
        validate($_POST, "resources/new");

        ResourceModel::create($_POST);

        redirect("resources", ["success" => "Product was created successfully"]);
    }

    function update () {
        if (!isset($_POST["id"])) {
            return redirect("resources", ["errors" => "Missing required ID parameter"]);
        }

        validate($_POST, "resources/edit/{$_POST["id"]}");

        ResourceModel::update($_POST);

        redirect("resources", ["success" => "Product was updated successfully"]);
    }

    function delete ($request) {
        if (!isset($request["params"]["id"])) {
            return redirect("resources", ["errors" => "Missing required ID parameter"]);
        }

        ResourceModel::delete($request["params"]["id"]);

        redirect("resources", ["success" => "Shopping Cart item was deleted successfully"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["r_name"];
      $errors = [];

        foreach ($fields as $field) {
            if (empty($package[$field])) {
                $humanize = ucwords(str_replace("_", " ", $field));
                $errors[] = "{$humanize} cannot be empty";
            }
        }

        if (count($errors)) {
            return redirect($error_redirect_path, [
                "form_fields" => $package,
                "errors" => $errors
            ]);
        }
    }
    function sanitize($package) {}
    
?>