<?php

require_once ("config/db.php");
include_once ("models/Allergy.php");

class AllergyDAO {

    // Obtener todos los registros de la tabla ALLERGY
    public static function getAllergies() {
        $conn = DBConnection::connection();
        $query = "SELECT * FROM ALLERGY";
        $result = $conn->query($query);

        $allergies = [];
        while ($row = $result->fetch_object('Allergy')) {
            $allergies[] = $row; // Devuelve instancias de Allergy
        }

        $conn->close();
        return $allergies;
    }

    // Obtener una alergia por su ID
    public static function getAllergyById($id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM ALLERGY WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $allergy = $result->fetch_object('Allergy'); // Devuelve una instancia de Allergy

        $stmt->close();
        $conn->close();
        return $allergy;
    }

    public static function getAllergyByProductId($id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM ALLERGY WHERE id IN (SELECT allergy_id FROM restaurant.ARTICLE_ALLERGY WHERE article_id = ?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $allergies = [];
        while ($row = $result->fetch_object('Allergy')) {
            $allergies[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $allergies;
    }

    // Crear una nueva alergia
    public static function createAllergy($name, $description) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("INSERT INTO ALLERGY (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);
        
        $success = $stmt->execute();

        $stmt->close();
        $conn->close();
        return $success;
    }

    // Actualizar una alergia existente
    public static function updateAllergy($id, $name, $description) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("UPDATE ALLERGY SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $description, $id);
        
        $success = $stmt->execute();

        $stmt->close();
        $conn->close();
        return $success;
    }

    // Eliminar una alergia por su ID
    public static function deleteAllergy($id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("DELETE FROM ALLERGY WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        $success = $stmt->execute();

        $stmt->close();
        $conn->close();
        return $success;
    }
}

?>
