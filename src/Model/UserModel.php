<?php
class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createUser($name, $email, $password) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            return false;
        }else{
            $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $password);
            $stmt->execute();
            $stmt->close();
            return true;
        }
    }

    public function authenticate($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?;");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $name, $db_email, $db_hashed_password);
        $stmt->fetch();
        $stmt->close();
        if($db_email && password_verify($password, $db_hashed_password)){
            return true;
        }else{
            return false;
        }
    }

    public function getUserName($email) {
        $stmt = $this->conn->prepare("SELECT name FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($username);
        $stmt->fetch();
        $stmt->close();

        return $username; 
    }

    public function getUserId($email) {
        $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();

        return $user_id; 
    }

    public function deleteUser($email) {
        $sql = "DELETE FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        return $stmt->execute();
    }
}
?>
