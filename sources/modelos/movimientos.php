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

    public function GetMov() {
        $sql = "SELECT * FROM movimientos ORDER BY fecha_movimiento DESC";

        $execute = $this->conn->query($sql);
        $historialMovimientos = $execute->fetchAll(PDO::FETCH_ASSOC);
        return $historialMovimientos;
    }

    public function GetMovByTable($table) {
        $sql = "SELECT * FROM movimientos WHERE tabla = :tableAffected ORDER BY fecha_movimiento DESC";

        $execute = $this->conn->prepare($sql);
        $execute->bindParam(':tableAffected', $table, PDO::PARAM_STR);
        $execute->execute();
        $historialMovimientos = $execute->fetchAll(PDO::FETCH_ASSOC);
        return $historialMovimientos;
    }

    public function GetMovByKindMovement($kind) {
        $sql = "SELECT * FROM movimientos WHERE tipo_movimiento = :kind ORDER BY fecha_movimiento DESC";

        $execute = $this->conn->prepare($sql);
        $execute->bindParam(':kind', $kind, PDO::PARAM_INT);
        $execute->execute();
        $historialMovimientos = $execute->fetchAll(PDO::FETCH_ASSOC);
        return $historialMovimientos;
    }

    public function DiccMov(){
        $dictionary = array(
            0 => array(
                'class' => 'table-danger',
                'kind' => 'Eliminar',
             ),
            1 => array(
                'class' => 'table-warning',
                'kind' => 'Actualizar',
             ),
            2 => array(
                'class' => 'table-success',
                'kind' => 'Agregar',
             ),
        );
        return $dictionary;
    }
}
?>
