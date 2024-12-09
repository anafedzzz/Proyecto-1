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
    }//TODO

    public static function getArticles($order = 'id') {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM ARTICLE");
        $stmt->execute();
        $result = $stmt->get_result();
        $articles = [];
        while($rows = $result->fetch_object('Article')) {
            $articles[] = $rows;
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

    public static function store($article) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("INSERT INTO article (category_id,name,description,price,type) VALUES (?,?,?,?,?);");
        $stmt->bind_param("issds",
                $article->getCategory_id(),
                $article->getName(),
                $article->getDescription(),
                $article->getPrice(),
                $article->getType()
        );

        //TODO

        $stmt->execute();
        $conn->close();
    }

    public static function destroy($id){
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("DELETE FROM article WHERE ID=?;");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $conn->close();
    }

}