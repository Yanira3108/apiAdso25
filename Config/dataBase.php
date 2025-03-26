<?php

class DataBase {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "agrosis_api";
    private $connect;

    public function getConnection() {
        $this->connect = null;

        try {
            $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->pass);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connect->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error de conexión en la base de datos: " . $exception->getMessage();
        }

        return $this->connect;
    }
}
?>
