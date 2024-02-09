<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/config/database.php');
class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createUser($username, $email, $password) {
        // Prepare and execute SQL statement to insert data into the database
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
        $stmt->close();
    }

    public function authenticate($email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?;");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        // $stmt->bind_result($id, $name, $db_email, $db_hashed_password);
        // $stmt->fetch();
        // $stmt->close();
        $result = $stmt->get_result(); // get the mysqli result
        $user = $result->fetch_assoc(); 
        print_r($user);
        echo $hash;
        echo(password_verify("Kartik@123", '$2y$10$ACB09MQMFjszA/NQcTG4s.z0jjnyjDYPmYJb8bfj42svCNvPEZ6si'));
        // if($user && password_verify($pass, $db_hashed_password)){
        //      echo "hello";
        // }else{
        //      echo "bye";
        // }
    }
}

$userm = new UserModel($conn);

$userm->authenticate("kartikaaryan@gmail.com", "Kartik@123");
?>
