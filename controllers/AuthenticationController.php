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
       $checkStaff = "SELECT * FROM staffs WHERE id='$staff_id'  LIMIT 1";
       $result=$this->conn->query($checkStaff);
       if($result->num_rows == 1)
        {
           return true;
        } else
         {
          redirect("<h3 style='color:red;'> <script>alert('You are not Authorized as Admin')</script>You are not Authorized as Admin</h3>","login.php");
           return false;
         }
    }


    public function AuthUserDetail()
    {
        $checkAuth=$this->checkIsLoggedIn();
        if($checkAuth)
        {
          $applicant_id = $_SESSION['auth_user']['user_id'];
          $getUserData=" SELECT * FROM applicants WHERE id ='$applicant_id' LIMIT 1";
          $result=$this->conn->query($getUserData);
            if($result->num_rows > 0)
             {
                $data=$result->fetch_assoc();
                return $data;
             }
           else{
             redirect("<h3 style='color:red;'><script>alert('Something Went wong')</script>Something Went wong </h3>","index.php");
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
          $getStaffData =" SELECT * FROM staff WHERE id ='$staff_id' LIMIT 1";
          $result = $this->conn->query($getStaffData);
            if($result->num_rows > 0)
             {
                $data=$result->fetch_assoc();
                return $data;
             }
           else{
             redirect("<h3 style='color:red;'><script>alert('Something Went wong ')</script>Something Went wong </h3>","index.php");
            }
        } else{
            return false;
         }
    }


    private function checkIsLoggedIn()
    {
       if(!isset($_SESSION['authenticated']))
       {
            redirect("<h3 style='color:red;' ><script>alert('Login to Access the page')</script>Login to Access the page</h3>","index.php");
            return false;
       } else{
           return true;
         }

     }

    private function checkIsStaffLoggedIn()
    {
       if(!isset($_SESSION['authenticated']))
       {
            redirect("<h3 style='color:red;' ><script>alert('Login to Access the page')</script>Login to Access the page</h3>","index.php");
            return false;
       } else{
           return true;
         }

     }



 }

 $authenticated = new AuthenticationController;

?>