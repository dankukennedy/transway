
<?php
class loginController
{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->conn=$db->conn;
     }

        public function applicantAccount($email)
         {
              $checkLogin = "SELECT * FROM applicant WHERE email ='$email' LIMIT 1";
              $result = $this->conn->query($checkLogin);
                if($result->num_rows < 1)
                  {
                    return false;
                  }
       }

        public function staffAccount($staffId)
         {
              $checkLogin="SELECT * FROM staff WHERE staffId ='staffId' LIMIT 1";
              $result=$this->conn->query($checkLogin);
              if($result->num_rows < 1)
                 {
                    return false;
                 }
        }

    public function applicantLogin($email,$password){
      $userLogin="SELECT * FROM applicant WHERE email='$email' LIMIT 1";
      $result = $this->conn->query($userLogin);
      if($result->num_rows > 0){
        if($data = $result->fetch_assoc()){
          $hash_pass = password_verify($password,$data['password']);
          if($hash_pass == false){
            return false;
          }elseif($hash_pass){
            $this->applicantAuthentication($data);
            return true;
          }
        }
      }
       else {
           return false;
        }
    }

    public function staffLogin($staffId,$pin){
      $staffLogin="SELECT * FROM staff WHERE staffId ='$staffId' LIMIT 1";
      $result = $this->conn->query($staffLogin);
      if($result->num_rows > 0){
        if($data = $result->fetch_assoc()){
          $pin === $data['pin'];
          if( $pin == false){
            return false;
          }elseif( $pin){
            $this->staffAuthentication($data);
            return true;
          }
        }
      }
      else {
        return false;
      }
    }


    private function applicantAuthentication($data)
    {
        $_SESSION['authenticated'] = true;
        //$_SESSION['auth_role']= $data['role_as'];
        $_SESSION['auth_user']=[
        'user_id'=>$data['id'],
        'user_email'=>$data['email'],
        'user_studentId'=>$data['studentId'],
        'user_number'=>$data['number'],
        ];
    }

    private function staffAuthentication($data)
    {
        $_SESSION['authenticated'] = true;
        //$_SESSION['auth_role']= $data['role_as'];
        $_SESSION['auth_user']=[
        'staff_id'=>$data['staffId'],
        'staff_pin'=>$data['pin']
        ];
    }

      public function isLoggedIn(){
        if(isset($_SESSION['authenticated']) === TRUE){
         redirect("<h4 style='color:red;' >You are Already LoggedIn</h4>","dashboard.php");
        }
        else{
            return false;
        }
      }

      public function isLoggedInStaff(){
        if(isset($_SESSION['authenticated']) === TRUE){
         redirect("<h4 style='color:red;' >You are Already LoggedIn</h4>","dashboard.php");
        }
        else{
            return false;
        }
      }

      public function logout(){
        if(isset($_SESSION['authenticated'])===TRUE){
        unset($_SESSION['authenticated']);
        unset($_SESSION['auth_user']);
         return true;
        }
        else{
          return false;
        }
      }

      public function logoutStaff(){
        if(isset($_SESSION['authenticated'])===TRUE){
        unset($_SESSION['authenticated']);
        unset($_SESSION['auth_staff']);
         return true;
        }
        else{
          return false;
        }
      }

}


?>

