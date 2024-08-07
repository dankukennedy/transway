<?php
// class for registeration
class RegisterController{

    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    //register new staff
    public function staffRegistration($staffId,$pin)
    {
        $register_query="INSERT INTO staff (staffId,pin) VALUES('$staffId','$pin')";
        $result = $this->conn->query($register_query);
        return $result;
    }

    //register new Applicant
    public function applicantRegistration($studentId,$email,$password,$number)
    {
        $register_query="INSERT INTO applicants(studentId,email,password,number) VALUES('$studentId','$email','$password','$number')";
        $result = $this->conn->query($register_query);
        return $result;
    }

    //Checking where both password matches.
    public function confirmPassword($password,$repassword)
    {
    if($password == $repassword)
    {
        return true;
      }else {
        return false;
      }
    }

    //checking password not less than 6
    public function passwordLenght($password)
    {
        if(strlen($password) < 6)
        {
            return false;
        }  else
         {
            return true;
         }
    }

    //check if password is Empty and the length;
    public function isPasswordLenght($password)
    {
        if(!empty($password))
        {
            if(strlen($password) > 6)
            {
                return true;
            }else{
                return false;
            }
        } else{
            return false;
          }
    }

    //check if pin is Empty;
    public function isPinLenght($pin)
    {
        if(!empty($pin))
        {
            if(strlen($pin) > 6)
            {
                return true;
            }else{
                return false;
            }
        }  else{
            return false;
          }
    }

    //check if staffId is Empty;
    public function isStaffIdLenght($staffId)
    {
        if(!empty($staffId))
        {
            if(strlen($staffId) > 6)
            {
                return true;
            }else{
                return false;
            }
        }  else{
            return false;
          }
    }

    //Check if Email fieldis empty
    public function IsEmailEmpty($email)
    {
        if(!empty($email))
          {
            return true;
          }
            else
            {
            return false;
           }
    }

    //Check if number field is empty
    public function isEmptyNumber($number)
    {
        if(!empty($number))
        {
            return true;
        }else
        {
            return false;
        }
    }

    //Setting contact format.
    public function phoneNumberFormat($number)
    {
        //Allow only Digits,Remove all other characters.
        $number = preg_replace("/[^\d]/","",$number);
        //get the lenght
        $lenght_of_number = strlen($number);
        //if contact;
    if($lenght_of_number == 10)
      {
        return true;
      }
        else {
          return false;
        }
    }

    //Student Number format.
    public function studentIdNoFormat($studentId)
    {
        //Allow only Digits,Remove all other characters.
        $studentId = preg_replace("/[^\d]/","",$studentId);
        //get the lenght
        $lenght_of_studentId=strlen($studentId);
        //if student number is equal to 10;
    if($lenght_of_studentId == 10)
      {
        return true;
      }
        else {
          return false;
        }
    }

    //Checking whether Email exist
    public function isEmailValid($email)
    {   //validating email using validate function
        if(filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            return true;
        } else
        {
            return false;
        }

    }

    //checking Whether contact entered existed
    public function isNumberExist($number)
    {
        $checkUserNumber="SELECT number FROM applicant WHERE number='$number' LIMIT 1";
        $result=$this->conn->query($checkUserNumber);
        if($result->num_rows > 0)
        {
          return true;
        } else{
           return false;
          }
    }

    //Check whether Email Existed
    public function checkEmail($email){
        $checkUserEmail="SELECT email FROM applicant WHERE email='$email' LIMIT 1";
        $result=$this->conn->query($checkUserEmail);
        if($result->num_rows >0){
            return false;
        } else{
            return true;
        }
    }

    //Check whether pin Existed
    public function checkPin($pin){
        $checkStaffPin = "SELECT pin FROM staff WHERE pin ='$pin' LIMIT 1";
        $result=$this->conn->query($checkStaffPin);
        if($result->num_rows >0){
            return false;
        } else{
            return true;
        }
    }
    //Check whether staffId Existed
    public function checkStaffId($staffId){
        $checkStaffId = "SELECT staffId FROM staff WHERE staffId ='$staffId' LIMIT 1";
        $result=$this->conn->query($checkStaffId);
        if($result->num_rows >0){
            return false;
        } else{
            return true;
        }
    }


}

?>