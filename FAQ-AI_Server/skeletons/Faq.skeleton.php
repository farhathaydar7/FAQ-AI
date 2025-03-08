<?php
require_once __DIR__ . '/../V1/config.php';

class FaqSkeleton {

    
    private function __construct() {}
    private static function getDB() {
        return new PDO(DB_DSN, DB_USER, DB_PASS);
    }

   
    
    
    public static function create($faqModel) {
      $db = self::getDB();
      $stmt = $db->prepare("INSERT INTO faqs (question, answer) VALUES (?, ?)");
      $success = $stmt->execute([
        $faqModel->getQuestion(),
        $faqModel->getAnswer()
      ]);
      
      if($success) $faqModel->setId($db->lastInsertId());
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
            $faq = new FaqModel();
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
        $faqRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $faqs = [];
        foreach ($faqRows as $row) {
            $faqs[] = new Faq(
                $row['id'],
                $row['question'],
                $row['answer']
            );
        }
        return $faqs;
    }

    // Getters and Setters
    public function getId() { return $this->id; }
    public function getQuestion() { return $this->question; }
    public function setQuestion($question) { $this->question = $question; }
    public function getAnswer() { return $this->answer; }
    public function setAnswer($answer) { $this->answer = $answer; }
}
