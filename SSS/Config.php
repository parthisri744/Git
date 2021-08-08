<?php
ini_set("display_errors",1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
class config {
private $conn;
private $dsn = 'mysql:dbname=SSS;host=localhost';
private $user = 'root';
private $password = '';
public function dbconnect() {
    try {
        $this->conn = new PDO($this->dsn, $this->user, $this->password);
        echo "Connected Successfully";
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "";
        die();
    }
    return $this->conn;
}
}
?>