<?php
namespace modelos;

use PDO;

class movimientos extends conexion {

    private $fecha_movimiento;
    private $id_usuario;
    private $id_producto;
    private $nombre_producto;
    private $cantidad_disponible;
    private $id_categoria; 
    private $id_material;  
    private $tipo_movimiento; 

    public function __construct() {
        parent::__construct();
    }

    public function SetMovimiento(string $fecha_movimiento, int $id_usuario, int $id_producto, string $nombre_producto, int $cantidad_disponible, int $id_categoria, int $id_material, string $tipo_movimiento) {
        $this->fecha_movimiento = $fecha_movimiento;
        $this->id_usuario = $id_usuario;
        $this->id_producto = $id_producto;
        $this->nombre_producto = $nombre_producto;
        $this->cantidad_disponible = $cantidad_disponible;
        $this->id_categoria = $id_categoria; 
        $this->id_material = $id_material;
        $this->tipo_movimiento = $tipo_movimiento;  

        $sql = "INSERT INTO movimientos(fecha_movimiento, id_usuario, id_producto, nombre_producto, cantidad_disponible, id_categoria, id_material, tipo_movimiento) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insert = $this->conn->prepare($sql);
        $arrData = array($this->fecha_movimiento, $this->id_usuario, $this->id_producto, $this->nombre_producto, $this->cantidad_disponible, $this->id_categoria, $this->id_material, $this->tipo_movimiento);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }

    public function obtenerHistorialMovimientos() {
        $sql = "SELECT id_movimiento, fecha_movimiento, id_usuario, id_producto, nombre_producto, cantidad_disponible, id_categoria, id_material, tipo_movimiento
                FROM movimientos
                ORDER BY fecha_movimiento DESC";

        $execute = $this->conn->query($sql);
        $historialMovimientos = $execute->fetchAll(PDO::FETCH_ASSOC);
        return $historialMovimientos;
    }
}
?>
