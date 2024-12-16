<?php

include_once("models/UserDAO.php");
include_once("models/User.php");


class usersController{
    
    public function index() {
        header("Location:?controller=restaurant&action=index");
    }

    public function account(){

        session_start();

        $view="views/login.php";

        include_once("views/main.php");
        
    }

    public function sessionStart(){
        session_start();

        $view="views/login.php";

        include_once("views/main.php");
    }

    public function logIn(){

        session_start();

        $mail = $_POST['mail'];
        $password = $_POST['password'];
        if (isset($_POST['rememberMe'])) {
            $rememberMe =$_POST['rememberMe'];
        }
        

        $user = UserDAO::logIn($mail, $password);

        if ($user != null) {

            $_SESSION['user'] = $user;

            // if ($rememberMe) {
            //     // Crear datos de la cookie
            //     $userId = $user->getId();
            //     $token = bin2hex(random_bytes(32)); // Token aleatorio seguro
            //     $hash = hash_hmac('sha256', $userId . $token, 'secret_key'); // Genera un hash seguro
    
            //     // Almacenar datos en una cookie
            //     setcookie('remember_me', "$userId|$token|$hash", time() + (30 * 24 * 60 * 60), "/", "", true, true); // 30 días
            // }

            header("Location:?controller=restaurant");
        } else {

            header("Location:?controller=users&action=account#pills-login");
        }
        
    }

    public function register(){
        session_start();

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];

        $mailExists = UserDAO::checkMail($mail);

        if (!$mailExists) {

            $user = UserDAO::register($name, $surname, $mail, $password);

            if ($user != null) {

                $_SESSION['user'] = $user;

            }else {

                $_SESSION['error'] = "Something went wrong.";
                header("Location:?controller=users&action=account#pills-register");    
            }

            header("Location:?controller=restaurant");
        } else {

            $_SESSION['error'] = "The email is already registered. Please try another.";
            header("Location:?controller=users&action=account#pills-register");
            var_dump($_SESSION);
        }
        //
    }

    public function userPage()
    {
        session_start();

        $id = $_SESSION['user']->getId();

        // $pedidos = PedidosDAO::getPedidos($id);

        // if (isset($_COOKIE['ultimoPedido'])) {
        //     $ultimoPedido = PedidosDAO::getUltimoPedidoCookies($_COOKIE['ultimoPedido']);
        // }

        $view="views/profile.php";

        include_once("views/main.php");

    }

    public function logOut()
    {
        session_start();

        unset($_SESSION['user']);

        

        header("Location:?controller=restaurant");
    }

    public function updateProfile()
    {

        session_start();

        $id         = $_SESSION['user']->getId();
        $nombre     = $_POST['name'];
        $apellido   = $_POST['surname'];
        $email      = $_POST['email'];
        $phone      = $_POST['phone'];
        $address    = $_POST['address'];


        $success = UserDAO::updateUser($id, $nombre, $apellido, $email, $phone,$address);

        $_SESSION['user']=UserDAO::getUserById($id);


        header("Location:?controller=users&action=userPage");
    }


}