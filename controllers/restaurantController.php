<?php

include_once("models/CategoryDAO.php");
include_once("models/ArticleDAO.php");
include_once("models/Complement.php");
include_once("models/Product.php");
include_once("models/Category.php");

class restaurantController {

    public function index() {
        session_start();
        $categories = CategoryDAO::getCategories();
        $bestselling = ArticleDAO::getBestSelling(9);

        $view="views/home.php";

        include_once("views/main.php");
    }

    public function categories() {
        $categories = CategoryDAO::getCategories();
        $products = ArticleDAO::getProducts();
         
        $view="views/categorias.php";

        include_once("views/main.php");
    }

    public function product() {
        $product = ArticleDAO::getProduct($_GET['id']);
        $products = ArticleDAO::getRelatedProducts($product->getCategory_id(),$product->getId());
        $category = CategoryDAO::getCategory($product->getCategory_id());
        
        $view="views/product.php";

        include_once("views/main.php");
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