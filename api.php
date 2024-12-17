<?php

include_once("config/db.php");

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$mysqli = DBConnection::connection();


$resource = isset($_GET['resource']) ? $_GET['resource'] : null;
$method = $_SERVER['REQUEST_METHOD'];

if (!$resource) {
    http_response_code(400);
    echo json_encode(["error" => "Resource not specified"]);
    exit();
}


switch ($resource) {
    case "users":
        handleUsers($mysqli, $method);
        break;
    case "orders":
        handleOrders($mysqli, $method);
        break;
    case "articles":
        handleArticles($mysqli, $method);
        break;
    default:
        http_response_code(404);
        echo json_encode(["error" => "Resource not found"]);
        break;
}

function handleUsers($mysqli, $method) {
    switch ($method) {
        case "GET":
            getUsers($mysqli);
            break;
        case "POST":
            createUser($mysqli);
            break;
        case "PUT":
            updateUser($mysqli);
            break;
        case "DELETE":
            deleteUser($mysqli);
            break;
        default:
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
            break;
    }
}

function getUsers($mysqli) {
    $result = $mysqli->query("SELECT * FROM restaurant.USER;");
    $users = [];

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode($users);
}

function createUser($mysqli) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['name'], $data['surname'], $data['email'], $data['password'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $name = $mysqli->real_escape_string($data['name']);
    $surname = $mysqli->real_escape_string($data['surname']);
    $email = $mysqli->real_escape_string($data['email']);
    $password = password_hash($data['password'], PASSWORD_BCRYPT);

    $stmt = $mysqli->prepare("INSERT INTO restaurant.USER (name, surname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("ssss", $name, $surname, $email, $password);

    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(["success" => "User created"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to create user"]);
    }
}

function updateUser($mysqli) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['id'], $data['name'], $data['email'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $name = $mysqli->real_escape_string($data['name']);
    $email = $mysqli->real_escape_string($data['email']);
    $id = $data['id'];

    $stmt = $mysqli->prepare("UPDATE restaurant.USER SET name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $email, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => "User updated"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to update user"]);
    }
}

function deleteUser($mysqli) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $data['id'];
    $stmt = $mysqli->prepare("DELETE FROM restaurant.USER WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => "User deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to delete user"]);
    }
}

function handleOrders($mysqli, $method) {
    switch ($method) {
        case "GET":
            getOrders($mysqli);
            break;
        case "POST":
            createOrder($mysqli);
            break;
        case "PUT":
            updateOrder($mysqli);
            break;
        case "DELETE":
            deleteOrder($mysqli);
            break;
        default:
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
            break;
    }
}

function getOrders($mysqli) {
    $result = $mysqli->query("SELECT * FROM restaurant.ORDER;");
    $orders = [];

    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    echo json_encode($orders);
}

function createOrder($mysqli) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['user_id'], $data['total_amount'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $user_id = $mysqli->real_escape_string($data['user_id']);
    $total_amount = $mysqli->real_escape_string($data['total_amount']);

    $stmt = $mysqli->prepare("INSERT INTO restaurant.ORDER (user_id, total_amount) VALUES (?, ?)");
    $stmt->bind_param("id", $user_id, $total_amount);

    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(["success" => "Order created"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to create order"]);
    }
}

function updateOrder($mysqli) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['id'], $data['total_amount'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $data['id'];
    $total_amount = $mysqli->real_escape_string($data['total_amount']);

    $stmt = $mysqli->prepare("UPDATE restaurant.ORDER SET total_amount = ? WHERE id = ?");
    $stmt->bind_param("di", $total_amount, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Order updated"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to update order"]);
    }
}

function deleteOrder($mysqli) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $data['id'];

    $stmt = $mysqli->prepare("DELETE FROM restaurant.ORDER WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Order deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to delete order"]);
    }
}

function handleArticles($mysqli, $method) {
    switch ($method) {
        case "GET":
            getArticles($mysqli);
            break;
        case "POST":
            createArticle($mysqli);
            break;
        case "PUT":
            updateArticle($mysqli);
            break;
        case "DELETE":
            deleteArticle($mysqli);
            break;
        default:
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
            break;
    }
}

// Obtener todos los artículos
function getArticles($mysqli) {
    $result = $mysqli->query("SELECT * FROM restaurant.ARTICLE;");
    $articles = [];

    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }

    echo json_encode($articles);
}

// Crear un artículo
function createArticle($mysqli) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['name'], $data['description'], $data['price'], $data['category_id'], $data['type'], $data['IMG'], $data['novedad'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $name = $mysqli->real_escape_string($data['name']);
    $description = $mysqli->real_escape_string($data['description']);
    $price = $mysqli->real_escape_string($data['price']);
    $category_id = $mysqli->real_escape_string($data['category_id']);
    $type = $mysqli->real_escape_string($data['type']);
    $IMG = $mysqli->real_escape_string($data['IMG']);
    $novedad = $mysqli->real_escape_string($data['novedad']);

    $stmt = $mysqli->prepare("INSERT INTO restaurant.ARTICLE (category_id, name, description, price, type, IMG, novedad) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issdssi", $category_id, $name, $description, $price, $type, $IMG, $novedad);

    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(["success" => "Article created"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to create article"]);
    }
}

// Actualizar un artículo
function updateArticle($mysqli) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['id'], $data['name'], $data['description'], $data['price'], $data['category_id'], $data['type'], $data['IMG'], $data['novedad'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $mysqli->real_escape_string($data['id']);
    $name = $mysqli->real_escape_string($data['name']);
    $description = $mysqli->real_escape_string($data['description']);
    $price = $mysqli->real_escape_string($data['price']);
    $category_id = $mysqli->real_escape_string($data['category_id']);
    $type = $mysqli->real_escape_string($data['type']);
    $IMG = $mysqli->real_escape_string($data['IMG']);
    $novedad = $mysqli->real_escape_string($data['novedad']);

    $stmt = $mysqli->prepare("UPDATE restaurant.ARTICLE SET category_id = ?, name = ?, description = ?, price = ?, type = ?, IMG = ?, novedad = ? WHERE id = ?");
    $stmt->bind_param("issdssii", $category_id, $name, $description, $price, $type, $IMG, $novedad, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Article updated"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to update article"]);
    }
}

// Eliminar un artículo
function deleteArticle($mysqli) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }

    $id = $mysqli->real_escape_string($data['id']);

    $stmt = $mysqli->prepare("DELETE FROM restaurant.ARTICLE WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Article deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to delete article"]);
    }
}
