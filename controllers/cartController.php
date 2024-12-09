<?php

include_once("models/CategoryDAO.php");
include_once("models/ArticleDAO.php");
include_once("models/Complement.php");
include_once("models/Product.php");
include_once("models/Category.php");

class cartController{

    public function show() {
        
        $view="views/carrito.php";

        include_once("views/main.php");
    }

    public function addCart()
    {

        session_start();

        if (isset($_SESSION['usuario'])) {

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = array();
            } else {
                if (isset($_POST['id'])) {
                    $producto_id = $_POST['id'];
                    $pedidoExistente = false;

                    foreach ($_SESSION['carrito'] as $pedido) {
                        if ($pedido->getProducto()->getId() == $producto_id) {
                            $pedido->setCantidad($pedido->getCantidad() + 1);
                            $pedidoExistente = true;
                            break;
                        }
                    }

                    if ($pedidoExistente == false) {
                        // $pedido = new Pedido(ProductoDAO::getProductById($_POST['id']));
                        // array_push($_SESSION['carrito'], $pedido);
                    }
                }
            }

            header("Location:?controller=producto&action=cartaJS");
        } else {

            header("Location:?controller=producto&action=sessionStart");
        }
    }

    public function deleteCart()
    {
        session_start();

        if (isset($_POST['id'])) {

            $pos = $_POST['pos'];

            unset($_SESSION['carrito'][$pos]);

            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        }

        header("Location:?controller=producto&action=compra");
    }
    
}