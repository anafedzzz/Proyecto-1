<?php

include_once("config/db.php");
include_once("models/Order.php");

class OrderDAO {

    public static function update(){} //todo #6

    public static function create(){} //todo #7


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
                                    WHERE o.user_id = $id
                                    GROUP BY o.id;
                                    ;");
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = [];
        while($rows = $result->fetch_object('Order')) {
            $orders[] = $rows;
        }
        $conn->close();
        
        return $orders;
    }

}

?>