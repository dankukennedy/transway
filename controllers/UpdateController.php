<?php class UpdateController
{
   public function __construct()
   {
    $db = new DatabaseConnection;
    $this->conn = $db->conn;
   }

   public function editApplicant($id)
   {
    $user_id = validateInput($this->conn,$id);
    $userQuery = "SELECT * FROM applicant WHERE id='$user_id' LIMIT 1";
    $result = $this->conn->query( $userQuery);
    if( $result->num_rows == 1)
     {  $data = $result->fetch_assoc();
        return $data;

     } else{
         return false;
      }

   }

   public function editStaff($id)
   {
    $staff_id = validateInput($this->conn,$id);
    $userQuery = "SELECT * FROM staff WHERE id='$staff_id' LIMIT 1";
    $result = $this->conn->query( $userQuery);
    if( $result->num_rows == 1)
     {  $data = $result->fetch_assoc();
        return $data;

     } else{
         return false;
      }

   }

   public function updateApplicant($studentId,$number,$email,$id)
   {
     $user_id=validateInput($this->conn,$id);
     $studentId= validateInput($this->conn,$_POST['studentId']);
     $number= validateInput($this->conn,$_POST['number']); 
     $email= validateInput($this->conn,$_POST['email']); 

    $userUpdateQuery=" UPDATE applicant SET number='$number',email='$email',studentId='$studentId'  WHERE id='$user_id' LIMIT 1";
    $result=$this->conn->query($userUpdateQuery);
    if($result)
     { 
      return true;
     } else 
      { 
       return false;
     }

   }

   public function updateStaff($staffId,$pin,$id)
   {
     $user_id = validateInput($this->conn,$id);
     $staffId = validateInput($this->conn,$_POST['staffId']); 
     $pin = validateInput($this->conn,$_POST['$pin']); 

    $userUpdateQuery=" UPDATE staff SET staffId ='$staffId',pin ='$pin'  WHERE id ='$user_id' LIMIT 1";
    $result=$this->conn->query($userUpdateQuery);
    if($result)
     { 
      return true;
     } else 
      { 
       return false;
     }

   }


}
 
?>