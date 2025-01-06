<?php

require_once ("config/db.php");

class ActionsLogDAO {

    /**
     * Insert a new action log into the database.
     * 
     * @param string $action The type of action performed (e.g., "create", "update", "delete").
     * @param string $item The name of the item being acted upon (e.g., "article", "user").
     * @param int $itemId The ID of the item being acted upon.
     * @return bool True on success, False on failure.
     */

    public static function insert($action, $item, $itemId) {
        $conn = DBConnection::connection();

        $stmt = $conn->prepare("INSERT INTO ACTIONS_LOG (action, item, item_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $action, $item, $itemId);

        $result = $stmt->execute();
        $stmt->close();
        $conn->close();

        return $result;
    }

    /**
     * Get all action logs from the database.
     * 
     * @return array An array of action log objects.
     */
    public static function getAll() {
        $conn = DBConnection::connection();

        $stmt = $conn->prepare("SELECT * FROM ACTIONS_LOG");
        $stmt->execute();

        $result = $stmt->get_result();
        $actionsLog = [];

        while ($row = $result->fetch_assoc()) {
            $actionsLog[] = $row;
        }

        $conn->close();

        return $actionsLog;
    }

    /**
     * Get action logs filtered by a specific criterion.
     * 
     * @param string $column The column to filter by (e.g., "action", "item").
     * @param mixed $value The value to filter by.
     * @return array An array of action log objects matching the filter.
     */
    public static function getBy($column, $value) {
        $conn = DBConnection::connection();

        // Prevent SQL injection by ensuring column name is safe
        $allowedColumns = ['id', 'action', 'item', 'item_id'];
        if (!in_array($column, $allowedColumns)) {
            throw new InvalidArgumentException("Invalid column name provided");
        }

        $stmt = $conn->prepare("SELECT * FROM ACTIONS_LOG WHERE $column = ?");
        $stmt->bind_param("s", $value);
        $stmt->execute();

        $result = $stmt->get_result();
        $actionsLog = [];

        while ($row = $result->fetch_assoc()) {
            $actionsLog[] = $row;
        }

        $stmt->close();
        $conn->close();

        return $actionsLog;
    }
}

?>
