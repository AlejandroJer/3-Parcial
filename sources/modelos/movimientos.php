<?php
namespace modelos;

use PDO;

class movimientos extends conexion {

    private $fecha_movimiento;
    private $id_usuario;
    private $tabla;
    private $id_producto;
    private $tabla_id;
    private $tabla_r_id;
    private $nombre_producto;
    private $cantidad_disponible;
    private $id_categoria; 
    private $id_material;  
    private $tipo_movimiento;

    public function __construct() {
        parent::__construct();
    }

    public function SetMov(string $tabla, int $tablaPK_id, int $tabla_rPK_id, int $tipo_movimiento, int $id_usuario) {
        $this->tabla = $tabla;
        $this->tabla_id = $tablaPK_id;
        $this->tabla_r_id = $tabla_rPK_id;
        $this->tipo_movimiento = $tipo_movimiento;
        $this->id_usuario = $id_usuario;

        $sql = "INSERT INTO movimientos (fecha_movimiento,tabla,id_tabla_PK,id_tabla_r_PK,tipo_movimiento,id_usr) VALUES (NOW(),?,?,?,?,?)";
        $insert = $this->conn->prepare($sql);
        $arrData = array($this->tabla, $this->tabla_id, $this->tabla_r_id, $this->tipo_movimiento, $this->id_usuario);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();

        return $idInsert;
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
