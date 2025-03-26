<?php

require_once 'Models/Notificacion.php';

class NotificacionController {
    private $db;
    private $notificacion;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->notificacion = new Notificacion($this->db);
    }

    // Obtener todas las notificaciones
    public function get() {
        $stmt = $this->notificacion->getNotificacion();
        $notificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $notificaciones
        ]);
    }

    // Crear una nueva notificación
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->titulo) && !empty($data->mensaje) && !empty($data->fk_id_programacion)) {
            $this->notificacion->titulo = $data->titulo;
            $this->notificacion->mensaje = $data->mensaje;
            $this->notificacion->fk_id_programacion = $data->fk_id_programacion;

            if ($this->notificacion->createNotificacion()) {
                echo json_encode(["status" => "Notificación creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear la notificación"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una notificación por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_notificacion)) {
            $this->notificacion->id_notificacion = $data->id_notificacion;

            if ($this->notificacion->deleteNotificacion()) {
                echo json_encode(["status" => "Notificación eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la notificación"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
