<?php

include_once("config/db.php");
include_once("models/Order.php");

class OrderDAO {

    public static function update($id, $user_id, $date, $status, $promo_code_id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("UPDATE restaurant.ORDER SET user_id=?,date=?,status=?".($promo_code_id == "" ? "" : ", promo_code_id=?")." WHERE id = ?");
        
        if ($promo_code_id == "") {
            $stmt->bind_param("issi", $user_id, $date, $status, $id);
        }else{
            $stmt->bind_param("issii", $user_id, $date, $status, $promo_code_id, $id);
        }

        $result = $stmt->execute();
        $conn->close();

        return $result;
    }

    public static function create($user_id, $date, $status, $promo_code_id){
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("INSERT INTO restaurant.ORDER (user_id, date, status".($promo_code_id == "" ? "" : ", promo_code_id").") VALUES (?,?,?".($promo_code_id == "" ? "" : ",?").")");
        
        if ($promo_code_id != "") {
            $stmt->bind_param("issi", $user_id, $date, $status, $promo_code_id);
        }else{
            $stmt->bind_param("iss", $user_id, $date, $status);
        }

        $result = $stmt->execute();
        $id = $conn->insert_id;
        
        $conn->close();
        return $id;
    }

    public static function createOrder($user_id, $date, $status, $promo_code_id=null){
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("INSERT INTO restaurant.ORDER (user_id, date, status, promo_code_id) VALUES (?,?,?,?)");
        
        $stmt->bind_param("issi", $user_id, $date, $status, $promo_code_id);

        $result = $stmt->execute();
        $insertedId = $conn->insert_id;

        $conn->close();

        return $insertedId;
    }

    public static function createOrderLine($order_id, $lineNumber, $article_id, $quantity, $price, $total, $special_offer_id=null){
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("INSERT INTO restaurant.ORDER_LINE (order_id, line_number, article_id, special_offer_id, quantity,total, price) VALUES (?,?,?,?,?,?,?)");
        
        $stmt->bind_param("iiiiidd", $order_id, $lineNumber, $article_id, $special_offer_id, $quantity, $total, $price);

        $result = $stmt->execute();
        $conn->close();

        return $result;
    }

    public static function getOrders() {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM restaurant.ORDER;");
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        $conn->close();
        
        return $orders;
    }

    public static function destroy($id){
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("DELETE FROM restaurant.ORDER WHERE id = ?");
        $stmt->bind_param("i", $id);

        $result = $stmt->execute();
        $conn->close();

        return $result;
    }

    public static function getOrdersById($id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare(     "SELECT o.id,
                                            o.user_id,
                                            o.date,
                                            o.status,
                                            o.promo_code_id,
                                            SUM(ol.total) AS total
                                    FROM restaurant.ORDER o
                                    JOIN restaurant.ORDER_LINE ol ON o.id = ol.order_id
                                    WHERE o.user_id = ?
                                    GROUP BY ol.order_id;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = [];
        while($rows = $result->fetch_object('Order')) {
            $orders[] = $rows;
        }
        $conn->close();
        
        return $orders;
    }

    public static function getOrder($id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare(     "SELECT o.id,
                                            o.user_id,
                                            o.date,
                                            o.status,
                                            o.promo_code_id,
                                            SUM(ol.total) AS total
                                    FROM restaurant.ORDER o
                                    JOIN restaurant.ORDER_LINE ol ON o.id = ol.order_id
                                    WHERE o.id = $id
                                    GROUP BY o.id;
                                    ;");
        $stmt->execute();
        $result = $stmt->get_result();

        while($rows = $result->fetch_object('Order')) {
            $order = $rows;
        }
        $conn->close();
        
        return $order;
    }

    public static function getOrderLines($id) {
        $conn = DBConnection::connection();
        $stmt = $conn->prepare("SELECT * FROM restaurant.ORDER_LINE WHERE order_id = $id;");
        $stmt->execute();
        $result = $stmt->get_result();
        $order_lines = [];
        while($rows = $result->fetch_object('OrderLine')) {
            $order_lines[] = $rows;
        }
        $conn->close();
        
        return $order_lines;
    }
}

?>