<?php
    class ProductModel {
        private static $_table = "products";
        private static $_table2 = "resources";

        public static function findAll () {
            $table = self::$_table;

            $sql = "SELECT
                products.id,
                products.p_name,
                products.price,
                categories.c_name as c_name
            FROM {$table}
            JOIN categories ON products.category_id = categories.id";

            $conn = get_connection();
            $products = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $products;
        }        

        //#1 Products Controller: function findCategory() --> Returns products only found in a single category
        public static function contentsCategory ($id) { //CATEGORY SPECIFIC
            $table = self::$_table;
            #2. SQL Statement
            $sql = "SELECT
                products.id,
                products.p_name,
                products.price,
                products.category_id,
                categories.c_name as c_name
            FROM {$table}
            JOIN categories ON products.category_id = categories.id
            WHERE categories.id = :id"; #id 

            #1. This prepares the SQL statement by assigning a value to :id obtained from the function parameter $id
            $conn = get_connection();
            $stmt = $conn->prepare($sql); 
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            #3. variable $products is assigned the output of the SQL statement (ie. products only found in category_id = 1)
            $products = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $products;
        }
        public static function categoryRows ($id) { //CATEGORY SPECIFIC
            $table = self::$_table;
            #2. SQL Statement
            $sql = "SELECT COUNT(products.id)
            FROM {$table}
            JOIN categories ON products.category_id = categories.id
            WHERE categories.id = :id"; #id 

            #1. This prepares the SQL statement by assigning a value to :id obtained from the function parameter $id
            $conn = get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $total_count = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            //converts $total_count object to string
            $total_count = $total_count[0]; //removes array
            $total_count = print_r($total_count, true); //converts object to string
            $total_count = preg_replace('/[^0-9.]/','',$total_count); //regex to keep only numbers and decimal in string
            $total_count = ltrim($total_count, '.'); //removes first decimal
            return $total_count;
        }
        public static function categorySearch ($id) {
            $table = "products";
            $limit = 6;
            $page = (int) ($_GET["page"] ?? 1);
            $offset = ($page * $limit) - $limit;
            //Must do SQL statement here, else error --CHANGE THIS---------------
            $sql = "SELECT
                        products.id,
                        products.p_name,
                        products.price,
                        categories.c_name as c_name
                    FROM {$table}
                    JOIN categories ON products.category_id = categories.id
                    WHERE categories.id = :id
                    LIMIT {$limit} OFFSET {$offset}";
                    
            $conn = get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
            $pageValues = [$rows,$limit,$page,$offset];
            return $pageValues;
        }

        //#2a. Products Controller: function addToCart()
        //Adds single product to the resources table (add clicked product to shopping cart)
        public static function singleProduct ($id) {
            $table = self::$_table;
            $table2 = self::$_table2;
            #2. SQL Statement, #A. SELECT product id & info ProductModel find(); #B. INSERT into table resources Resource Model create();
            $sql = "INSERT INTO {$table2} (r_name, price) 
            SELECT p_name, price FROM {$table}
            WHERE id = :id"; #id 

            #1. This prepares the SQL statement by assigning a value to :id obtained from the function parameter $id
            $conn = get_connection();
            $stmt = $conn->prepare($sql); 
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            #3. variable $resources is assigned the output of the SQL statement (ie. resource with id = 1)
            $resources = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $resources;
        }
        #2b. Products Controller: function addToCart()
        //Returns all rows in resources table, Used in ProductsController addToCart() --> view TABLE resources contents after click
        public static function findAllResources () {
            $table2 = self::$_table2;

            $sql = "SELECT
                resources.id,
                resources.r_name,
                resources.price
            FROM {$table2}";

            $conn = get_connection();
            $stmt = $conn->prepare($sql); 
            $stmt->execute();
            $resources = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $resources;
        }
        #2c. Products Controller: function addToCart()
        #1. Resources Controller: function index()
        //calculates TABLE resources sum on each page refresh
        public static function findTotal () {
            $table2 = self::$_table2;

            $sql = "SELECT 
            SUM(resources.price)
            FROM {$table2}";

            $conn = get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            $total = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            //converts $total object to string
            $total = $total[0]; //removes array
            $total = print_r($total, true); //converts object to string
            $total = preg_replace('/[^0-9.]/','',$total); //regex to keep only numbers and decimal in string
            $total = ltrim($total, '.'); //removes first decimal
            return $total;
        }

        //PAGINATION
        public static function tableRows () {
            $table = self::$_table;
            
            $sql = "SELECT  
            COUNT(products.id)
            FROM {$table}";

            $conn = get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $total_count = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            //converts $total_count object to string
            $total_count = $total_count[0]; //removes array
            $total_count = print_r($total_count, true); //converts object to string
            $total_count = preg_replace('/[^0-9.]/','',$total_count); //regex to keep only numbers and decimal in string
            $total_count = ltrim($total_count, '.'); //removes first decimal
            return $total_count;
        }

        public static function regularSearch () {
            $table = "products";
            $limit = 6;
            $page = (int) ($_GET["page"] ?? 1);
            $offset = ($page * $limit) - $limit;
        
            //Must do SQL statement here, else error
            $sql = "SELECT
                        products.id,
                        products.p_name,
                        products.price,
                        categories.c_name as c_name
                    FROM {$table}
                    JOIN categories ON products.category_id = categories.id
                    LIMIT {$limit} OFFSET {$offset}";
            $conn = get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
            $pageValues = [$rows,$limit,$page,$offset];
            return $pageValues;
        }

        public static function find ($id) {
            $table = self::$_table;

            $sql = "SELECT
                products.id,
                products.p_name,
                products.price,
                products.category_id,
                categories.c_name as c_name,
                categories.id as category_id
            FROM {$table}
            JOIN categories ON products.category_id = categories.id
            WHERE products.id = :id";

            $conn = get_connection();
            $stmt = $conn->prepare($sql); //This adds a specific :id number to the SQL statement before it is executed
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $product;
        }

        public static function create ($package) {
            $table = self::$_table;

            $sql = "INSERT INTO {$table} (
                p_name,
                price,
                category_id
            ) VALUES (
                :p_name,
                :price,
                :category_id
            )";

            $conn = get_connection();

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":p_name", $package["p_name"], PDO::PARAM_STR);
            $stmt->bindParam(":price", $package["price"], PDO::PARAM_STR);
            $stmt->bindParam(":category_id", $package["category_id"], PDO::PARAM_INT);
            $stmt->execute();

            $conn = null;
        }

        public static function update ($package) {
            $table = self::$_table;

            $sql = "UPDATE {$table} SET
                p_name = :p_name,
                price = :price,
                category_id = :category_id
            WHERE id = :id";

            $conn = get_connection();

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $package["id"], PDO::PARAM_INT);
            $stmt->bindParam(":p_name", $package["p_name"], PDO::PARAM_STR);
            $stmt->bindParam(":price", $package["price"], PDO::PARAM_STR);
            $stmt->bindParam(":category_id", $package["category_id"], PDO::PARAM_INT);
            $stmt->execute();

            $conn = null;
        }

        public static function delete ($id) {
            $table = self::$_table;

            $sql = "DELETE FROM {$table} WHERE id = :id";

            $conn = get_connection();

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $conn = null;
        }

    }

?>
