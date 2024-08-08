<?php 
include_once('controllers/RegisterController.php');
include_once('.controllers/loginController.php');
include_once('controllers/changePasswordController.php');
include_once('controllers/UpdateController.php');

$auth = new loginController;


//updating Applicant records
if(isset($_POST['updateProfile']))
{
    $id = validateInput($db->conn, $_POST['user_id']);
    $number = validateInput($db->conn, $_POST['number']);
    $studentId = validateInput($db->conn, $_POST['studentId']);
    $email = validateInput($db->conn, $_POST['email']);
    $userUpdateDetails = new UpdateController;

     $result = $userUpdateDetails->updateApplicant($number,$email,$studentId,$id);
     if($result)
     {
      redirect(" <h5 style='color: green';> Profile Update  Successfully </h5>","settings.php");
      }
        else
        {
          redirect(" <h5 style='color: red';> Profile Update  fails </h5>","editProfile.php");
        }

  }

//Updating staff record
if(isset($_POST['updateStaffProfile']))
{
    $id = validateInput($db->conn, $_POST['user_id']);
    $staffId = validateInput($db->conn, $_POST['staffId']);
    $pin = validateInput($db->conn, $_POST['pin']);

    $staffUpdateDetails = new UpdateController;
     $result = $staffUpdateDetails->updateStaff($staffId,$pin,$id);
     if($result)
     {
      redirect(" <h5 style='color: green';> Profile Update  Successfully </h5>","settings.php");
     }
        else
        {
          redirect(" <h5 style='color: red';> Profile Update  fails </h5>","editProfile.php");
        }

}


//Reset Password Applicant
if(isset($_POST['resetPassword']))
{
  $id = validateInput($db->conn, $_POST['applicant_id']);
  $newPassword = validateInput($db->conn,$_POST['newPassword']);
  $rePassword = validateInput($db->conn,$_POST['rePassword']);
  $userChangePass = new changePasswordController;
  $result_checkPassword = $userChangePass->checkPassword($id,$newPassword);
  if($result_checkPassword)
   {
     $result_passwordLenght = $userChangePass->passwordLenght($newPassword);
     if( $result_passwordLenght)
       {
          $result_newPassSecurity = $userChangePass->newPasswordSecurity($newPassword);
          if( $result_newPassSecurity)
             {
                $result_comparePass = $userChangePass->confirmPassword($newPassword,$rePassword);
                 if($result_comparePass)
                  {
                    $password_hash=password_hash($newPassword,PASSWORD_DEFAULT);
                       if( $password_hash)
                         {
                             $password=$password_hash;
                             $changePasswordqry=$userChangePass->changePassword($password,$id);
                              if( $changePasswordqry)
                                  {
                                    redirect(" <h5 style='color: green';> Password change successfully !!! </h5>","settings.php");                                                            
                                  }
                                  else
                                     {
                                      redirect(" <h5 style='color: orange';> attempt to change New Password fails !!!  </h5>","changePassword.php");                 
                                      }
                          }
                           else
                           {
                            redirect(" <h5 style='color: orange';> New Password security fails !!!  </h5>","changePassword.php");
                           }
                  }
                  else{
                       redirect(" <h5 style='color:  orange';> New Password and Repeat password does not Match up !!!  </h5>","changePassword.php");
                     }

              }
              else{
                   redirect(" <h5 style='color:  orange';> Enter password  mix with numbers,special characters,uppercases,lowercases !!  </h5>","changePassword.php");
                 }

        }
         else
          {
            redirect(" <h5 style='color: orange';> Enter password up to 8 characters or more !!! </h5>","changePassword.php");
          }

    }
     else
     {
        redirect(" <h5 style='color: orange';> Password entered does not match with Current Password !!!  </h5>","changePassword.php");
     }



}


//Logout Applicant
if(isset($_POST['logout'])){
    $checkLoggedOut = $auth->logout();
    if($checkLoggedOut){
      redirect(" <h5 style='color: green';> Logged out Successfully !!! </h5>","index.php");
    }

  }

  //Logout Staff
if(isset($_POST['logoutStaff'])){
    $checkLoggedOut = $auth->logoutStaff();
    if($checkLoggedOut){
      redirect(" <h5 style='color: green';> Logged out Successfully !!! </h5>","admin/index.php");
    }
  }

// Login Applicant
if(isset($_POST['login']))
{
  $email=validateInput($db->conn, $_POST['email']);
  $password=validateInput($db->conn, $_POST['password']);
  $checkLogin=$auth->applicantLogin($email,$password);
    if($checkLogin)
   {
      redirect(" <h5 style='color: green';> Logged in Successfully !!!</h5>","dashboard.php");
   }    else
     {
      $checkAccount = $auth->applicantAccount($email);
      if ($checkAccount){
             redirect("<h5 style='color: orange';>Please You dont Have an Account Create one !!!</h5>","login.php");
         }
        else{
           redirect("<h5 style='color: orange';> Invalid Email or Password !!!</h5>","index.php");

        }
      }

}

//Login Staff
if(isset($_POST['login_staff']))
{
  $staffId = validateInput($db->conn, $_POST['staffId']);
  $pin = validateInput($db->conn, $_POST['$pin']);
  $checkLogin = $auth->staffLogin ($staffId,$pin);
    if($checkLogin)
   {
      redirect(" <h5 style='color: green';> Logged in Successfully !!!</h5>","admin/dashboard.php");
   }    else
     {
      $checkAccount=$auth->staffAccount($staffId);
      if ($checkAccount){
             redirect("<h5 style='color: orange';>Please You dont Have an Account Create one !!!</h5>","admin/index.php");
         }
        else{
           redirect("<h5 style='color: orange';> Invalid Email or Password !!!</h5>","admin/index.php");

        }
      }

}



//Registering Applicant
if(isset($_POST['signup']))
{
    $email = validateInput($db->conn, $_POST['email']);
    $number = validateInput($db->conn, $_POST['number']);
    $studentId = validateInput($db->conn, $_POST['studentId']);
    $password = validateInput($db->conn, $_POST['password']);
    $repassword = validateInput($db->conn, $_POST['repassword']);

    $register = new RegisterController;
    $checkConfirmPassword = $register->confirmPassword($password,$repassword);
    if($checkConfirmPassword)
     {
        $emailEmpty=$register->IsEmailEmpty($email);
       if($emailEmpty)
         {
            $checkEmailExist=$register->checkEmail($email);
            if($checkEmailExist)
                 {
                      $numberEmpty=$register->isEmptyNumber($number);
                           if($numberEmpty)
                            {
                                $checkNumber=$register->isNumberExist($number);
                                if(!$checkNumber)
                                {
                                  $checkNumberFormat=$register->phoneNumberFormat($number);
                                    if($checkNumberFormat)
                                     {
                                       $checkStudentId = $register ->studentIdNoFormat($studentId);
                                         if($checkStudentId)
                                          {
                                           $emailValidate=$register->isEmailValid($email);
                                           if($emailValidate)
                                           {
                                             $passwordLenght=$register->isPasswordLenght($password);
                                                 if($passwordLenght)
                                                     {
                                                        $passwordHash = password_hash($password,PASSWORD_DEFAULT);
                                                          if($passwordHash)
                                                           {
                                                                 $password=$passwordHash;
                                                                 $registration_query=$register->applicantRegistration($email,$studentId,$number,$password,);
                                                                if($registration_query)
                                                                {
                                                                   redirect("<h4 style='color: green;'>Successfully Registered Welcome !!!</h4>","login.php");
                                                                }
                                                             else{
                                                                    redirect("<h4 style='color: orange;'>Something went wrong cannot register!!!</h4>","register.php");
                                                                 }
                                                            }
                                                             else{
                                                                 redirect("<h4 style='color: orange;'>Password security Reasons!!!</h4>","register.php");
                                                               }
                                                      }
                                                      else{
                                                             redirect("<h4 style='color: orange;'>Password entered must be more than 6 Characters !!!</h4>","register.php");
                                                          }
                                             }
                                             else{
                                                  redirect("<h4 style='color: orange;'>Check your email !!!Email Not Valid !!!</h4>","register.php");
                                                 }
                                          }
                                           else{
                                              redirect("<h4 style='color: orange;'>Student ID cannot be Empty or Less than 10 Digits!!!</h4>","register.php");
                                            }
                                      }
                                       else{
                                              redirect("<h4 style='color: orange;'> Number must be at least 10 digits!!!</h4>","register.php");
                                           }

                                }
                                 else{
                                         redirect("<h4 style='color: orange;'> Number already Existed !!!</h4>","register.php");
                                     }
                            }
                             else{
                                     redirect("<h4 style='color: orange;'> Number Field cannot be Empty !!!</h4>","register.php");
                                 }
                 }
                else{
                    redirect("<h4 style='color: orange;'>Email already Existed !!!</h4>","register.php");
                  }
          }
          else {
             redirect("<h4 style='color: orange;'>Email Fields cannot be left empty !!!</h4>","register.php");
            }
      }
      else
         {
           redirect("<h4 style='color: orange;'>Password and Re-type Password didn't match!!!</h4>","register.php");
         }
}




//Registering Staff
if(isset($_POST['register_staff']))
 {
     $staffId = validateInput($db->conn, $_POST['staffId']);
     $pin= validateInput($db->conn, $_POST['pin']);

     $register = new RegisterController;
     $checkStaffLenghEmpty = $register->isStaffIdLenght($staffId);
     if($checkStaffLenghEmpty)
    {
          $checkStaffIdExist = $register->checkStaffId($staffId);
          if($checkStaffIdExist)
          {
            $checkPinEmpty = $register->isPinLenght($pin);
            if($checkPinEmpty)
             {
               $checkPinExist = $register->checkPin($pin);
               if($checkPinExist)
                {
                  $registration_query=$register->staffRegistration($staffId,$pin);
                  if($registration_query)
                     {
                        redirect("<h4 style='color: green;'>Successfully Registered Welcome !!!</h4>","admin/index.php");
                     }
                   else {
                           redirect("<h4 style='color: orange;'> Something went wrong cannot register staff !!!</h4>","register.php");
                        }
                }
                else {
                       redirect("<h4 style='color: orange;'> Pin already exist!!!</h4>","register.php");
                     }
             }
            else {
                    redirect("<h4 style='color: orange;'> Pin cannot be empty or cannot be less than 6 characters!!!</h4>","register.php");
                 }
         }
         else{
               redirect("<h4 style='color: orange;'> Staff ID  exist already!!!</h4>","register.php");
             }
      }
      else{
           redirect("<h4 style='color: orange;'> Staff ID cannot be left empty or Staff ID must be more than 6 characters!!!</h4>","register.php");
         }

   }


?>