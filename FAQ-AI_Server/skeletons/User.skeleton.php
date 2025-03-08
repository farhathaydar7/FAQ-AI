<?php
require_once __DIR__ . '/../V1/config.php';

class UserSkeleton {
 
    
    private function __construct() {}

  
    private static function getDB() {
        return new PDO(DB_DSN, DB_USER, DB_PASS);
    }

 
    
    public static function create($userModel) {
        $db = self::getDB();
        $stmt = $db->prepare("INSERT INTO users (full_name, username, password) VALUES (?, ?, ?)");
        $success = $stmt->execute([
            $userModel->getFullName(),
            $userModel->getUsername(),
            hash('sha256', $userModel->getPassword())
        ]);
        
        if($success) $userModel->setId($db->lastInsertId());
        return $success;
    }

    public function update() {
        $db = self::getDB();
        $stmt = $db->prepare("UPDATE users SET full_name = ?, username = ?, password = ? WHERE id = ?");
        return $stmt->execute([
            $this->fullName,
            $this->username,
            hash('sha256', $this->password),
            $this->id
        ]);
    }

    public function delete() {
        $db = self::getDB();
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$this->id]);
    }


    
    public static function findById($id) {
        $db = self::getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
                    $user = new User(
                        $row['id'],
                        $row['full_name'],
                        $row['username'],
                        $row['password']
                    );
                    return $user;
                }
                return null;
    }

    public static function getAll() {
        $db = self::getDB();
        $stmt = $db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public static function findByUsername($username) {
        $db = self::getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $user = new User(
                $row['id'],
                $row['full_name'],
                $row['username'],
                $row['password']
            );
            return $user;
        }
        return null;
    }

    public function getId() { return $this->id; }
    public function getFullName() { return $this->fullName; }
    public function setFullName($name) { $this->fullName = $name; }
    public function getUsername() { return $this->username; }
    public function setUsername($username) { $this->username = $username; }
    public function setPassword($password) { $this->password = $password; }
   
}
