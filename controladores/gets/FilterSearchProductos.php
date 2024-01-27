<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\{productos, proveedores};
    $producto = new productos();
    $proveedores = new proveedores();

    $limit = 7;

// SEARCH BY FILTER
 if(!isset($_POST['submit']) && !isset($_POST['filter'])){   
  header("location:./../../../inventario/read.php");
 } else {
    $keyword = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
    $proveedor = null;
    $ubicacion = null;
    $materiales = null;
    $categorias = null;
    $pesoMenig = null;
    $pesoMayig = null;
    $cantidadMenig = null;
    $cantidadMayig = null;
    $precioCompraMenig = null;
    $precioCompraMayig = null;
    $precioVentaMenig = null;
    $precioVentaMayig = null;
    if (isset($_POST['submitPaginated'])){
      $page = filter_var($_POST['submitPaginated'], FILTER_SANITIZE_NUMBER_INT);
     } else {
      $page = 0;
    }
 
   //Check the inputs
    if (isset($_POST['proveedor'])) {
      $proveedor = filter_var($_POST['proveedor'], FILTER_SANITIZE_STRING);
      $proveedor = $proveedores->GetIdByNombreEmpresa($proveedor);
      $proveedor = filter_var($proveedor, FILTER_SANITIZE_NUMBER_INT);
      if(empty($proveedor)){
        $proveedor = null;
      }
     }

    if (isset($_POST['ubicacion'])) {
      $ubicacion = filter_var($_POST['ubicacion'], FILTER_SANITIZE_STRING);
        if(empty($ubicacion)){
            $ubicacion = null;
        }
     }
  // Checkboxes
    if (isset($_POST['materiales'])) {
      // echo json_encode($_POST['materiales']) . "\t/FilterSearchProductos.php 51\n\n\n";
      foreach ($_POST['materiales'] as $material) {
        // echo $material . "\t/FilterSearchProductos.php 52\n\n\n";
        $materiales[] = filter_var($material, FILTER_SANITIZE_STRING);
      }
     }

    if (isset($_POST['categorias'])) {
      foreach ($_POST['categorias'] as $categoria) {
        $categorias[] = filter_var($categoria, FILTER_SANITIZE_STRING);
      }
     }
  // Ranges
    if (isset($_POST['peso'])) {
      if (isset($_POST['peso-menor-a'])){
        $pesoMenig = filter_var($_POST['peso-menor-a'], FILTER_VALIDATE_FLOAT);
      }

      if (isset($_POST['peso-mayor-a'])){
        $pesoMayig = filter_var($_POST['peso-mayor-a'], FILTER_VALIDATE_FLOAT);
      }
     }

    if (isset($_POST['cantidad'])) {
      if (isset($_POST['cantidad-menor-a'])){
        $cantidadMenig = filter_var($_POST['cantidad-menor-a'], FILTER_SANITIZE_NUMBER_INT);
      }

      if (isset($_POST['cantidad-mayor-a'])){
        $cantidadMayig = filter_var($_POST['cantidad-mayor-a'], FILTER_SANITIZE_NUMBER_INT);
      }
    }

    if (isset($_POST['precio-de-compra'])) {
      if (isset($_POST['precio-de-compra-menor-a'])){
        $precioCompraMenig = filter_var($_POST['precio-de-compra-menor-a'], FILTER_VALIDATE_FLOAT);
      }

      if (isset($_POST['precio-de-compra-mayor-a'])){
        $precioCompraMayig = filter_var($_POST['precio-de-compra-mayor-a'], FILTER_VALIDATE_FLOAT);
      }
    }

    if (isset($_POST['precio-de-venta'])){
      if (isset($_POST['precio-de-venta-menor-a'])){
        $precioVentaMenig = filter_var($_POST['precio-de-venta-menor-a'], FILTER_VALIDATE_FLOAT);
      }

      if (isset($_POST['precio-de-venta-mayor-a'])){
        $precioVentaMayig = filter_var($_POST['precio-de-venta-mayor-a'], FILTER_VALIDATE_FLOAT);
      }
    }
  // Make the query and returning the SESSIONS values

     $index = $producto->GetProductosByFilterKeywordIndex($keyword, $proveedor, $ubicacion, $materiales, $categorias, $pesoMenig, $pesoMayig,
        $cantidadMenig, $cantidadMayig, $precioCompraMenig, $precioCompraMayig, $precioVentaMenig, $precioVentaMayig);
     $index = ceil($index/$limit);
     $results = $producto->GetProductosByFilterKeywordLimited($keyword, $proveedor, $ubicacion, $materiales, $categorias, $pesoMenig, $pesoMayig,
        $cantidadMenig, $cantidadMayig, $precioCompraMenig, $precioCompraMayig, $precioVentaMenig, $precioVentaMayig, $page*$limit, $limit);

        foreach ($results as &$result){
          $result['id_proveedor'] = $proveedores->GetNombreEmpresaById($result['id_proveedor']);
          $result['id_categoria'] = $producto->GetNombreCategoriaById($result['id_categoria']);
          $result['id_material'] = $producto->GetNombreMaterialById($result['id_material']);
        }
        unset($result);
    
     $filters = array(
      'proveedor' => $proveedor,
      'ubicacion' => $ubicacion,
      'materiales' => $materiales,
      'categorias' => $categorias,
      'pesoMenig' => $pesoMenig,
      'pesoMayig' => $pesoMayig,
      'cantidadMenig' => $cantidadMenig,
      'cantidadMayig' => $cantidadMayig,
      'precioCompraMenig' => $precioCompraMenig,
      'precioCompraMayig' => $precioCompraMayig,
      'precioVentaMenig' => $precioVentaMenig,
      'precioVentaMayig' => $precioVentaMayig
     );

     $array = array(
      "results" => $results,
      "index" => $index,
      "pageClicked" => $page,
      "filters" => $filters
     );

    echo json_encode($array);
 }
 
?>