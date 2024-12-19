<?php

include_once("config/db.php");

include_once("models/CategoryDAO.php");
include_once("models/ArticleDAO.php");
include_once("models/UserDAO.php");
include_once("models/Complement.php");
include_once("models/Product.php");
include_once("models/Category.php");
include_once("models/User.php");

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
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['name'], $data['surname'], $data['email'], $data['password'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $name = $data['name'];
    $surname = $data['surname'];
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_BCRYPT);

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
    $data = $data['data'];

    if (!isset($data['id'],$data['name'], $data['surname'], $data['email'], $data['password'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $data['id'];
    $name = $data['name'];
    $surname = $data['surname'];
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_BCRYPT);

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
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['user_id'], $data['total_amount'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $user_id = ->real_escape_string($data['user_id']);
    $total_amount = ->real_escape_string($data['total_amount']);

    $stmt = ->prepare("INSERT INTO restaurant.ORDER (user_id, total_amount) VALUES (?, ?)");
    $stmt->bind_param("id", $user_id, $total_amount);

    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(["success" => "Order created"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to create order"]);
    }
}

function updateOrder() {
    $data = json_decode(file_get_contents("php://input"), true);
    $data = $data['data'];

    if (!isset($data['id'], $data['total_amount'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $data['id'];
    $total_amount = ->real_escape_string($data['total_amount']);

    $stmt = ->prepare("UPDATE restaurant.ORDER SET total_amount = ? WHERE id = ?");
    $stmt->bind_param("di", $total_amount, $id);

    if ($stmt->execute()) {
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
    $data = json_decode(file_get_contents("php://input"), true);
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

    $article = new Article($category_id,$name,$description,$price,$type,$IMG,$novedad);
    $result = ArticleDAO::store($article);

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
    $data = $data['data'];

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
