<?php

include_once("models/CategoryDAO.php");
include_once("models/ArticleDAO.php");
include_once("models/OrderLine.php");
include_once("models/Complement.php");
include_once("models/Product.php");
include_once("models/Category.php");

class cartController{

    public function show() {
        
        session_start();

        $articles = ArticleDAO::indexArticlesById();

        $view="views/carrito.php";

        include_once("views/main.php");
    }

    public function addCart(){

        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

        session_start();

        if (isset($_SESSION['user'])) {

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            } else {
                if (isset($_POST['id'])) {
                    $article_id = $_POST['id'];
                    $pedidoExistente = false;

                    foreach ($_SESSION['cart'] as $order_line) {
                        if ($order_line->getArticleId() == $article_id) {
                            $order_line->setQuantity($order_line->getQuantity() + $quantity);
                            $pedidoExistente = true;
                            break;
                        }
                    }

                    if ($pedidoExistente == false) {
                        $order_line = new OrderLine($_POST['id'],$quantity,ArticleDAO::getPrice($_POST['id']));
                        array_push($_SESSION['cart'], $order_line);
                    }
                }
            }

            header('Location: ' . $_SERVER['HTTP_REFERER'].'&offcanvas=cart');

        } else {

            header("Location:?controller=users&action=account#pills-login");
        }
    }

    public function deleteCart()
    {
        session_start();

        if (isset($_POST['id'])) {

            $pos = $_POST['pos'];

            unset($_SESSION['cart'][$pos]);

            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }

        header("Location:?controller=producto&action=compra");
    }
    
}