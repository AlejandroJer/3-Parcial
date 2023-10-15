<?php
namespace modelos;
use PDO;

class proveedores extends conexion {
    private $nombreEmpresa;
    private $direccionProveedor;
    private $personaContacto;
    private $telefono;
    private $correoProveedor;

    public function __construct() {
        parent::__construct();
    }

    public function Insertar($nombreEmpresa, $direccionProveedor, $personaContacto, $telefono, $correoProveedor) {
        $this->nombreEmpresa = $nombreEmpresa;
        $this->direccionProveedor = $direccionProveedor;
        $this->personaContacto = $personaContacto;
        $this->telefono = $telefono;
        $this->correoProveedor = $correoProveedor;

        $sql = "INSERT INTO proveedores (nombre_empresa, direccion, persona_contacto, num_telefono, email_proveedor)
                VALUES (?, ?, ?, ?, ?)";
        
        $insert = $this->conn->prepare($sql);
        $arrData = array($this->nombreEmpresa, $this->direccionProveedor, $this->personaContacto, $this->telefono, $this->correoProveedor);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }

    public function GetProveedores() {
        $sql = "SELECT * FROM proveedores";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchAll(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetProveedoresIndex() {
        $sql = "SELECT COUNT(*) FROM proveedores"; 
        $execute = $this->conn->query($sql);
        $request = $execute->fetchColumn();
        return $request;
    }
    
    public function GetProveedoresLimited($offset, $limitQuery) {
        $sql = "SELECT * FROM proveedores ORDER BY id_proveedor DESC LIMIT :offset, :limitQuery";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $execute->bindValue(':limitQuery', (int)$limitQuery, PDO::PARAM_INT);
        $execute->execute();
        $request = $execute->fetchAll(PDO::FETCH_ASSOC);
        return $request;
    }
    
    
    public function GetProveedorById($id) {
        $sql = "SELECT * FROM proveedores WHERE id_proveedor = ?";
        $execute = $this->conn->prepare($sql);
        $execute->execute([$id]);
        $request = $execute->fetch(PDO::FETCH_ASSOC);
        return $request;
    }

    public function UpdateProveedor($id, $nombreEmpresa, $direccionProveedor, $personaContacto, $telefono, $correoProveedor) {
        $this->nombreEmpresa = $nombreEmpresa;
        $this->direccionProveedor = $direccionProveedor;
        $this->personaContacto = $personaContacto;
        $this->telefono = $telefono;
        $this->correoProveedor = $correoProveedor;

        $sql = "UPDATE proveedores SET nombre_empresa=?, direccion=?, persona_contacto=?, num_telefono=?, email_proveedor=?
                WHERE id_proveedor=?";
        
        $update = $this->conn->prepare($sql);
        $arrData = array($this->nombreEmpresa, $this->direccionProveedor, $this->personaContacto, $this->telefono, $this->correoProveedor, $id);
        $resUpdate = $update->execute($arrData);
        return $resUpdate;
    }

    public function DeleteProveedor($id) {
        $sql = "DELETE FROM proveedores WHERE id_proveedor = ?";
        $arrwhere = array($id);
        $delete = $this->conn->prepare($sql);
        $del = $delete->execute($arrwhere);
        return $del;
    }
}
