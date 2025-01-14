<?php

include_once("models/CategoryDAO.php");
include_once("models/ArticleDAO.php");
include_once("models/AllergyDAO.php");
include_once("models/Complement.php");
include_once("models/Product.php");
include_once("models/Category.php");
include_once("models/Allergy.php");

class restaurantController {

    public function index() {
        session_start();

        $categories = CategoryDAO::getCategories();
        $bestselling = ArticleDAO::getBestSelling(9);

        $view="views/home.php";

        include_once("views/main.php");
    }

    public function categories() {
        session_start();

        $products = ArticleDAO::indexProductsById();
        $complements = ArticleDAO::indexComplementsById();
        $categories = CategoryDAO::getCategories();
        $allergens = AllergyDAO::getAllergies();
         
        $view="views/categorias.php";

        include_once("views/main.php");
    }

    public function product() {
        session_start();

        $product = ArticleDAO::getProduct($_GET['id']);
        $products = ArticleDAO::getRelatedProducts($product->getCategory_id(),$product->getId());
        $category = CategoryDAO::getCategory($product->getCategory_id());
        
        $view="views/product.php";

        include_once("views/main.php");
    }

    public function orderDetail() {
        session_start();

        // todo #3
        
        $view="views/orderDetail.php";

        include_once("views/main.php");
    }

    public function admin() {
        session_start();

        // $_SESSION['user']=UserDAO::getUserById($_SESSION['user']->getId());
        
        $view="views/admin/index.php";

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