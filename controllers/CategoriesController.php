<?php

    require_once("./models/CategoryModel.php");
    require_once("./models/ProductModel.php");

    function index () {
        $categories = CategoryModel::findAll();

        render("categories/index", [
            "title" => "List of Categories",
            "categories" => $categories
        ]);
    }

    function _new () {
        render("categories/new", ["title" => "New Category", "action" => "create"]);
    }

    function edit ($request) {
        $category = CategoryModel::find($request["params"]["id"]);

        render("categories/edit", [
            "title" => "Edit Category",
            "category" => $category,
            "action" => "update"
        ]);
    }
  

    function create () {
        validate($_POST, "categories/new");

        CategoryModel::create($_POST);

        redirect("categories", ["success" => "Category was created successfully"]);
    }

    function update () {
        if (!isset($_POST["id"])) {
            return redirect("categories", ["errors" => "Missing required ID parameter"]);
        }

        validate($_POST, "categories/edit/{$_POST["id"]}");

        CategoryModel::update($_POST);

        redirect("categories", ["success" => "Category was updated successfully"]);
    }

    function delete ($request) {
        if (!isset($request["params"]["id"])) {
            return redirect("categories", ["errors" => "Missing required ID parameter"]);
        }

        CategoryModel::delete($request["params"]["id"]);

        redirect("categories", ["success" => "Category was deleted successfully"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["c_name"];
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