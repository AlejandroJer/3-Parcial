<?php
namespace modelos;
use PDO;
class usuarios extends conexion{
    
    private $nombre;
    private $apellido;
    private $email;
    private $tel;
    private $sexo;
    private $password;
    private $id_usuario;
    private $id_rol;
    private $img_usr;
    private $fecha_movimiento; // no pertenece a la tabla
    private $id_usuario_movimiento; // no pertenece a la tabla
    private $movimiento; // no pertenece a la tabla
    private $mov_by_usr; // no pertenece a la tabla

    public function __construct(){
        parent::__construct();
    }

    public function Insertar(string $nombre, string $apellido, string $email, int $tel, string $sexo ,string $password, int $id_rol){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->tel = $tel;
        $this->sexo = $sexo;
        $this->password = $password;
        $this->id_rol = $id_rol;

        $sql="INSERT INTO usuarios(nombre_usr,apellido_usr,email_usr,tel,sexo,contraseña,id_perfil) VALUES(?,?,?,?,?,?,?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($this->nombre,$this->apellido,$this->email,$this->tel,$this->sexo,$this->password,$this->id_rol);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }

    public function GetUsuarios(){
        $sql="SELECT * FROM usuarios";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetUsuariosIndex(){
        $sql="SELECT COUNT(*) FROM usuarios";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchColumn();
        return $request;
    }

    public function GetUsuariosLimited($offset, $limitQuery){
        $sql="SELECT * FROM usuarios ORDER BY id_usr DESC LIMIT :offset, :limitQuery";
        $execute = $this->conn->prepare($sql);

        $execute->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $execute->bindValue(':limitQuery', (int)$limitQuery, PDO::PARAM_INT);
        $execute->execute();

        $request = $execute->fetchAll(PDO::FETCH_ASSOC);

        return $request;
    }

    public function GetUsuarioByKeyword($keyword){
        $sql="SELECT * FROM usuarios WHERE nombre_usr LIKE '%$keyword%' OR apellido_usr LIKE '%$keyword%' OR email_usr LIKE '%$keyword%' OR tel LIKE '%$keyword%'";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchAll(PDO::FETCH_ASSOC);

        return $request;
    }

    public function GetUsuarioByKeywordIndex($keyword){
        $sql="SELECT COUNT(*) FROM usuarios WHERE nombre_usr LIKE :keyword OR apellido_usr LIKE :keyword OR email_usr LIKE :keyword OR tel LIKE :keyword";
        $execute = $this->conn->prepare($sql);
        
        $execute->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $execute->execute();

        $request = $execute->fetchColumn();

        return $request;
    }

    public function GetUsuarioByKeywordLimited($keyword, $offset, $limitQuery){
        $sql="SELECT * FROM usuarios WHERE nombre_usr LIKE :keyword OR apellido_usr LIKE :keyword OR email_usr LIKE :keyword OR tel LIKE :keyword ORDER BY id_usr DESC LIMIT :offset, :limitQuery";
        $execute = $this->conn->prepare($sql);

        $execute->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $execute->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $execute->bindValue(':limitQuery', (int)$limitQuery, PDO::PARAM_INT);
        $execute->execute();

        $request = $execute->fetchall(PDO::FETCH_ASSOC);

        return $request;
    }

    public function GetUsuarioById($id){
        $sql="SELECT * FROM usuarios WHERE id_usr = :id";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':id', $id, PDO::PARAM_INT);
        $execute->execute();
        $request = $execute->fetch(PDO::FETCH_ASSOC);

        return $request;
    }

    public function GetUsuarioPassWordById($id){
        $sql="SELECT contraseña FROM usuarios WHERE id_usr = :id";

        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':id', $id, PDO::PARAM_INT);
        $execute->execute();
        $request = $execute->fetch();

        return $request;
    }

    public function GetUsuariosPassAdmin(){
        $sql="SELECT contraseña FROM usuarios WHERE id_perfil = 1";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetUsuarioIdByLastnameTelEmail($lastname, $tel, $email){
        $sql="SELECT id_usr FROM usuarios WHERE apellido_usr = :lastname AND tel = :tel AND email_usr = :email";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $execute->bindValue(':tel', $tel, PDO::PARAM_INT);
        $execute->bindValue(':email', $email, PDO::PARAM_STR);
        $execute->execute();
        $request = $execute->fetch(PDO::FETCH_ASSOC);
        return $request;
    }

    public function SetMovimineto(string $fecha_movimiento, int $id_usuario_movimiento, int $id_usuario, string $nombre, string $apellido){
        $this->fecha_movimiento = $fecha_movimiento;
        $this->id_usuario_movimiento = $id_usuario_movimiento;
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;

        $sql="INSERT INTO movimientos(fecha_movimiento,id_usuario_movimiento,id_usr,nombre_usr,apellido_usr) VALUES(?,?,?,?,?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($this->fecha_movimiento,$this->id_usuario_movimiento,$this->id_usuario,$this->nombre,$this->apellido);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert; //No tengo ni idea de si sirve este funcion
    }

    public function GetMovimientos(){
        $sql="SELECT * FROM movimientos ORDER BY id_movimiento DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetMovimientoByIdUrs($id){
        $sql="SELECT * FROM movimientos WHERE id_movimiento = $id ORDER BY fecha_creacion DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch( PDO::FETCH_ASSOC );
        return $request;
    }
    // public function InsertarImg_usr($name_images_usr){
    //     if(isset($_FILES['image_usr'])){
    //         $file =$_FILES['image_usr'];
    //         $file_name=$file['name'];
    //         $mimetype=$file['type'];
            
    //         $ext_formatos=array("image_usr/jpeg", "image_usr/jpg","image_usr/png");
    //         if(!in_array($mimetype,$ext_formatos)){
    //             header("location:../empleados/add.php");
    //             die();
    //         }
    //         $directorio="imagen_usuarios/";
    //         if(in_array($directorio.$file_name, $name_images_usr)){
    //             header("location:../empleados/add.php");
    //             die("Esta imagen a sido usada anteriormente, por lo que debe escoger otra");
    //         }
    //         if(!is_dir("../empleados/".$directorio)){
    //             mkdir("../empleados/".$directorio,0777);
    //         }
    //         if(in_array($directorio.$file_name, $name_images_usr)){
    //         }else{
    //         move_uploaded_file($file['tmp_name'],"../empleados/".$directorio.$file_name);
    //         }
    //         return $directorio.$file_name;
    //     }else{
    //         header("location:../empleados/add.php");
    //     }       
    // }
    // public function GetDirImg_usr(){
    //     $sql="SELECT image_usr FROM usuarios WHERE image_usr is not null";
    //     $execute = $this->conn->query($sql);
    //     $request = $execute->fetchall(PDO::FETCH_COLUMN, 0);
    //     return $request;
    // }

    public function UpdateUsuario(int $id, string $nombre, string $apellido, string $email, int $tel, string $sexo, string $password, int $id_rol){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->tel = $tel;
        $this->sexo = $sexo;
        $this->password = $password;
        $this->id_rol = $id_rol;

        $sql="UPDATE usuarios SET nombre_usr=?, apellido_usr=?, email_usr=?, tel=?, sexo=?, contraseña=?, id_perfil=? WHERE id_usr = $id";
        $update= $this->conn->prepare($sql);
        $arrData= array($this->nombre,$this->apellido,$this->email,$this->tel,$this->sexo,$this->password,$this->id_rol);
        $resExecute = $update->execute($arrData);
        return $resExecute;
    }

    public function DeleteUsuario(int $id){
        $sql="DELETE FROM usuarios WHERE id_usr = ?";
        $arrWhere = array($id);
        $delete = $this->conn->prepare($sql);
        $del = $delete->execute($arrWhere);
        return $del;
    }

    public function SetRespaldo(int $id, string $nombre_udt, string $password_udt, string $apellido_udt, string $email_udt, int $tel_udt, string $sexo_udt, int $id_rol_udt, int $movimiento, int $mov_by_usr){
        $this->id_usuario = $id;
        $this->movimiento = $movimiento;
        $this->mov_by_usr = $mov_by_usr;

        $sql="SELECT * FROM usuarios WHERE id_usr = :id";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':id', $this->id_usuario, PDO::PARAM_INT);
        $execute->execute();
        $request = $execute->fetch(PDO::FETCH_ASSOC);

        $this->nombre_backup = $request['nombre_usr'];
        $this->password_backup = $request['contraseña'];
        $this->apellido_backup = $request['apellido_usr'];
        $this->email_backup = $request['email_usr'];
        $this->tel_backup = $request['tel'];
        $this->sexo_backup = $request['sexo'];
        $this->id_rol_backup = $request['id_perfil'];

        
        $this->nombre = json_encode(array($this->nombre_backup,$nombre_udt));
        $this->password = json_encode(array($this->password_backup,$password_udt));
        $this->apellido = json_encode(array($this->apellido_backup,$apellido_udt));
        $this->email = json_encode(array($this->email_backup,$email_udt));
        $this->tel = json_encode(array($this->tel_backup,$tel_udt));
        $this->sexo = json_encode(array($this->sexo_backup,$sexo_udt));
        $this->id_rol = json_encode(array($this->id_rol_backup,$id_rol_udt));

        $sql="INSERT INTO respaldo_usuario(id_r,nombre_r,pass_r,apellido_r,email_r,tel_r,sexo_r,id_perfil_r,mov,MovByUsr) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($this->id_usuario,$this->nombre,$this->password,$this->apellido,$this->email,$this->tel,$this->sexo,$this->id_rol,$this->movimiento,$this->mov_by_usr);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }

    public function GetRespaldoById($id){
        $sql="SELECT * FROM respaldo_usuario WHERE id = :id";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':id', $id, PDO::PARAM_INT);
        $execute->execute();
        $request = $execute->fetch(PDO::FETCH_ASSOC);

        $array = array(
            'id_usr' => $request['id_r'],
            'nombre_usr' => json_decode($request['nombre_r']),
            'contraseña' => json_decode($request['pass_r']),
            'apellido_usr' => json_decode($request['apellido_r']),
            'email_usr' => json_decode($request['email_r']),
            'tel' => json_decode($request['tel_r']),
            'sexo' => json_decode($request['sexo_r']),
            'id_perfil' => json_decode($request['id_perfil_r']),
        );

        return $array;
    }

    public function GetRespaldoByIdUrs($id){
        $sql="SELECT * FROM respaldo_usuario WHERE id_r = :id";
        $execute = $this->conn->prepare($sql);
        $execute->bindValue(':id', $id, PDO::PARAM_INT);
        $execute->execute();
        $request = $execute->fetch( PDO::FETCH_ASSOC );

        $array = array(
            'id_usr' => $request['id_r'],
            'nombre_usr' => json_decode($request['nombre_r']),
            'contraseña' => json_decode($request['pass_r']),
            'apellido_usr' => json_decode($request['apellido_r']),
            'email_usr' => json_decode($request['email_r']),
            'tel' => json_decode($request['tel_r']),
            'sexo' => json_decode($request['sexo_r']),
            'id_perfil' => json_decode($request['id_perfil_r']),
        );

        return $array;
    }

    
 //register y login
    public function RegistrarUsuario(string $nombre, string $apellido, string $email, string $sexo, string $password, int $id_rol){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->sexo = $sexo;
        $this->password = password_hash($password, PASSWORD_DEFAULT); // Hashing

        $sql="INSERT INTO usuarios(nombre_usr,apellido_usr,email_usr,sexo,contraseña,id_perfil) VALUES(?,?,?,?,?,?)";
        $insert= $this->conn->prepare($sql);
        $arrData= array($this->nombre,$this->apellido,$this->email,$this->sexo,$this->password,$id_rol);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }

    public function IniciarSesion(string $email, string $password){
        $sql = "SELECT id_usr, contraseña FROM usuarios WHERE email_usr = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['contraseña'])) {
            return $user['id_usr'];
        } else {
            return false;
        }
    }



}
?>