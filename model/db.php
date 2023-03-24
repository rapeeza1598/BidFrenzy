<?php
class Db {
  protected $db = null;

  const DB_HOST = 'localhost';
  const DB_NAME = 'bidfrenzy';
  const DB_USER = 'root';
  const DB_PASS = '';

  public function __construct() {
    $this->connect();
  }

  private function connect() {
    try {
      $this->db = new PDO("mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME.";charset=utf8", self::DB_USER, self::DB_PASS);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}

// $db = new Db();
// echo "<script>console.log('db.php')</script>";
