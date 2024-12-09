<?php

include_once("config/db.php");
include_once("models/Category.php");

class CategoryDAO {

    public static function getCategories($order = 'id') {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM CATEGORY");
        $stmt->execute();
        $result = $stmt->get_result();
        $categories = [];
        while($rows = $result->fetch_object('Category')) {
            $categories[] = $rows;
        }
        $conn->close();
        
        return $categories;
    }

    public static function getCategory($id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM CATEGORY WHERE id = $id");
        $stmt->execute();
        $result = $stmt->get_result();

        while($rows = $result->fetch_object('Category')) {
            $category = $rows;
        }
        $conn->close();
        
        return $category;
    }


    public static function store($category) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("INSERT INTO CATEGORY (name,description) VALUES (?,?);");
        $stmt->bind_param("ss",
                $category->getName(),
                $category->getDescription(),
        );

        //TODO

        $stmt->execute();
        $conn->close();
    }

    public static function destroy($id){
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("DELETE FROM CATEGORY WHERE ID=?;");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $conn->close();
    }

}