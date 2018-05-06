<?php

class DbHandler {

    private $conn;

    function __construct() {
        require_once 'DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }


  public function createOtp($number, $otp) {

        // delete the old otp if exists
        $stmt = $this->conn->prepare("DELETE FROM sms_codes where mobile = ?");
        $stmt->bind_param("i", $number);
        $stmt->execute();


        $stmt = $this->conn->prepare("INSERT INTO sms_codes(mobile, code) values(?, ?)");
        $stmt->bind_param("is", $number, $otp);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }
    
    public function activateUser($otp,$number) {
        $stmt = $this->conn->prepare("SELECT u.id, u.mobile,u.created_at FROM sms_codes u WHERE u.code = ? and u.mobile = ?");
        $stmt->bind_param("ss", $otp,$number);

        if ($stmt->execute()) {
            // $user = $stmt->get_result()->fetch_assoc();
            $stmt->bind_result($id, $mobile, $created_at);
            
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                
                $stmt->fetch();
                
                $user = array();
                $user["mobile"] = $mobile;
                $user["created_at"] = $created_at;
                
                $stmt->close();
                
                return $user;
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }

        return $result;
    }
    
    
   
}
?>
