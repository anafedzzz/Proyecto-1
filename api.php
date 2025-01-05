<?php

include_once("config/db.php");

include_once("models/CategoryDAO.php");
include_once("models/ArticleDAO.php");
include_once("models/UserDAO.php");
include_once("models/OrderDAO.php");
include_once("models/Complement.php");
include_once("models/Product.php");
include_once("models/Category.php");
include_once("models/User.php");
include_once("models/Order.php");

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$resource = isset($_GET['resource']) ? $_GET['resource'] : null;
$method = $_SERVER['REQUEST_METHOD'];

if (!$resource) {
    http_response_code(400);
    echo json_encode(["error" => "Resource not specified"]);
    exit();
}


switch ($resource) {
    case "users":
        handleUsers($method);
        break;
    case "orders":
        handleOrders($method);
        break;
    case "articles":
        handleArticles($method);
        break;
    default:
        http_response_code(404);
        echo json_encode(["error" => "Resource not found"]);
        break;
}

function handleUsers($method) {
    switch ($method) {
        case "GET":
            getUsers();
            break;
        case "POST":
            createUser();
            break;
        case "PUT":
            updateUser();
            break;
        case "DELETE":
            deleteUser();
            break;
        default:
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
            break;
    }
}

function getUsers() {
    $users = UserDAO::getUsers();

    echo json_encode($users);
}

function createUser() {
    $data = $_POST;
    if (!isset($data['name'], $data['surname'], $data['email'], $data['password'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $name = $data['name'];
    $surname = $data['surname'];
    $email = $data['email'];
    $password = $data['password'];

    $result = UserDAO::register($name,$surname,$email,$password);

    if ($result!=null) {
        http_response_code(201);
        echo json_encode(["success" => "User created"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to create user"]);
    }
}

function updateUser() {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'],$data['name'], $data['surname'], $data['email'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $data['id'];
    $name = $data['name'];
    $surname = $data['surname'];
    $email = $data['email'];

    $result = UserDAO::updateUser($id, $name, $surname, $email);

    if ($result) {
        echo json_encode(["success" => "User updated"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to update user"]);
    }
}

function deleteUser() {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $data['id'];

    $result = UserDAO::destroy($id);

    if ($result) {
        echo json_encode(["success" => "User deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to delete User"]);
    }
}

function handleOrders($method) {
    switch ($method) {
        case "GET":
            getOrders();
            break;
        case "POST":
            createOrder();
            break;
        case "PUT":
            updateOrder();
            break;
        case "DELETE":
            deleteOrder();
            break;
        default:
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
            break;
    }
}

function getOrders() {
    $orders = OrderDAO::getOrders();

    echo json_encode($orders);
}

function createOrder() {
    $data = $_POST;

    if (!isset($data['user_id'], $data['date'], $data['status'], $data['promo_code_id'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $user_id = $data['user_id'];
    $date = $data['date'];
    $status = $data['status'];
    $promo_code_id = $data['promo_code_id'];

    $result = OrderDAO::create($user_id, $date, $status, $promo_code_id);

    if ($result) {
        http_response_code(201);
        echo json_encode(["success" => "Order created"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to create order"]);
    }
}

function updateOrder() {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'], $data['user_id'], $data['date'], $data['status'], $data['promo_code_id'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $data['id'];
    $user_id = $data['user_id'];
    $date = $data['date'];
    $status = $data['status'];
    $promo_code_id = $data['promo_code_id'];

    $result = OrderDAO::update($id, $user_id, $date, $status, $promo_code_id);

    if ($result) {

        echo json_encode(["success" => "Order updated"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to update order"]);
    }
}

function deleteOrder() {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $data['id'];

    $result = OrderDAO::destroy($id);

    if ($result) {
        echo json_encode(["success" => "Order deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to delete order"]);
    }
}

function handleArticles($method) {
    switch ($method) {
        case "GET":
            getArticles();
            break;
        case "POST":
            createArticle();
            break;
        case "PUT":
            updateArticle();
            break;
        case "DELETE":
            deleteArticle();
            break;
        default:
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
            break;
    }
}

// Obtener todos los artículos
function getArticles() {
    $articles = ArticleDAO::getArticles();

    echo json_encode($articles);
}

// Crear un artículo
function createArticle() {
    
    $data = $_POST;
    
    if (isset($_FILES['IMG'])) {
        $uploadDir = 'img/';
        $uploadFile = $uploadDir . basename($_FILES['IMG']['name']);
        if (!move_uploaded_file($_FILES['IMG']['tmp_name'], $uploadFile)) {
            http_response_code(500);
            echo json_encode(["error" => "Failed to save image"]);
        }else{
            $data['IMG'] = basename($_FILES['IMG']['name']);
        }
    }

    if (!isset($data['name'], $data['description'], $data['price'], $data['category_id'], $data['type'], $data['IMG'], $data['novedad'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];
    $category_id = $data['category_id'];
    $type = $data['type'];
    $IMG = $data['IMG'];
    $novedad = $data['novedad'];

    $result = ArticleDAO::store($category_id,$name,$description,$price,$type,$IMG,$novedad);

    if ($result) {
        http_response_code(201);
        echo json_encode(["success" => "Article created"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to create article"]);
    }
}

// Actualizar un artículo
function updateArticle() {

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'], $data['name'], $data['description'], $data['price'], $data['category_id'], $data['type'], $data['IMG'], $data['novedad'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $data['id'];
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];
    $category_id = $data['category_id'];
    $type = $data['type'];
    $IMG = $data['IMG'];
    $novedad = $data['novedad'];

    $result = ArticleDAO::update($id,$category_id,$name,$description,$price,$type,$IMG,$novedad);

    if ($result) {
        echo json_encode(["success" => "Article updated"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to update article"]);
    }
}

// Eliminar un artículo
function deleteArticle() {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $data['id'];

    $result = ArticleDAO::destroy($id);

    if ($result) {
        echo json_encode(["success" => "Article deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to delete article"]);
    }
}
