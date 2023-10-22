<?php

    /**
     * Routes are responsible for matching a requested path
     * with a controller and an action. The controller represents
     * a collection of functions you want associated, usually, with
     * a resource. The action is the specific function you want to call.
     */

    $routes = [
        "get" => [
            [
                "pattern" => "/",
                "controller" => "PagesController",
                "action" => "index"
            ],
            [
                "pattern" => "/resources",
                "controller" => "ResourcesController",
                "action" => "index"
            ],
            [
                "pattern" => "/about",
                "controller" => "PagesController",
                "action" => "about"
            ],
            [
                "pattern" => "/contact",
                "controller" => "PagesController",
                "action" => "contact"
            ],
            [
                "pattern" => "/protocols",
                "controller" => "PagesController",
                "action" => "protocols"
            ],
            [
                "pattern" => "/forum",
                "controller" => "PagesController",
                "action" => "forum"
            ],
            [
                "pattern" => "/resources/new",
                "controller" => "ResourcesController",
                "action" => "_new"
            ],
            [
                "pattern" => "/resources/:id",
                "controller" => "ResourcesController",
                "action" => "show"
            ],
            [
                "pattern" => "/resources/edit/:id",
                "controller" => "ResourcesController",
                "action" => "edit"
            ],
            [
                "pattern" => "/resources/delete/:id",
                "controller" => "ResourcesController",
                "action" => "delete"
            ],
            [
                "pattern" => "/users/new",
                "controller" => "UsersController",
                "action" => "_new"
            ],
            [
                "pattern" => "/login",
                "controller" => "UsersController",
                "action" => "login"
            ],
            [
                "pattern" => "/logout",
                "controller" => "UsersController",
                "action" => "logout"
            ],
            [
                "pattern" => "/usersw/new",
                "controller" => "UsersWController",
                "action" => "_new"
            ],
            [
                "pattern" => "/loginw",
                "controller" => "UsersWController",
                "action" => "login"
            ],
            [
                "pattern" => "/logoutw",
                "controller" => "UsersWController",
                "action" => "logout"
            ],
            [
                "pattern" => "/categories",
                "controller" => "CategoriesController",
                "action" => "index"
            ],
            [
                "pattern" => "/categories/new",
                "controller" => "CategoriesController",
                "action" => "_new"
            ],
            [
                "pattern" => "/categories/edit/:id",
                "controller" => "CategoriesController",
                "action" => "edit"
            ],
            [
                "pattern" => "/categories/delete/:id",
                "controller" => "CategoriesController",
                "action" => "delete"
            ],
            [
                "pattern" => "/products",
                "controller" => "ProductsController",
                "action" => "index"
            ],
            //Custom function 1
            //in FOLDER categories, FILE index --> view button redirects to index function in FOLDER Controllers, FILE ProductsController.php
            //This uses the findall() function in FOLDER models, FILE ProductModel.php
            /// NOTE THIS INTERFERES WITH CREATING PRODUCT
            ///to not interfere add another level ie. /products/products/:id
            [ 
                "pattern" => "/products/products/:id", #if URL has this pattern pattern --> do action
                "controller" => "ProductsController", #if URL is /products/products/:id --> activate function findCategory
                "action" => "findCategory"
            ],
            //Custom function 2
            [ 
                "pattern" => "/resources/resources/:id", #if URL has this pattern pattern --> do action
                "controller" => "ProductsController", #if URL is /resources/resources/:id --> activate function addToCart
                "action" => "addToCart"
            ], 
            [
                "pattern" => "/products/new",
                "controller" => "ProductsController",
                "action" => "_new"
            ],
            [
                "pattern" => "/products/edit/:id",
                "controller" => "ProductsController",
                "action" => "edit"
            ],
            [
                "pattern" => "/products/delete/:id",
                "controller" => "ProductsController",
                "action" => "delete"
            ],
        ],
        "post" => [
            [
                "pattern" => "/resources/create",
                "controller" => "ResourcesController",
                "action" => "create"
            ],
            [
                "pattern" => "/resources/update",
                "controller" => "ResourcesController",
                "action" => "update"
            ],
            [
                "pattern" => "/users/create",
                "controller" => "UsersController",
                "action" => "create"
            ],
            [
                "pattern" => "/authenticate",
                "controller" => "UsersController",
                "action" => "authenticate"
            ],
            [
                "pattern" => "/usersw/create",
                "controller" => "UsersWController",
                "action" => "create"
            ],
            [
                "pattern" => "/authenticatew",
                "controller" => "UsersWController",
                "action" => "authenticate"
            ],
            [
                "pattern" => "/categories/create",
                "controller" => "CategoriesController",
                "action" => "create"
            ],
            [
                "pattern" => "/categories/update",
                "controller" => "CategoriesController",
                "action" => "update"
            ],
            [
                "pattern" => "/products/create",
                "controller" => "ProductsController",
                "action" => "create"
            ],
            [
                "pattern" => "/products/update",
                "controller" => "ProductsController",
                "action" => "update"
            ],
        ]
    ];

?>