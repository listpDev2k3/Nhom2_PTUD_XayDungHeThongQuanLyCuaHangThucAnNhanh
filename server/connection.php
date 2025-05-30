<?php
class Database {
    private $host = "localhost";
    private $username = "fastfood";
    private $password = "123";
    private $database = "demo"; // Tên database của bạn
    public $conn;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

    public function close() {
        $this->conn->close();
    }
}
?>


