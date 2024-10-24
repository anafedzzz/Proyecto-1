<?php 
include_once("controller/productoController.php");
include_once("config/parameters.php");

if (isset($_GET['controller'])) {
    echo 'No existe en la URL un controlador';
}else{
    $nombre_controller = $_GET['controller']."Controller";
    if (class_exists($nombre_controller)) {
        $controller = new $nombre_controller();

        if(isset($_GET['action']) && method_exists($controller,$action)){
            $action=$_GET['action'];
        }else{
            $action = default_action;
        }

        $controller->$action();
    }else{
        echo 'No existe el controlador '.$nombre_controller;
    }
}

?>