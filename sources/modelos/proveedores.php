<?php
namespace modelos;
use PDO;

class proveedores extends conexion {
    private $nombreEmpresa;
    private $direccionProveedor;
    private $personaContacto;
    private $telefono;
    private $correoProveedor;
    private $id_proveedor;
    private $movimiento;
    private $mov_by_usr;

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
    
    public function GetProveedorByKeyword($keyword) {
        $sql = "SELECT * FROM proveedores WHERE nombre_empresa LIKE '%$keyword%' OR direccion LIKE '%$keyword%' OR persona_contacto LIKE '%$keyword%' OR num_telefono LIKE '%$keyword%' OR email_proveedor LIKE '%$keyword%'";
        $execute = $this->conn->prepare($sql);
        $request = $execute->fetchAll(PDO::FETCH_ASSOC);

        return $request;
    }

    public function GetProveedorByKeywordIndex($keyword) {
        $sql = "SELECT COUNT(*) FROM proveedores WHERE nombre_empresa LIKE :keyword OR direccion LIKE :keyword OR persona_contacto LIKE :keyword OR num_telefono LIKE :keyword OR email_proveedor LIKE :keyword";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $execute->execute();
        $request = $execute->fetchColumn();
    
        return $request;
    }

    public function GetProveedorByKeywordLimited($keyword, $offset, $limitQuery) {
        $sql = "SELECT * FROM proveedores WHERE nombre_empresa LIKE :keyword OR direccion LIKE :keyword OR persona_contacto LIKE :keyword OR num_telefono LIKE :keyword OR email_proveedor LIKE :keyword ORDER BY id_proveedor DESC LIMIT :offset, :limitQuery";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
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

    public function GetNombresProveedores(){
        $sql = "SELECT id_proveedor, nombre_empresa FROM proveedores";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchAll(PDO::FETCH_ASSOC);

        return $request;
    }

    public function GetIdByNombreEmpresa($nombreEmpresa) {
        $sql = "SELECT id_proveedor FROM proveedores WHERE nombre_empresa = ?";
        $execute = $this->conn->prepare($sql);
        $execute->execute([$nombreEmpresa]);
        $request = $execute->fetchColumn();

        return $request;
    }

    public function GetNombreEmpresaById($id) {
        $sql = "SELECT nombre_empresa FROM proveedores WHERE id_proveedor = ?";
        $execute = $this->conn->prepare($sql);
        $execute->execute([$id]);
        $request = $execute->fetchColumn();

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

    public function SetRespaldo(int $id, string $nombreEmpresa, string $personaContacto, string $direccion, int $telefono, string $email, int $movimiento, int $mov_by_usr) {
        $this->id_proveedor = $id;
        $this->movimiento = $movimiento;
        $this->mov_by_usr = $mov_by_usr;

        $sql="SELECT * FROM proveedores WHERE id_proveedor = :id";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':id', $this->id_proveedor, PDO::PARAM_INT);
        $execute->execute();
        $request = $execute->fetch(PDO::FETCH_ASSOC);

        $this->nombreEmpresa_backup = $request['nombre_empresa'];
        $this->personaContacto_backup = $request['persona_contacto'];
        $this->direccionProveedor_backup = $request['direccion'];
        $this->telefono_backup = $request['num_telefono'];
        $this->correoProveedor_backup = $request['email_proveedor'];

        $this->nombreEmpresa = json_encode(array($this->nombreEmpresa_backup,$nombreEmpresa));
        $this->personaContacto = json_encode(array($this->personaContacto_backup,$personaContacto));
        $this->direccionProveedor = json_encode(array($this->direccionProveedor_backup,$direccion));
        $this->telefono = json_encode(array($this->telefono_backup,$telefono));
        $this->correoProveedor = json_encode(array($this->correoProveedor_backup,$email));


        $sql="INSERT INTO respaldo_proveedor(id_proveedor_r,nom_empresa_r,p_contacto_r,dir_r,tel_r,email_r,mov,id_usr) VALUES(?,?,?,?,?,?,?,?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($this->id_proveedor,$this->nombreEmpresa,$this->personaContacto,$this->direccionProveedor,$this->telefono,$this->correoProveedor,$this->movimiento,$this->mov_by_usr);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }

    public function GetRespaldo($id) {
        $sql = "SELECT * FROM respaldo_proveedor WHERE id = :id";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':id', $id, PDO::PARAM_INT);
        $execute->execute();
        $request = $execute->fetch(PDO::FETCH_ASSOC);

        $Array = array(
            'id_proveedor' => $request['id_proveedor_r'],
            'nombre_empresa' => json_decode($request['nom_empresa_r']),
            'persona_contacto' => json_decode($request['p_contacto_r']),
            'direccion' => json_decode($request['dir_r']),
            'num_telefono' => json_decode($request['tel_r']),
            'email_proveedor' => json_decode($request['email_r']),
        );

        return $Array;
    }

    public function PrvrsDictionary(){
        $sql = "SELECT * FROM proveedores";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchAll(PDO::FETCH_ASSOC);
        $Array = array();
        foreach ($request as $key => $value) {
            $Array[$value['id_proveedor']] = $value['nombre_empresa'];
        }
        return $Array;
    }
}
