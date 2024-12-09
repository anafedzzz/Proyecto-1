<?php

include_once("models/UserDAO.php");
include_once("models/User.php");


class usersController{
    
    public function index() {
        header("Location:?controller=restaurant&action=index");
    }

    public function account(){

        $view="views/home.php";

        include_once("views/main.php");
    }

    public function sessionStart(){
        session_start();

        $view="views/login.php";

        include_once("views/main.php");
    }

    public function logIn(){

        $mail = $_POST['mail'];
        $password = $_POST['password'];

        $users = UserDAO::logIn($mail, $password);

        if ($users != null) {

            session_start();

            $_SESSION['usuario'] = array();

            array_push($_SESSION['usuario'], $users);

            header("Location:?controller=producto");
        } else {

            header("Location:?controller=producto&action=sessionStart");
        }
    }

    public function register()
    {

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];


        $user = UserDAO::checkMail($mail);

        if ($user) {

            $user = UserDAO::register($name, $surname, $mail, $password);

            header("Location:?controller=restaurant");
        } else {

            header("Location:?controller=users&action=sessionStart");
        }
    }

    public function userPage()
    {
        session_start();

        $id = $_SESSION['user'][0]->getId();

        $user = UserDAO::getUserById($id);

        // $pedidos = PedidosDAO::getPedidos($id);

        // if (isset($_COOKIE['ultimoPedido'])) {
        //     $ultimoPedido = PedidosDAO::getUltimoPedidoCookies($_COOKIE['ultimoPedido']);
        // }

        // include_once 'views/header.php';
        // include_once "views/userPage.php";
        // include_once 'views/footer.php';
    }

    public function cerrarSession()
    {
        session_start();

        unset($_SESSION['user']);

        session_destroy();

        header("Location:?controller=producto");
    }

    public function updateUser()
    {

        $id         = $_POST['id'];
        $nombre     = $_POST['nombre'];
        $apellido   = $_POST['apellido'];
        $contraseña = $_POST['contraseña'];
        $email      = $_POST['mail'];


        $cliente = UserDAO::updateUser($id, $nombre, $email, $apellido, $contraseña);


        header("Location:?controller=users&action=userPage");
    }


}