<?php
namespace modelos;
use PDO;
class productos extends conexion{
    
    private $nombre;
    private $descripcion;
    private $precio_compra;
    private $precio_venta;
    private $categoria;
    private $peso;
    private $tipo_material;
    private $cantidad_disponible;
    private $ubicacion_almacen;
    private $id_proveedor;
    private $id_usuario; // no pertenece a la tabla
    private $id_producto;
    private $fecha_movimiento; // no pertenece a la tabla
    private $dir_img;
    private $movimiento;
    private $mov_by_usr;


    public function __construct(){
        parent::__construct();
    }

    public function Insertar(string $nombre, string $descripcion, float $precio_compra, float $precio_venta, string $categoria, float $peso, string $tipo_material, int $cantidad_disponible, string $ubicacion_almacen, int $id_proveedor, $img = null){
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->categoria = $categoria;
        $this->peso = $peso;
        $this->tipo_material = $tipo_material;
        $this->cantidad_disponible = $cantidad_disponible;
        $this->ubicacion_almacen = $ubicacion_almacen;
        $this->id_proveedor = $id_proveedor;
        $this->dir_img= $img;
    
        $sql = "INSERT INTO productos (nombre_producto, descripcion_producto, imagen, precio_compra, precio_venta, id_categoria, peso, id_material, cantidad_disponible, ubicacion_almacen, id_proveedor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insert = $this->conn->prepare($sql);
        $arrData = array($this->nombre, $this->descripcion, $this->dir_img, $this->precio_compra, $this->precio_venta, $this->categoria, $this->peso, $this->tipo_material, $this->cantidad_disponible, $this->ubicacion_almacen, $this->id_proveedor);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }
    

    public function InsertarMaterial(string $nombre){
        $this->nombre = $nombre;

        $sql="INSERT INTO material(material) VALUES(?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($this->nombre);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }

    public function InsertarCategoria(string $nombre){
        $this->nombre = $nombre;

        $sql="INSERT INTO categoria(categoria) VALUES(?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($this->nombre);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }

    public function Getproductos(){
        $sql="SELECT * FROM productos ORDER BY id_producto DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetUbicaciones(){ // GROUP BY = group the rows with the same value, avoiding duplicates
        $sql="SELECT ubicacion_almacen FROM productos GROUP BY ubicacion_almacen";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_COLUMN, 0);
        return $request;
    }

    public function GetMateriales(){
        $sql="SELECT * FROM material ORDER BY id ASC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetCategorias(){
        $sql="SELECT * FROM categoria ORDER BY id ASC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetProductoById($id){
        $sql="SELECT * FROM productos WHERE id_producto = $id";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetproductosIndex(){
        $sql="SELECT COUNT(*) FROM productos";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchColumn();
        return $request;
    }

    public function GetproductosLimited($offset, $limitQuery){
        $sql="SELECT * FROM productos ORDER BY id_producto DESC LIMIT :offset, :limitQuery";
        $execute = $this->conn->prepare($sql);

        $execute->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $execute->bindValue(':limitQuery', (int)$limitQuery, PDO::PARAM_INT);
        $execute->execute();

        $request = $execute->fetchall(PDO::FETCH_ASSOC);

        return $request;
    }

    public function GetProductoByKeyWord($KeyWord){
        $sql="SELECT * FROM productos WHERE nombre_producto like '%$KeyWord%' OR descripcion_producto LIKE '%$KeyWord%' OR precio_compra LIKE '%$KeyWord%' OR precio_venta LIKE '%KeyWord%' OR id_categoria LIKE '%$KeyWord%' OR peso LIKE '%$KeyWord%' OR id_material LIKE '%$KeyWord%' OR cantidad_disponible LIKE '%$KeyWord%' OR ubicacion_almacen LIKE '%$KeyWord%' OR id_proveedor LIKE '%$KeyWord%'";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetProductoByKeyWordIndex($KeyWord){
        $sql="SELECT COUNT(*) FROM productos WHERE nombre_producto like :keyword OR descripcion_producto LIKE :keyword OR precio_compra LIKE :keyword OR precio_venta LIKE :keyword OR id_categoria LIKE :keyword OR peso LIKE :keyword OR id_material LIKE :keyword OR cantidad_disponible LIKE :keyword OR ubicacion_almacen LIKE :keyword OR id_proveedor LIKE :keyword";
        $execute = $this->conn->prepare($sql);

        $execute->bindValue(':keyword', '%' . $KeyWord . '%', PDO::PARAM_STR);
        $execute->execute();

        $request = $execute->fetchColumn();

        return $request;
    }

    public function GetProductoByKeyWordLimited($KeyWord, $offset, $limitQuery){
        $sql="SELECT * FROM productos WHERE nombre_producto like :keyword OR descripcion_producto LIKE :keyword OR precio_compra LIKE :keyword OR precio_venta LIKE :keyword OR id_categoria LIKE :keyword OR peso LIKE :keyword OR id_material LIKE :keyword OR cantidad_disponible LIKE :keyword OR ubicacion_almacen LIKE :keyword OR id_proveedor LIKE :keyword ORDER BY id_producto DESC LIMIT :offset, :limitQuery";
        
        $execute = $this->conn->prepare($sql);

        $execute->bindValue(':keyword', '%' . $KeyWord . '%', PDO::PARAM_STR);
        $execute->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $execute->bindValue(':limitQuery', (int)$limitQuery, PDO::PARAM_INT);
        $execute->execute();

        $request = $execute->fetchall(PDO::FETCH_ASSOC);

        return $request;
    }

    public function GetProductosByFilterIndex($proveedor, $ubicacion , $materiales, $categorias, $pesoMenig, $pesoMayig,
        $cantidadMenig, $cantidadMayig, $precioCompraMenig, $precioCompraMayig, $precioVentaMenig, $precioVentaMayig){

     $sql="SELECT COUNT(*) FROM productos WHERE 1=1";

        if($proveedor){
            $sql .= " AND id_proveedor = $proveedor";
        }

        if($ubicacion){
            $sql .= " AND ubicacion_almacen = '$ubicacion'";
        }

        if($materiales && is_array($materiales)){
            $sql .= " AND id_material IN ('" . implode("','", $materiales) . "')";
        }

        if($categorias && is_array($categorias)){
            $sql .= " AND id_categoria IN ('" . implode("','", $categorias) . "')";
        }

        if($pesoMenig){
            $sql .= " AND peso <= $pesoMenig";
        }

        if($pesoMayig){
            $sql .= " AND peso >= $pesoMayig";
        }

        if($cantidadMenig){
            $sql .= " AND cantidad_disponible <= $cantidadMenig";
        }

        if($cantidadMayig){
            $sql .= " AND cantidad_disponible >= $cantidadMayig";
        }

        if($precioCompraMenig){
            $sql .= " AND precio_compra <= $precioCompraMenig";
        }

        if($precioCompraMayig){
            $sql .= " AND precio_compra >= $precioCompraMayig";
        }

        if($precioVentaMenig){
            $sql .= " AND precio_venta <= $precioVentaMenig";
        }

        if($precioVentaMayig){
            $sql .= " AND precio_venta >= $precioVentaMayig";
        }

     // $sql .= "GROUP BY id_producto";
     
        $execute = $this->conn->prepare($sql);
        $execute->execute();

        $request = $execute->fetchColumn();

        return $request;

    }

    public function GetProductosByFilterLimited($proveedor, $ubicacion , $materiales, $categorias, $pesoMenig, $pesoMayig,
            $cantidadMenig, $cantidadMayig, $precioCompraMenig, $precioCompraMayig, $precioVentaMenig, $precioVentaMayig, $offset, $limitQuery){

     $sql="SELECT DISTINCT * FROM productos WHERE 1=1";

        if($proveedor){
            $sql .= " AND id_proveedor = $proveedor";
        }

        if($ubicacion){
            $sql .= " AND ubicacion_almacen = '$ubicacion'";
        }

        if($materiales && is_array($materiales)){
            $sql .= " AND id_material IN ('" . implode("','", $materiales) . "')";
        }

        if($categorias && is_array($categorias)){
            $sql .= " AND id_categoria IN ('" . implode("','", $categorias) . "')";
        }

        if($pesoMenig){
            $sql .= " AND peso <= $pesoMenig";
        }

        if($pesoMayig){
            $sql .= " AND peso >= $pesoMayig";
        }

        if($cantidadMenig){
            $sql .= " AND cantidad_disponible <= $cantidadMenig";
        }

        if($cantidadMayig){
            $sql .= " AND cantidad_disponible >= $cantidadMayig";
        }

        if($precioCompraMenig){
            $sql .= " AND precio_compra <= $precioCompraMenig";
        }

        if($precioCompraMayig){
            $sql .= " AND precio_compra >= $precioCompraMayig";
        }

        if($precioVentaMenig){
            $sql .= " AND precio_venta <= $precioVentaMenig";
        }

        if($precioVentaMayig){
            $sql .= " AND precio_venta >= $precioVentaMayig";
        }

     $sql .= " ORDER BY id_producto DESC LIMIT :offset, :limitQuery";

        $execute = $this->conn->prepare($sql);

        $execute->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $execute->bindValue(':limitQuery', (int)$limitQuery, PDO::PARAM_INT);
        $execute->execute();

        $request = $execute->fetchall(PDO::FETCH_ASSOC);

        return $request;

    }

    public function GetProductosByFilterKeywordIndex($keyword, $proveedor, $ubicacion , $materiales, $categorias, $pesoMenig, $pesoMayig,
        $cantidadMenig, $cantidadMayig, $precioCompraMenig, $precioCompraMayig, $precioVentaMenig, $precioVentaMayig){

     $sql="SELECT COUNT(*) FROM productos WHERE 1=1";
     $arrData = array();

        if($keyword){
            $sql .= " AND (nombre_producto like ? OR descripcion_producto LIKE ?)";
            $arrData[] = '%' . $keyword . '%';
            $arrData[] = '%' . $keyword . '%';
        }

        if($proveedor){
            $sql .= " AND id_proveedor = ?";
            $arrData[] = $proveedor;
        }

        if($ubicacion){
            $sql .= " AND ubicacion_almacen = ?";
            $arrData[] = $ubicacion;
        }

        if($materiales && is_array($materiales)){
            $placeholders = implode(',', array_fill(0, count($materiales), '?'));
            $sql .= " AND id_material IN ($placeholders)";
            $arrData = array_merge($arrData, $materiales);
        }

        if($categorias && is_array($categorias)){
            $placeholders = implode(',', array_fill(0, count($categorias), '?'));
            $sql .= " AND id_categoria IN ($placeholders)";
            $arrData = array_merge($arrData, $categorias);
        }

        if($pesoMenig){
            $sql .= " AND peso <= ?";
            $arrData[] = $pesoMenig;
        }

        if($pesoMayig){
            $sql .= " AND peso >= ?";
            $arrData[] = $pesoMayig;
        }

        if($cantidadMenig){
            $sql .= " AND cantidad_disponible <= ?";
            $arrData[] = $cantidadMenig;
        }

        if($cantidadMayig){
            $sql .= " AND cantidad_disponible >= ?";
            $arrData[] = $cantidadMayig;
        }

        if($precioCompraMenig){
            $sql .= " AND precio_compra <= ?";
            $arrData[] = $precioCompraMenig;
        }

        if($precioCompraMayig){
            $sql .= " AND precio_compra >= ?";
            $arrData[] = $precioCompraMayig;
        }

        if($precioVentaMenig){
            $sql .= " AND precio_venta <= ?";
            $arrData[] = $precioVentaMenig;
        }

        if($precioVentaMayig){
            $sql .= " AND precio_venta >= ?";
            $arrData[] = $precioVentaMayig;
        }
     
    //  echo $sql . "\n" . implode(",", $arrData) . "\n";
     $execute = $this->conn->prepare($sql);
     $execute->execute($arrData);
     $request = $execute->fetchColumn();

     return $request;
    }

    public function GetProductosByFilterKeywordLimited($keyword, $proveedor, $ubicacion , $materiales, $categorias, $pesoMenig, $pesoMayig,
            $cantidadMenig, $cantidadMayig, $precioCompraMenig, $precioCompraMayig, $precioVentaMenig, $precioVentaMayig, $offset, $limitQuery){

     $sql="SELECT DISTINCT * FROM productos WHERE 1=1";
     $arrData = array();

        if($keyword){
            $sql .= " AND (nombre_producto like ? OR descripcion_producto LIKE ?)";
            $arrData[] = '%' . $keyword . '%';
            $arrData[] = '%' . $keyword . '%';
        }

        if($proveedor){
            $sql .= " AND id_proveedor = ?";
            $arrData[] = $proveedor;
        }

        if($ubicacion){
            $sql .= " AND ubicacion_almacen = ?";
            $arrData[] = $ubicacion;
        }

        if($materiales && is_array($materiales)){
            // echo json_encode($materiales) . "\t/productos.php 370\n\n\n";
            $placeholders = implode(',', array_fill(0, count($materiales), '?'));
            $sql .= " AND id_material IN ($placeholders)";
            $arrData = array_merge($arrData, $materiales);
        }

        if($categorias && is_array($categorias)){
            $placeholders = implode(',', array_fill(0, count($categorias), '?'));
            $sql .= " AND id_categoria IN ($placeholders)";
            $arrData = array_merge($arrData, $categorias);
        }

        if($pesoMenig){
            $sql .= " AND peso <= ?";
            $arrData[] = $pesoMenig;
        }

        if($pesoMayig){
            $sql .= " AND peso >= ?";
            $arrData[] = $pesoMayig;
        }

        if($cantidadMenig){
            $sql .= " AND cantidad_disponible <= ?";
            $arrData[] = $cantidadMenig;
        }

        if($cantidadMayig){
            $sql .= " AND cantidad_disponible >= ?";
            $arrData[] = $cantidadMayig;
        }

        if($precioCompraMenig){
            $sql .= " AND precio_compra <= ?";
            $arrData[] = $precioCompraMenig;
        }

        if($precioCompraMayig){
            $sql .= " AND precio_compra >= ?";
            $arrData[] = $precioCompraMayig;
        }

        if($precioVentaMenig){
            $sql .= " AND precio_venta <= ?";
            $arrData[] = $precioVentaMenig;
        }

        if($precioVentaMayig){
            $sql .= " AND precio_venta >= ?";
            $arrData[] = $precioVentaMayig;
        }

     $sql .= " ORDER BY id_producto DESC LIMIT $offset, $limitQuery";

    //  echo $sql . "\n" . implode(",", $arrData) . "\t/productos.php 424\n\n\n";
     $execute = $this->conn->prepare($sql);
     $execute->execute($arrData);
     $request = $execute->fetchall(PDO::FETCH_ASSOC);

     return $request;

    }

    public function GetImgById($id){
        $sql="SELECT imagen FROM productos WHERE id_producto = :id";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':id', $id, PDO::PARAM_INT);
        $execute->execute();
        $request = $execute->fetchColumn();
        return $request;
    }

    public function SetMovimineto(string $fecha_movimiento, int $id_usuario, int $id_producto, string $nombre_producto, int $cantidad_disponible){
        $this->$fecha_movimiento = $fecha_movimiento;
        $this->$id_usuario = $id_usuario;
        $this->$id_producto = $id_producto;
        $this->nombre = $nombre_producto;
        $this->$cantidad_disponible = $cantidad_disponible;

        $sql="INSERT INTO movimientos(fecha_movimiento,id_usuario,id_producto,nombre_producto,cantidad_disponible) VALUES(?,?,?,?,?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($this->fecha_movimiento, $this->id_usuario, $this->id_producto, $this->nombre, $this->cantidad_disponible);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }
    
    public function GetMovimientos(){
        $sql = "SELECT * FROM movimientos ORDER BY fecha_movimiento DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetProductosByProveedor($id){
        $sql = "SELECT * FROM productos WHERE id_proveedor = $id ORDER BY id_producto DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetMovimientosByIdUsr($id){
        $sql="SELECT * FROM movimientos WHERE id_usuario = $id ORDER BY fecha_creacion DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetMaterialesCount(){
        $sql="SELECT COUNT(DISTINCT id_material) FROM productos";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchColumn();
        return $request;
    }

    public function GetCategoriasCount(){
        $sql="SELECT COUNT(DISTINCT id_categoria) FROM productos";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchColumn();
        return $request;
    }

    public function GetNombreCategoriaById($id) {
        $sql = "SELECT categoria FROM categoria WHERE id = ?";
        $execute = $this->conn->prepare($sql);
        $execute->execute([$id]);
        $request = $execute->fetchColumn();

        return $request;
    }

    public function GetNombreMaterialById($id) {
        $sql = "SELECT material FROM material WHERE id = ?";
        $execute = $this->conn->prepare($sql);
        $execute->execute([$id]);
        $request = $execute->fetchColumn();

        return $request;
    }

    public function UpdateProducto(int $id, string $nombre, string $descripcion, float $precio_compra, float $precio_venta, int $categoria, float $peso, int $tipo_material, int $cantidad_disponible, string $ubicacion_almacen, int $id_proveedor, $img = null){
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->categoria = $categoria;
        $this->peso = $peso;
        $this->tipo_material = $tipo_material;
        $this->cantidad_disponible = $cantidad_disponible;
        $this->ubicacion_almacen = $ubicacion_almacen;
        $this->id_proveedor = $id_proveedor;
        $this->dir_img= $img;
        if($img){
            $sql="UPDATE productos SET nombre_producto=?,descripcion_producto=?,imagen=?,precio_compra=?,precio_venta=?,id_categoria=?,peso=?,id_material=?,cantidad_disponible=?,ubicacion_almacen=?,id_proveedor=?  WHERE id_producto=$id";
            $update= $this->conn->prepare($sql);
            $arrdatos= array($this->nombre,$this->descripcion,$this->dir_img, $this->precio_compra, $this->precio_venta, $this->categoria, $this->peso, $this->tipo_material, $this->cantidad_disponible, $this->ubicacion_almacen, $this->id_proveedor);
        } else{
            $sql="UPDATE productos SET nombre_producto=?,descripcion_producto=?,precio_compra=?,precio_venta=?,id_categoria=?,peso=?,id_material=?,cantidad_disponible=?,ubicacion_almacen=?,id_proveedor=?  WHERE id_producto=$id";
            $update= $this->conn->prepare($sql);
            $arrdatos= array($this->nombre,$this->descripcion, $this->precio_compra, $this->precio_venta, $this->categoria, $this->peso, $this->tipo_material, $this->cantidad_disponible, $this->ubicacion_almacen, $this->id_proveedor);
        }
        $resexecute = $update->execute($arrdatos);
        return $resexecute;
    }

    public function UpdateCategoria(int $id, string $nombre){
        $this->nombre = $nombre;
        $sql="UPDATE categoria SET categoria=? WHERE id=$id";
        $update= $this->conn->prepare($sql);
        $arrdatos= array($this->nombre);
        $resexecute = $update->execute($arrdatos);
        return $resexecute;
    }

    public function UpdateMaterial(int $id, string $nombre){
        $this->nombre = $nombre;
        $sql="UPDATE material SET material=? WHERE id=$id";
        $update= $this->conn->prepare($sql);
        $arrdatos= array($this->nombre);
        $resexecute = $update->execute($arrdatos);
        return $resexecute;
    }

    public function DeleteMaterial(int $id){
        $sql="DELETE FROM material WHERE id=?";
        $arrwhere =array($id);
        $delete= $this->conn->prepare($sql);
        $del = $delete->execute($arrwhere);
        return $del;
    }

    public function DeleteCategoria(int $id){
        $sql="DELETE  FROM categoria WHERE id=?";
        $arrwhere =array($id);
        $delete= $this->conn->prepare($sql);
        $del = $delete->execute($arrwhere);
        return $del;
    }

    public function DeleteProducto(int $id){
        $sql="DELETE  FROM productos WHERE id_producto=?";
        $arrwhere =array($id);
        $delete= $this->conn->prepare($sql);
        $del = $delete->execute($arrwhere);
        return $del;
    }

    public function InsertarImg($name_images){
        if(isset($_FILES['image'])){

            $file =$_FILES['image'];
            $file_name=$file['name'];
            $mimetype=$file['type'];
            
            $ext_formatos=array("image/jpeg", "image/jpg","image/png");
            if(!in_array($mimetype,$ext_formatos)){
                header("location:../inventario/add.php");
                die();
            }
            $directorio="imagenes_productos/";

            if(in_array($directorio.$file_name, $name_images)){
                header("location:../inventario/add.php");
                die("Esta imagen a sido usada anteriormente, por lo que debe escoger otra");
            }

            if(!is_dir("../inventario/".$directorio)){
                mkdir("../inventario/".$directorio,0777);
            }
            if(in_array($directorio.$file_name, $name_images)){
            }else{
                move_uploaded_file($file['tmp_name'],"../inventario/".$directorio.$file_name);
            }
            return $directorio.$file_name;

        }else{
            header("location:../inventario/add.php");
        }       
    }

    public function UpdateImg($name_images){
        if(isset($_FILES['image'])){

            $file =$_FILES['image'];
            $file_name=$file['name'];
            $mimetype=$file['type'];
            
            $ext_formatos=array("image/jpeg", "image/jpg","image/png");
            if(!in_array($mimetype,$ext_formatos)){
                header("location:../../inventario/add.php");
                die();
            }
            $directorio="imagenes_productos/";

            if(in_array($directorio.$file_name, $name_images)){
                header("location:../../inventario/add.php");
                die("Esta imagen a sido usada anteriormente, por lo que debe escoger otra");
            }

            if(!is_dir("../../inventario/".$directorio)){
                mkdir("../../inventario/".$directorio,0777);
            }
            if(in_array($directorio.$file_name, $name_images)){
            }else{
                move_uploaded_file($file['tmp_name'],"../../inventario/".$directorio.$file_name);
            }
            return $directorio.$file_name;

        }else{
            header("location:../../inventario/add.php");
        }       
    }

    public function BorrarImg($id,$name_images){
        $post = $this->GetProductoById($id);
        if($post['imagen']){
            $image = explode("/",$post['imagen'])[1];
            $directorio = "imagenes_respaldo/";
            if(in_array($directorio.$image, $name_images)){
                header("location:../../inventario/add.php");
                die("Esta imagen a sido usada anteriormente, por lo que debe escoger otra");
            }else{
                rename("../../inventario/".$post['imagen'],"../../inventario/".$directorio.$image);
                return $directorio.$image;
            }
        }
    }

    public function GetDirImg(){
        $sql="SELECT imagen FROM productos WHERE imagen is not null";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_COLUMN, 0);
        return $request;
    }

    public function GetDirImgRespaldo(){
        $sql="SELECT img_r FROM respaldo_producto WHERE img_r is not null";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_COLUMN, 0);
        return $request;
    }

    public function SetRespaldo(int $id, string $nombre, string $descripcion, float $precio_compra, float $precio_venta, string $categoria, float $peso, string $tipo_material, int $cantidad_disponible, string $ubicacion_almacen, int $id_proveedor,int $movimiento,int $id_usuario, $img = null){
        $this->id_producto = $id;
        $this->movimiento = $movimiento;
        $this->mov_by_usr = $id_usuario;
    
        $sql = "SELECT * FROM productos WHERE id_producto = :id";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':id', $this->id_producto, PDO::PARAM_INT);
        $execute->execute();
        $request = $execute->fetch(PDO::FETCH_ASSOC);
    
        $this->nombreProducto_backup = $request['nombre_producto'];
        $this->descripcion_backup = $request['Descripcion_producto'];
        $this->img_backup = $request['imagen'];
        $this->precio_compra_backup = $request['precio_compra'];
        $this->precio_venta_backup = $request['precio_venta'];
        $this->categoria_backup = $request['id_categoria'];
        $this->peso_backup = $request['peso'];
        $this->tipo_material_backup = $request['id_material'];
        $this->cantidad_disponible_backup = $request['cantidad_disponible'];
        $this->ubicacion_almacen_backup = $request['ubicacion_almacen'];
        $this->id_proveedor_backup = $request['id_proveedor'];
    
        $this->nombre = json_encode(array($this->nombreProducto_backup, $nombre));
        $this->descripcion = json_encode(array($this->descripcion_backup, $descripcion));
        $this->img = json_encode(array($this->img_backup, $img));
        $this->precio_compra = json_encode(array($this->precio_compra_backup, $precio_compra));
        $this->precio_venta = json_encode(array($this->precio_venta_backup, $precio_venta));
        $this->categoria = json_encode(array($this->categoria_backup, $categoria));
        $this->peso = json_encode(array($this->peso_backup, $peso));
        $this->tipo_material = json_encode(array($this->tipo_material_backup, $tipo_material));
        $this->cantidad_disponible = json_encode(array($this->cantidad_disponible_backup, $cantidad_disponible));
        $this->ubicacion_almacen = json_encode(array($this->ubicacion_almacen_backup, $ubicacion_almacen));
        $this->id_proveedor = json_encode(array($this->id_proveedor_backup, $id_proveedor));
    
        $sql = "INSERT INTO respaldo_producto(id_producto_r, nom_producto_r, desc_producto_r, img_r, precio_compra_r, precio_venta_r, categoria_r, peso_r, tipo_material_r, cantidad_r, ubicacion_r, id_proveedor_r, mov, MovByUsr)
                    VALUES (?, ?, ? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,?, ?)";
        $insert = $this->conn->prepare($sql);
        $arrData = array(
            $this->id_producto, $this->nombre, $this->descripcion, $this->img, $this->precio_compra, 
            $this->precio_venta, $this->categoria, $this->peso, $this->tipo_material, 
            $this->cantidad_disponible, $this->ubicacion_almacen, $this->id_proveedor, $this->movimiento , $this->mov_by_usr
        );
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }

    public function GetRespaldoProducto($id) {
        $sql = "SELECT * FROM respaldo_producto WHERE id_producto_r = :id";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':id', $id, PDO::PARAM_INT);
        $execute->execute();
        $request = $execute->fetch(PDO::FETCH_ASSOC);
    
        $Array = array(
            'id_producto' => $request['id_producto_r'],
            'nombre' => json_decode($request['nom_producto_r']),
            'Descripcion_producto' => json_decode($request['desc_producto_r']),
            'imagen' => json_decode($request['img_r']),
            'precio_compra' => json_decode($request['precio_compra_r']),
            'precio_venta' => json_decode($request['precio_venta_r']),
            'id_categoria' => json_decode($request['categoria_r']),
            'peso' => json_decode($request['peso_r']),
            'id_material' => json_decode($request['tipo_material_r']),
            'cantidad_disponible' => json_decode($request['cantidad_r']),
            'ubicacion_almacen' => json_decode($request['ubicacion_r']),
            'id_proveedor' => json_decode($request['id_proveedor_r']),
        );
    
        return $Array;
    }
    
    
    
}
?>