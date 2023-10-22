<?php
    class CategoryModel {
        private static $_table = "categories";

        public static function findAll () {
            $table = self::$_table;

            $sql = "SELECT * FROM {$table}";

            $conn = get_connection();
            $categories = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;

            return $categories;
        }
        public static function find ($id) {
            $table = self::$_table;
            $sql = "SELECT * FROM {$table} WHERE id = :id";
            $conn = get_connection();   
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $categories = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;

            return $categories;
        }

        public static function create ($package) {
            $table = self::$_table;

            $sql = "INSERT INTO {$table} (
                c_name
            ) VALUES (
                :c_name
            )";

            $conn = get_connection();

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":c_name", $package["c_name"], PDO::PARAM_STR);
            $stmt->execute();

            $conn = null;
        }

        public static function update ($package) {
            $table = self::$_table;

            $sql = "UPDATE {$table} SET
                c_name = :c_name
            WHERE id = :id";

            $conn = get_connection();

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $package["id"], PDO::PARAM_INT);
            $stmt->bindParam(":c_name", $package["c_name"], PDO::PARAM_STR);
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