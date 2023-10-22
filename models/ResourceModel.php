<?php
    class ResourceModel {
        private static $_table = "resources";

        public static function findAll () {
            $table = self::$_table;

            $sql = "SELECT
                resources.id,
                resources.r_name,
                resources.price
            FROM {$table}";

            $conn = get_connection();
            $resources = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $resources;
        }

        public static function find ($id) {
            $table = self::$_table;

            $sql = "SELECT
                resources.id,
                resources.r_name,
                resources.price
            FROM {$table}";

            $conn = get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $product;
        }

        public static function create ($package) {
            $table = self::$_table;

            $sql = "INSERT INTO {$table} (
                r_name,
                price
            ) VALUES (
                :r_name,
                :price
            )";

            $conn = get_connection();

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":r_name", $package["r_name"], PDO::PARAM_STR);
            $stmt->bindParam(":price", $package["price"], PDO::PARAM_STR);
            $stmt->execute();

            $conn = null;
        }

        public static function update ($package) {
            $table = self::$_table;

            $sql = "UPDATE {$table} SET
                r_name = :r_name,
                price = :price
            WHERE id = :id";

            $conn = get_connection();

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $package["id"], PDO::PARAM_INT);
            $stmt->bindParam(":r_name", $package["r_name"], PDO::PARAM_STR);
            $stmt->bindParam(":price", $package["price"], PDO::PARAM_STR);
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
