<?php

include_once("models/CategoryDAO.php");
include_once("models/ArticleDAO.php");
include_once("models/OrderDAO.php");
include_once("models/OrderLine.php");
include_once("models/Complement.php");
include_once("models/Product.php");
include_once("models/Category.php");

class cartController{

    public function index() {
        header("Location:?controller=cart&action=show");
    }
    
    public function show() {
        
        session_start();

        $complements = ArticleDAO::indexComplementsById();
        $products = ArticleDAO::indexProductsById();
        $categories = CategoryDAO::getCategories();

        $view="views/carrito.php";

        include_once("views/main.php");
    }

    public function cleanCart() {
        
        session_start();

        array_pop($_SESSION['cart']);

        var_dump($_SESSION['cart']);
    }

    public function quantity() {
        
        session_start();

        if ($_POST['quantity'] == 0) {
            array_splice($_SESSION['cart'], $_POST['pos'], 1);
        } else {
            $_SESSION['cart'][$_POST['pos']]->setQuantity($_POST['quantity']);
        }

        header("Location:?controller=cart&action=show");
    }

    public function remove() {
        session_start();

        array_splice($_SESSION['cart'], $_GET['pos'], 1);

        header("Location:?controller=cart&action=show");
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
                        $order_line = new OrderLine($article_id,$quantity,ArticleDAO::getPrice($_POST['id']));
                        array_push($_SESSION['cart'], $order_line);
                    }
                }else if (isset($_GET['id'])) {
                    $article_id = $_GET['id'];
                    $pedidoExistente = false;

                    foreach ($_SESSION['cart'] as $order_line) {
                        if ($order_line->getArticleId() == $article_id) {
                            $order_line->setQuantity($order_line->getQuantity() + $quantity);
                            $pedidoExistente = true;
                            break;
                        }
                    }

                    if ($pedidoExistente == false) {
                        $order_line = new OrderLine($article_id,$quantity,ArticleDAO::getPrice($_GET['id']));
                        array_push($_SESSION['cart'], $order_line);
                    }
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }

            header('Location: ' . $_SERVER['HTTP_REFERER'].'&offcanvas=cart');

        } else {

            header("Location:?controller=users&action=account#pills-login");
        }
    }

    public function complete() {
        session_start();

        $orderId = OrderDAO::createOrder($_SESSION['user']->getId(), date("Y-m-d H:i:s"), 'Completed');

        if ($orderId != 0) {
            $lineNumber = 1;
            foreach ($_SESSION['cart'] as $order_line) {
                OrderDAO::createOrderLine($orderId, $lineNumber, $order_line->getArticleId(), $order_line->getQuantity(), $order_line->getPrice(), $order_line->getTotal());
                $lineNumber++;
            }
        }

        unset($_SESSION['cart']);

        header("Location:?controller=cart&action=confirmation&id=$orderId");
    }

    public function confirmation() {
        session_start();

        $order = OrderDAO::getOrder($_GET['id']);

        if ($order->getUser_id() != $_SESSION['user']->getId()) {
            header("Location:?controller=restaurant");
        }

        $order_lines = OrderDAO::getOrderLines($_GET['id']);
        $products = ArticleDAO::indexProductsById();
        $complements = ArticleDAO::indexComplementsById();

        $view="views/confirmation.php";

        include_once("views/main.php");
    }

    public function orderAgain() {
        session_start();

        $order = OrderDAO::getOrder($_GET['id']);

        if ($order->getUser_id() != $_SESSION['user']->getId()) {
            header("Location:?controller=restaurant");
        }else{
            $_SESSION['cart'] = OrderDAO::getOrderLines($_GET['id']);
        }

        header("Location:?controller=cart&action=show");
    }

    // public function deleteCart()
    // {
    //     session_start();

    //     if (isset($_POST['id'])) {

    //         $pos = $_POST['pos'];

    //         unset($_SESSION['cart'][$pos]);

    //         $_SESSION['cart'] = array_values($_SESSION['cart']);
    //     }

    //     header("Location:?controller=producto&action=compra");
    // }
    
    // public function updateCart()
    // {
    //     session_start();

    //     if (isset($_POST['id'])) {

    //         $pos = $_POST['pos'];

    //         unset($_SESSION['cart'][$pos]);

    //         $_SESSION['cart'] = array_values($_SESSION['cart']);
    //     }

    //     header("Location:?controller=producto&action=compra");
    // }

}