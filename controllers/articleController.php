<?php

include_once("models/CategoryDAO.php");
include_once("models/ArticleDAO.php");
include_once("models/Complement.php");
include_once("models/Product.php");
include_once("models/Category.php");

class articleController {

    public function index() {
        header("Location:?controller=restaurant&action=index");
    }

    // public function create(){
    //     include_once("views/products/create.php");
    // }

    // public function store(){
    //     $nombre=$_POST['nombre'];
    //     $talla=$_POST['talla'];
    //     $precio=$_POST['precio'];

    //     $producto= new Tshirt();
    //     $producto->setname($nombre);
    //     $producto->setSize($talla);
    //     $producto->setPrice($precio);

    //     ProductDAO::store($producto);
    //     header('Location:?controller=products');
        
    // }

    // public function show() {
    //     include_once("views/products/show.php");
    // }

    // public function destroy(){
    //     ProductDAO::destroy( $_GET['id']);
    //     header('Location:?controller=products');
    // }
}