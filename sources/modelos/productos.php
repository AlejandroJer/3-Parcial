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

        $sql="INSERT INTO productos(nombre_producto,descripcion_producto,imagen,precio_compra,precio_venta,id_categoria,peso,id_material,cantidad_disponible,ubicacion_almacen,id_proveedor) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($this->nombre,$this->descripcion,$this->dir_img, $this->precio_compra, $this->precio_venta, $this->categoria, $this->peso, $this->tipo_material, $this->cantidad_disponible, $this->ubicacion_almacen, $this->id_proveedor);
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
        $sql="SELECT id_material FROM productos GROUP BY id_material";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_COLUMN, 0);
        return $request;
    }

    public function GetCategorias(){
        $sql="SELECT id_categoria FROM productos GROUP BY id_categoria";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_COLUMN, 0);
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
        $sql="SELECT * FROM productos WHERE nombre_producto like '%$KeyWord%' OR descripcion_producto LIKE '%$KeyWord%'";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetProductoByKeyWordIndex($KeyWord){
        $sql="SELECT COUNT(*) FROM productos WHERE nombre_producto like :keyword OR descripcion_producto LIKE :keyword";
        $execute = $this->conn->prepare($sql);

        $execute->bindValue(':keyword', '%' . $KeyWord . '%', PDO::PARAM_STR);
        $execute->execute();

        $request = $execute->fetchColumn();

        return $request;
    }

    public function GetProductoByKeyWordLimited($KeyWord, $offset, $limitQuery){
        $sql="SELECT * FROM productos WHERE nombre_producto like :keyword OR descripcion_producto LIKE :keyword ORDER BY id_producto DESC LIMIT :offset, :limitQuery";
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

    public function UpdateProducto(int $id, string $nombre, string $descripcion, float $precio_compra, float $precio_venta, string $categoria, float $peso, string $tipo_material, int $cantidad_disponible, string $ubicacion_almacen, int $id_proveedor, $img = null){
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

    public function SetRespaldo(string $nombre, string $descripcion, float $precio_compra, float $precio_venta, string $categoria, float $peso, string $tipo_material, int $cantidad_disponible, string $ubicacion_almacen, int $id_proveedor, $img = null){
        $sql="INSERT INTO respaldo_producto(nom_producto_r,desc_producto_r,img_r,precio_compra_r,precio_venta_r,id_categoria_r,peso_r,id_material_r,cantidad_r,ubicacion_r,id_proveedor_r) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($nombre, $descripcion, $img, $precio_compra, $precio_venta, $categoria, $peso, $tipo_material, $cantidad_disponible, $ubicacion_almacen, $id_proveedor);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }
}
?>