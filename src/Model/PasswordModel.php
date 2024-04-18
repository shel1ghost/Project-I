<?php

class PasswordModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createPassword($user_id, $application_name, $app_userID, $password, $category, $security_question = null, $security_answer = null, $two_factor_info = null) {
        date_default_timezone_set('Asia/Kathmandu');
        $created_at = date("Y-m-d H:i:s");
        $sql = "INSERT INTO passwords (user_id, application_name, app_user_id, password, category, security_question, security_answer, twofa_info, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issssssss", $user_id, $application_name, $app_userID, $password, $category, $security_question, $security_answer, $two_factor_info, $created_at);
        return $stmt->execute();
    }

    public function updatePassword($password_id, $application_name, $app_userID, $password, $category, $security_question = null, $security_answer = null, $two_factor_info = null) {
        date_default_timezone_set('Asia/Kathmandu');
        $created_at = date("Y-m-d H:i:s");
        $sql = "UPDATE passwords SET application_name=?, app_user_id=?, password=?, category=?, security_question=?, security_answer=?, twofa_info=?, created_at=? WHERE password_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $application_name, $app_userID, $password, $category, $security_question, $security_answer, $two_factor_info, $created_at, $password_id);
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

    public function deletePassword($password_id, $key_id) {
        $sql = "DELETE FROM passwords WHERE password_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $password_id);
        $stmt->execute();
        $stmt->close();
        $sql = "DELETE FROM password_keys WHERE key_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $key_id);
        $stmt->execute();
        $stmt->close();
    }
}

?>
