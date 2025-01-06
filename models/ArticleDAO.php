<?php

include_once("config/db.php");
include_once("models/Article.php");

class ArticleDAO {

    public static function getBestSelling($quantity) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT a.id,a.name,a.IMG
                                FROM ARTICLE a
                                JOIN ORDER_LINE ol ON a.id = ol.article_id
                                WHERE a.type = 'product'
                                GROUP BY a.id
                                ORDER BY SUM(ol.quantity) DESC
                                LIMIT $quantity;");
        
        $stmt->execute();
        $result = $stmt->get_result();
        $articles = [];
        while($rows = $result->fetch_object('Product')) {
            $articles[] = $rows;
        }
        $conn->close();
        
        return $articles;
    }

    public static function indexProductsById() {
        
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM ARTICLE WHERE type = 'product'");
        $stmt->execute();
        $result = $stmt->get_result();
        $articles = [];
        while($rows = $result->fetch_object('Product')) {
            $articles[$rows->getId()] = $rows;
        }
        $conn->close();

        return $articles;
    }

    public static function indexComplementsById() {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM ARTICLE WHERE type = 'complement'");
        $stmt->execute();
        $result = $stmt->get_result();
        $articles = [];
        while($rows = $result->fetch_object('Complement')) {
            $articles[$rows->getId()] = $rows;
        }
        $conn->close();
        
        return $articles;
    }
    

    public static function getProducts($order = 'id') {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM ARTICLE WHERE type = 'product'");
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while($rows = $result->fetch_object('Product')) {
            $products[] = $rows;
        }
        $conn->close();
        
        return $products;
    }

    public static function getRelatedProducts($categoryId,$id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM ARTICLE WHERE category_id = $categoryId AND id<>$id");
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while($rows = $result->fetch_object('Product')) {
            $products[] = $rows;
        }
        $conn->close();
        
        return $products;
    }

    public static function getProduct($id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM ARTICLE WHERE id = $id");
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_object('Product')) {
            $product = $row;
        }
        $conn->close();
        
        return $product;
    }

    public static function getPrice($id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT price FROM ARTICLE WHERE id = $id");
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_object('Product')) {
            $price = $row->getPrice();
        }
        $conn->close();
        
        return $price;
    }

    public static function store($category_id,$name,$description,$price,$type,$IMG,$novedad) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("INSERT INTO ARTICLE (category_id,name,description,price,type,IMG,novedad) VALUES (?,?,?,?,?,?,?);");
        $stmt->bind_param("issdssi",
                $category_id,
                $name,
                $description,
                $price,
                $type,
                $IMG,
                $novedad
        );

        //TODO

        $result = $stmt->execute();
        $id = $conn->insert_id;
        
        $conn->close();
        return $id;
    }

    public static function update($id,$category_id,$name,$description,$price,$type,$IMG,$novedad) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("UPDATE restaurant.ARTICLE SET category_id = ?, name = ?, description = ?, price = ?, type = ?, IMG = ?, novedad = ? WHERE id = ?");
        $stmt->bind_param("issdssii", $category_id, $name, $description, $price, $type, $IMG, $novedad, $id);

        $result = $stmt->execute();
        $id = $conn->insert_id;
        
        $conn->close();
        return $id;
    }

    public static function destroy($id){
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("DELETE FROM restaurant.ARTICLE WHERE ID=?;");
        $stmt->bind_param("i",$id);

        $result = $stmt->execute();
        $conn->close();

        return $result;
    }

    public static function getArticles() {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM restaurant.ARTICLE;");
        $stmt->execute();
        $result = $stmt->get_result();
        $articles = [];
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
        $conn->close();
        
        return $articles;
    }

}