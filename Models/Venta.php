<?php
class Venta {
    private $connect;
    private $table = 'venta';

    public $id_venta;
    public $fk_id_produccion;
    public $cantidad;
    public $precio_unitario;
    public $total_venta;
    public $fecha_venta;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function get() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (fk_id_produccion, cantidad, precio_unitario, total_venta, fecha_venta) VALUES (:fk_id_produccion, :cantidad, :precio_unitario, :total_venta, :fecha_venta)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fk_id_produccion", $this->fk_id_produccion);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":precio_unitario", $this->precio_unitario);
        $stmt->bindParam(":total_venta", $this->total_venta);
        $stmt->bindParam(":fecha_venta", $this->fecha_venta);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id_venta = :id_venta";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_venta", $this->id_venta);
        return $stmt->execute();
    }
}
?>
