<?php
class changePasswordController
{
 public function __construct()
 {
    $db=new DatabaseConnection;
    $this->conn=$db->conn;
 }

//Checking where both password matches.
public function confirmPassword($newPassword,$rePasswaord)
{
  if($newPassword == $rePasswaord){
    return true;
  }else {
   // new password and repeat password must tally or be the same
    return false;
  }
}

 //checking password lenght
  public function passwordLenght($newPassword)
  {
   if(!strlen($newPassword < 8))
   {
      return true;
   }  else
    {
      // new password must at least 8characters
      return false;
    }

  }
// checking password strenght
  public function newPasswordSecurity($newPassword)
  {
    $uppercase=preg_match('@[A-Z]@',$newPassword);
    $lowercase=preg_match('@[a-z]@',$newPassword);
    $number=preg_match('@[0-9]@',$newPassword);
    $specialcharacter=preg_match('@[^\w]@',$newPassword);
    if(!$uppercase||!$lowercase||!$number||! $specialcharacter)
        {
          return false;
        }
        else
        {// new password must be mixed with at least one uppercace,lowercase,numbers and special character 
          return true;
        }
   }

  public function checkPassword($id,$password)
   {
      $user_id=validateInput($this->conn,$id);
      $password=validateInput($this->conn,$_POST['currentPassword']);
      $changePasswordQry="SELECT * FROM applicant WHERE id='$user_id' LIMIT 1";
      $result=$this->conn->query($changePasswordQry);
      if($result->num_rows ==1)
      {
        if($data=$result->fetch_assoc())
        {
            $hash_pass=password_verify($password,$data['password']);
          if($hash_pass==false)
          {
              return false;
          }
            elseif($hash_pass)
              {
              return true;
            }
        }
        else
        {
          return false;
        }
      }    else
        {
          return false;
        }
   }

     public function changePassword($newPassword,$id)
     {
      $user_id=validateInput($this->conn,$id);
      //$newPassword=validateInput($this->conn,$_POST['newPassword']);
      $changePasswordQuery="UPDATE applicant SET password='$newPassword' WHERE id='$user_id' LIMIT 1";
      $result=$this->conn->query($changePasswordQuery);

      return $result;
     }

}

?>