<?php
class Order {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function place($user_id, $total_amount, $items) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_amount) VALUES (?, ?)");
            $stmt->execute([$user_id, $total_amount]);
            $order_id = $this->db->lastInsertId();

            foreach ($items as $item) {
                $stmt_item = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmt_item->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
            }

            $this->db->commit();
            return $order_id;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getByUserId($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id, $user_id) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $user_id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order) {
            $stmt_items = $this->db->prepare("SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
            $stmt_items->execute([$id]);
            $order['items'] = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
        }
        return $order;
    }

    public function getReceivedOrders($seller_id) {
        $stmt = $this->db->prepare("
            SELECT o.*, oi.quantity, oi.price as item_price, p.name as product_name, u.name as buyer_name 
            FROM order_items oi 
            JOIN orders o ON oi.order_id = o.id 
            JOIN products p ON oi.product_id = p.id 
            JOIN users u ON o.user_id = u.id
            WHERE p.user_id = ? 
            ORDER BY o.created_at DESC
        ");
        $stmt->execute([$seller_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
