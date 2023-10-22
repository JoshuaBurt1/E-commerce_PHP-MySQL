<!--Secondary to ProductModel.php > connects to routes.php ()"action" => "index, about, edit, delete") -->
<?php
    require_once("./models/CategoryModel.php");
    require_once("./models/ProductModel.php");
    require_once("./models/ResourceModel.php");

    function index () {
        $products = ProductModel::findAll();
        $total_count = ProductModel::tableRows();
        $pageValues = ProductModel::regularSearch();
        render("products/index", [
            "title" => "List of Products",
            "products" => $products,
            "total_count" => $total_count,
            "pageValues" => $pageValues
        ]);
    }

    //Function findCategory returns a list of products from CLASS ProductModel > function contentsCategory (array content from SQL query)
    //Link change will be: http://localhost/phpFinalProject200523537/categories --> http://localhost/phpFinalProject200523537/products/products/4
    function findCategory ($request) {
        $products = ProductModel::contentsCategory($request["params"]["id"]); //$request = $id string "ie. 1,2,3,4"; For ordering by category
        $total_count = ProductModel::categoryRows($request["params"]["id"]);
        $pageValues = ProductModel::categorySearch($request["params"]["id"]);
        render("products/index", [ //this URL will be rendered (on function activation)
            "title" => "Products", //this is the $title variable that will be displayed, if there is one
            "products" => $products, //this variable must match with products/index variables to render the table
            "total_count" => $total_count,
            "pageValues" => $pageValues
        ]);
    }

    //add to cart on products index
    //Link change will be: http://localhost/phpFinalProject200523537/products --> http://localhost/phpFinalProject200523537/resources/resources/4
    function addToCart ($request){
        $resources= ProductModel::singleProduct($request["params"]["id"]); 
        $resources = ProductModel::findAllResources(); //This runs an SQL statement that finds all rows in TABLE resources (needed to display table after clicking Add to Cart)
        $total = ProductModel::findTotal(); //$this updates total variable on each page refresh (add to TABLE resource / shopping cart)
        render("resources/index", [ //this URL will be rendered (on function activation)
            "title" => "Shopping Cart",
            "resources" => $resources,
            "total" => $total
        ]);
    }
    
    function _new () {
        $categories = CategoryModel::findAll();
        render("products/new", [
            "title" => "New Product",
            "action" => "create",
            "categories" => $categories
        ]);
    }

    function edit ($request) {
        $product = ProductModel::find($request["params"]["id"]); //to edit a particular product name > find id
        $categories = CategoryModel::findAll();

        render("products/edit", [
            "title" => "Edit Product",
            "product" => $product,
            "action" => "update",
            "categories" => $categories
        ]);
    }

    function create () {
        validate($_POST, "products/new");

        ProductModel::create($_POST);

        redirect("products", ["success" => "Product was created successfully"]);
    }

    function update () {
        if (!isset($_POST["id"])) {
            return redirect("products", ["errors" => "Missing required ID parameter"]);
        }

        validate($_POST, "products/edit/{$_POST["id"]}");

        ProductModel::update($_POST);

        redirect("products", ["success" => "Product was updated successfully"]);
    }

    function delete ($request) {
        if (!isset($request["params"]["id"])) {
            return redirect("products", ["errors" => "Missing required ID parameter"]);
        }

        ProductModel::delete($request["params"]["id"]);

        redirect("products", ["success" => "Product was deleted successfully"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["p_name","price"];
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
?>