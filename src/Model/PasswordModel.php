<?php

class PasswordModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createPassword($user_id, $application_name, $app_userID, $password, $category, $security_question = null, $security_answer = null, $two_factor_info = null) {
        $sql = "INSERT INTO passwords (user_id, application_name, app_user_id, password, category, security_question, security_answer, twofa_info) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssssss", $user_id, $application_name, $app_userID, $password, $category, $security_question, $security_answer, $two_factor_info);
        return $stmt->execute();
    }

    public function getPasswordsByUserId($user_id) {
        $sql = "SELECT * FROM passwords WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $passwords = array();
        while ($row = $result->fetch_assoc()) {
            $passwords[] = $row;
        }
        return $passwords;
    }

    public function get_password_id($password){
        $sql = "SELECT password_id FROM passwords WHERE password=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $password);
        $stmt->execute();
        $stmt->bind_result($password_id);
        $stmt->fetch();
        $stmt->close();

        return $password_id; 
    }

    public function deletePassword($password_id) {
        $sql = "DELETE FROM passwords WHERE password_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $password_id);
        return $stmt->execute();
    }
}


// $passwordModel = new Password($conn);
// $passwordModel->createPassword($user_id, $title, $password, $two_factor_info, $security_question, $security_answer, $category);
// $passwords = $passwordModel->getPasswordsByUserId($user_id);
// foreach ($passwords as $password) {
//     // Process each password
// }

?>
