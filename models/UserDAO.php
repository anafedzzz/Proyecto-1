<?php

include_once("config/db.php");
include_once("models/User.php");

class UserDAO {

// Función para registrar un nuevo usuario
public static function register($name, $surname, $email, $password, $phoneNumber = null, $address = null, $roleId = null) {
    $conn = DBConnection::connection();
    $stmt = $conn->prepare("INSERT INTO USER (name, surname, email, password, phone_number, address, role_id) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Encripta la contraseña antes de guardarla
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt->bind_param('ssssssi', $name, $surname, $email, $hashedPassword, $phoneNumber, $address, $roleId);

    if ($stmt->execute()) {
        $userId = $conn->insert_id; //ID del usuario recién creado
        
        $conn->close();
        return $userId; 
    }

    $conn->close();
    return null; // Devuelve null si el registro falla
}


    // Función para iniciar sesión
    public static function logIn($email, $password) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM USER WHERE email = '". $email."'");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_object('User')) {
            if (password_verify($password, $user->getPassword())) { //TODO #1 HASHED PASSWORD
                $conn->close();
                return $user; // Devuelve el usuario si la contraseña es correcta
            }
        }

        $conn->close();
        return null;
    }

    // Función para verificar si un email ya existe en la base de datos
    public static function checkMail($email) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM USER WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $conn->close();
        return $row['count'] > 0; // Retorna true si el email ya existe
    }

    // Función para obtener un usuario por su ID
    public static function getUserById($id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM USER WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = $result->fetch_object('User');
        $conn->close();
        return $user; // Retorna el usuario si existe, sino null
    }

    // Función para actualizar un usuario
    public static function updateUser($id, $name, $surname, $email, $roleId, $phoneNumber = null, $address = null) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("UPDATE USER SET name = ?, surname = ?, email = ?, role_id = ?, phone_number = ?, address = ? WHERE id = ?");

        $stmt->bind_param('sssissi', $name, $surname, $email, $roleId, $phoneNumber, $address, $id);
        $success = $stmt->execute();
        $conn->close();

        return $success; // Retorna true si la actualización se ha realizado correctamente
    }

    public static function getUsers() {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM restaurant.USER;");
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        $conn->close();
        
        return $users;
    }

    public static function destroy($id){
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("DELETE FROM restaurant.USER WHERE id = ?");
        $stmt->bind_param("i", $id);

        $result = $stmt->execute();
        $conn->close();

        return $result;
    }
}

?>