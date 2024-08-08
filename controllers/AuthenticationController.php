<?php
class AuthenticationController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
        $this->checkIsLoggedIn();

    }
    public function staff()
    {
       $staff_id = $_SESSION['auth_staff']['staff_id'];
       $checkStaff = "SELECT id, role_as FROM staffs WHERE id='$staff_id' AND role_as='1' LIMIT 1";
       $result=$this->conn->query($checkStaff);
       if($result->num_rows == 1)
        {
           return true;
        } else
         {
          redirect("<h4 style='color:red;'>You are not Authorized as Admin</h4>","login.php");
           return false;
         }
    }


    public function AuthUserDetail()
    {
        $checkAuth=$this->checkIsLoggedIn();
        if($checkAuth)
        {
          $applicant_id = $_SESSION['auth_applicant']['applicant_id'];
          $getUserData=" SELECT * FROM applicants WHERE id ='$applicant_id' LIMIT 1";
          $result=$this->conn->query($getUserData);
            if($result->num_rows > 0)
             {
                $data=$result->fetch_assoc();
                return $data;
             }
           else{
             redirect("<h4 style='color:red;'>Something Went wong </h4>","index.php");
            }
        } else{
            return false;
         }
    }

    public function AuthStaffDetail()
    {
        $checkAuth=$this->checkIsStaffLoggedIn();
        if($checkAuth)
        {
          $staff_id = $_SESSION['auth_staff']['staff_id'];
          $getUserData =" SELECT * FROM staff WHERE id ='$staff_id' LIMIT 1";
          $result = $this->conn->query($getUserData);
            if($result->num_rows > 0)
             {
                $data=$result->fetch_assoc();
                return $data;
             }
           else{
             redirect("<h4 style='color:red;'>Something Went wong </h4>","index.php");
            }
        } else{
            return false;
         }
    }


    private function checkIsLoggedIn()
    {
       if(!isset($_SESSION['authenticated']))
       {
            redirect("<h4 style='color:red;' >Login to Access the page</h4>","index.php");
            return false;
       } else{
           return true;
         }

     }

    private function checkIsStaffLoggedIn()
    {
       if(!isset($_SESSION['authenticated']))
       {
            redirect("<h4 style='color:red;' >Login to Access the page</h4>","index.php");
            return false;
       } else{
           return true;
         }

     }



 }

 $authenticated=new AuthenticationController;

?>