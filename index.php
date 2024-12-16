<?php
include_once("controllers/restaurantController.php");
include_once("controllers/cartController.php");
include_once("controllers/usersController.php");
include_once("config/parameters.php");

if(!isset($_GET['controller'])) {
    
    echo 'No controller found';
    header("Location:?controller=restaurant&action=home"); 

} else {
    $controllerName = "{$_GET['controller']}Controller";
    if(class_exists($controllerName)) {
        $controller = new $controllerName();
        if(isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = default_action;
        }

        $controller->$action();

    } else {
        echo "$controllerName not found";
        header("Location:?controller=restaurant");
    }
}


?>