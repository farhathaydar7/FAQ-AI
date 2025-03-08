<?php
require_once 'config/database.php';

class Faq {
    private $id;
    private $question;
    private $answer;

    public function __construct($question = null, $answer = null) {
        $this->question = $question;
        $this->answer = $answer;
    }

    private static function getDB() {
        return new PDO(DB_DSN, DB_USER, DB_PASS);
    }

   
    
    public function create() {
        $db = self::getDB();
        $stmt = $db->prepare("INSERT INTO faqs (question, answer) VALUES (?, ?)");
        $success = $stmt->execute([$this->question, $this->answer]);
        
        if($success) $this->id = $db->lastInsertId();
        return $success;
    }

    public function update() {
        $db = self::getDB();
        $stmt = $db->prepare("UPDATE faqs SET question = ?, answer = ? WHERE id = ?");
        return $stmt->execute([$this->question, $this->answer, $this->id]);
    }

    public function delete() {
        $db = self::getDB();
        $stmt = $db->prepare("DELETE FROM faqs WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    
    
    public static function findById($id) {
        $db = self::getDB();
        $stmt = $db->prepare("SELECT * FROM faqs WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $faq = new Faq();
            $faq->id = $row['id'];
            $faq->question = $row['question'];
            $faq->answer = $row['answer'];
            return $faq;
        }
        return null;
    }

    public static function getAll() {
        $db = self::getDB();
        $stmt = $db->query("SELECT * FROM faqs");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Faq');
    }

    // Getters and Setters
    public function getId() { return $this->id; }
    public function getQuestion() { return $this->question; }
    public function setQuestion($question) { $this->question = $question; }
    public function getAnswer() { return $this->answer; }
    public function setAnswer($answer) { $this->answer = $answer; }
}