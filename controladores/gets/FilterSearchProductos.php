<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\{productos, proveedores};
    $producto = new productos();
    $proveedores = new proveedores();

    $limit = 7;

// SEARCH BY FILTER
 if(!isset($_POST['submit'])){   
 // MOVE THROUGHT PAGES IN THE SEARCH BY FILTER
  if(!isset($_POST['submitFilterPaginated'])){
    header("location:./../../inventario/read.php");
   } else {
    $array = json_decode($_POST['searchFilterPaginated'], true);
    $page = filter_var($_POST['submitFilterPaginated'], FILTER_SANITIZE_NUMBER_INT);

    $index = $producto->GetProductosByFilterIndex($array['proveedor'], $array['ubicacion'], $array['materiales'], $array['categorias'], $array['pesoMenig'], $array['pesoMayig'],
      $array['cantidadMenig'], $array['cantidadMayig'], $array['precioCompraMenig'], $array['precioCompraMayig'], $array['precioVentaMenig'], $array['precioVentaMayig']);
    $index = ceil($index/$limit);
    $results = $producto->GetProductosByFilterLimited($array['proveedor'], $array['ubicacion'], $array['materiales'], $array['categorias'], $array['pesoMenig'], $array['pesoMayig'],
      $array['cantidadMenig'], $array['cantidadMayig'], $array['precioCompraMenig'], $array['precioCompraMayig'], $array['precioVentaMenig'], $array['precioVentaMayig'], $page*$limit, $limit);
    $array = array(
      'proveedor' => $array['proveedor'],
      'ubicacion' => $array['ubicacion'],
      'materiales' => $array['materiales'],
      'categorias' => $array['categorias'],
      'pesoMenig' => $array['pesoMenig'],
      'pesoMayig' => $array['pesoMayig'],
      'cantidadMenig' => $array['cantidadMenig'],
      'cantidadMayig' => $array['cantidadMayig'],
      'precioCompraMenig' => $array['precioCompraMenig'],
      'precioCompraMayig' => $array['precioCompraMayig'],
      'precioVentaMenig' => $array['precioVentaMenig'],
      'precioVentaMayig' => $array['precioVentaMayig']
    );

    $_SESSION['results'] = $results;
    $_SESSION['filters'] = json_encode($array);
    $_SESSION['index'] = $index;
    $_SESSION['pageClicked'] = $page;
    header("location:./../../inventario/read.php");
  }
 } else {
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
 
   //Check the inputs
    if (isset($_POST['filter-search-proov'])) {
      $proveedor = filter_var($_POST['filter-search-proov'], FILTER_SANITIZE_STRING);
      $proveedor = $proveedores->GetIdByNombreEmpresa($proveedor);
      $proveedor = filter_var($proveedor, FILTER_SANITIZE_NUMBER_INT);
      if(empty($proveedor)){
        $proveedor = null;
      }
     }

    if (isset($_POST['filter-search-Ubi'])) {
      $ubicacion = filter_var($_POST['filter-search-Ubi'], FILTER_SANITIZE_STRING);
        if(empty($ubicacion)){
            $ubicacion = null;
        }
     }

    if (isset($_POST['filter-materials'])) {
      foreach ($_POST['filter-materials'] as $material) {
        $materiales[] = filter_var($material, FILTER_SANITIZE_STRING);
      }
     }

    if (isset($_POST['filter-categorias'])) {
      foreach ($_POST['filter-categorias'] as $categoria) {
        $categorias[] = filter_var($categoria, FILTER_SANITIZE_STRING);
      }
     }

    if (isset($_POST['filter-peso'])) {
      if (isset($_POST['filter-peso-menig'])){
        $pesoMenig = filter_var($_POST['filter-peso-menig'], FILTER_VALIDATE_FLOAT);
      }

      if (isset($_POST['filter-peso-mayig'])){
        $pesoMayig = filter_var($_POST['filter-peso-mayig'], FILTER_VALIDATE_FLOAT);
      }
     }

    if (isset($_POST['filter-cantidad'])) {
      if (isset($_POST['filter-cantidad-menig'])){
        $cantidadMenig = filter_var($_POST['filter-cantidad-menig'], FILTER_SANITIZE_NUMBER_INT);
      }

      if (isset($_POST['filter-cantidad-mayig'])){
        $cantidadMayig = filter_var($_POST['filter-cantidad-mayig'], FILTER_SANITIZE_NUMBER_INT);
      }
    }

    if (isset($_POST['filter-precioCompra'])) {
      if (isset($_POST['filter-precioCompra-menig'])){
        $precioCompraMenig = filter_var($_POST['filter-precioCompra-menig'], FILTER_VALIDATE_FLOAT);
      }

      if (isset($_POST['filter-precioCompra-mayig'])){
        $precioCompraMayig = filter_var($_POST['filter-precioCompra-mayig'], FILTER_VALIDATE_FLOAT);
      }
    }

    if (isset($_POST['filter-precioVenta'])){
      if (isset($_POST['filter-precioVenta-menig'])){
        $precioVentaMenig = filter_var($_POST['filter-precioVenta-menig'], FILTER_VALIDATE_FLOAT);
      }

      if (isset($_POST['filter-precioVenta-mayig'])){
        $precioVentaMayig = filter_var($_POST['filter-precioVenta-mayig'], FILTER_VALIDATE_FLOAT);
      }
    }
  // Make the query and returning the SESSIONS values

    $index = $producto->GetProductosByFilterIndex($proveedor, $ubicacion, $materiales, $categorias, $pesoMenig, $pesoMayig,
        $cantidadMenig, $cantidadMayig, $precioCompraMenig, $precioCompraMayig, $precioVentaMenig, $precioVentaMayig);
     $index = ceil($index/$limit);

    $results = $producto->GetProductosByFilterLimited($proveedor, $ubicacion, $materiales, $categorias, $pesoMenig, $pesoMayig,
        $cantidadMenig, $cantidadMayig, $precioCompraMenig, $precioCompraMayig, $precioVentaMenig, $precioVentaMayig, 0, $limit);
    
    $array = array(
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

    $_SESSION['results'] = $results;
    $_SESSION['filters'] = json_encode($array);
    $_SESSION['index'] = $index;
    $_SESSION['pageClicked'] = 0;
    header("location:./../../inventario/read.php");
//   }
 }
 
?>