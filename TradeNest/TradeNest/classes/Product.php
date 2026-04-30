<?php
class Product {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($user_id, $name, $price, $description, $image) {
        $stmt = $this->db->prepare("INSERT INTO products (user_id, name, price, description, image) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $name, $price, $description, $image]);
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT p.*, u.name as seller_name FROM products p JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT p.*, u.name as seller_name FROM products p JOIN users u ON p.user_id = u.id WHERE p.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByUserId($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $user_id, $data) {
        $fields = [];
        $values = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }
        $values[] = $id;
        $values[] = $user_id;
        $sql = "UPDATE products SET " . implode(', ', $fields) . " WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    public function delete($id, $user_id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $user_id]);
    }

    public function search($query) {
        $stmt = $this->db->prepare("SELECT p.*, u.name as seller_name FROM products p JOIN users u ON p.user_id = u.id WHERE p.name LIKE ? OR p.description LIKE ?");
        $stmt->execute(["%$query%", "%$query%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
