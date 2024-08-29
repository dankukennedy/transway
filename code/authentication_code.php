<?php
include_once('../controllers/RegisterController.php');
include_once('../controllers/loginController.php');
include_once('../controllers/changePasswordController.php');
include_once('../controllers/UpdateController.php');
include_once('../controllers/TransRequest.php');


$auth = new loginController;




//Registering 

if(isset($_POST['applicant']))
{
    $email = trim(validateInput($db->conn, $_POST['email']));
    $number = trim(validateInput($db->conn, $_POST['number']));
    $studentId = trim(validateInput($db->conn, $_POST['studentId']));
    $password = trim(validateInput($db->conn, $_POST['password']));
    $repassword = trim(validateInput($db->conn, $_POST['repassword']));

    $register=new RegisterController;
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
                                                                 $password = $passwordHash;
                                                                 $registration_query = $register->applicantRegister($studentId,$email,$password,$number);
                                                                if($registration_query)
                                                                {
                                                                   redirect("<h3 style='color: green;'><script>alert('Successfully Registered Welcome !!!')</script>Successfully Registered Welcome !!!</h3>","index.php");
                                                                }
                                                             else{
                                                                    redirect("<h3 style='color: red;'><script>alert('Something went wrong cannot register!!!')</script>Something went wrong cannot register!!!</h3>","signup.php");
                                                                 }
                                                            }
                                                             else{
                                                                 redirect("<h3 style='color: red;'><script>alert('Password security Reasons!!!')</script>Password security Reasons!!!</h3>","signup.php");
                                                               }
                                                      }
                                                      else{
                                                             redirect("<h3 style='color: red;'><script>alert('Password entered must be more than 6 Characters !!!')</script>Password entered must be more than 6 Characters !!!</h3>","signup.php");
                                                          }
                                             }
                                             else{
                                                  redirect("<h3 style='color: red;'><script>alert('Check your email !!!Email Not Valid !!!')</script>Check your email !!!Email Not Valid !!!</h3>","signup.php");
                                                 }
                                          }
                                           else{
                                              redirect("<h3 style='color: red;'><script>alert('Student ID cannot be Empty or Less than 10 Digits!!!')</script>Student ID cannot be Empty or Less than 10 Digits!!!</h3>","signup.php");
                                            }
                                      }
                                       else{
                                              redirect("<h3 style='color: red;'> <script>alert('Number must be at least 10 digits!!!')</script>Number must be at least 10 digits!!!</h3>","signup.php");
                                           }

                                }
                                 else{
                                         redirect("<h3 style='color: red;'><script>alert('Number already Existed !!!')</script> Number already Existed !!!</h3>","signup.php");
                                     }
                            }
                             else{
                                     redirect("<h3 style='color: red;'> <script>alert('Number Field cannot be Empty !!')</script>Number Field cannot be Empty !!!</h3>","signup.php");
                                 }
                 }
                else{
                    redirect("<h3 style='color: red;'><script>alert('Email already Existed !!!')</script>Email already Existed !!!</h3>","signup.php");
                  }
          }
          else {
             redirect("<h3 style='color: red;'><script>alert('Email Fields cannot be left empty !!!')</script>Email Fields cannot be left empty !!!</h3>","signup.php");
            }
      }
      else
         {
           redirect("<h3 style='color: red;'><script>alert('Password and Re-type Password didn't match!!!')</script>Password and Re-type Password didn't match!!!</h3>","signup.php");
         }
}

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
      redirect(" <h3 style='color: green';><script>alert('Profile Update  Successfully')</script>  Profile Update  Successfully </h3>","settings.php");
      }
        else
        {
          redirect(" <h3 style='color: red';><script>alert('Profile Update  fails')</script>  Profile Update  fails </h3>","editProfile.php");
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
      redirect(" <h3 style='color: green';><script>alert(' Profile Update  Successfully ')</script>  Profile Update  Successfully </h3>","settings.php");
     }
        else
        {
          redirect(" <h3 style='color: red';><script>alert('Profile Update  fails')</script>  Profile Update  fails </h3>","editProfile.php");
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
                                    redirect(" <h3 style='color: green';><script>alert('Password change successfully !!!')</script>  Password change successfully !!! </h3>","settings.php");                                                            
                                  }
                                  else
                                     {
                                      redirect(" <h3 style='color: red';><script>alert(' attempt to change New Password fails !!!')</script>  attempt to change New Password fails !!!  </h3>","changePassword.php");                 
                                      }
                          }
                           else
                           {
                            redirect(" <h3 style='color: red';><script>alert(' New Password security fails !!!')</script>  New Password security fails !!!  </h3>","changePassword.php");
                           }
                  }
                  else{
                       redirect(" <h3 style='color:  red';><script>alert(' New Password and Repeat password does not Match up !!!')</script>  New Password and Repeat password does not Match up !!!  </h3>","changePassword.php");
                     }

              }
              else{
                   redirect(" <h3 style='color:  red';><script>alert(' Enter password  mix with numbers,special characters,uppercases,lowercases !!  ')</script>  Enter password  mix with numbers,special characters,uppercases,lowercases !!  </h3>","changePassword.php");
                 }

        }
         else
          {
            redirect(" <h3 style='color: red';><script>alert(' Enter password up to 8 characters or more !!')</script>  Enter password up to 8 characters or more !!! </h3>","changePassword.php");
          }

    }
     else
     {
        redirect(" <h3 style='color: red';><script>alert(' Password entered does not match with Current Password !!!')</script>  Password entered does not match with Current Password !!!  </h3>","changePassword.php");
     }



}


//Logout Applicant
if(isset($_POST['logout'])){
    $checkLoggedOut = $auth->logout();
    if($checkLoggedOut){
      redirect(" <h3 style='color: green';><script>alert(' Logged out Successfully !!!')</script>  Logged out Successfully !!! </h3>","index.php");
    }

  }

  //Logout Staff
if(isset($_POST['logoutStaff'])){
    $checkLoggedOut = $auth->logoutStaff();
    if($checkLoggedOut){
      redirect(" <h3 style='color: green';><script>alert('Logged out Successfully !!! ')</script>  Logged out Successfully !!! </h3>","admin/index.php");
    }
  }

// Login Applicant
if(isset($_POST['login']))
{
  $email=trim(validateInput($db->conn, $_POST['email']));
  $password=trim(validateInput($db->conn, $_POST['password']));
  $checkLogin=$auth->applicantLogin($email,$password);
    if($checkLogin)
   {
      redirect(" <h3 style='color: green';><script>alert('Logged in Successfully !!!')</script>  Logged in Successfully !!!</h3>","student\dashboard.php");
   }    else
     {
      $checkAccount = $auth->applicantAccount($email);
      if ($checkAccount){
             redirect("<h3 style='color: red';><script>alert(' Please You dont Have an Account Create one !!!')</script> Please You dont Have an Account Create one !!!</h3>","index.php");
         }
        else{
           redirect("<h3 style='color: red';><script>alert(' Invalid Email or Password !!!')</script>  Invalid Email or Password !!!</h3>","index.php");

        }
      }

}

//Login Staff
if(isset($_POST['login_staff']))
{
  $staffUserId = trim(validateInput($db->conn, $_POST['staffUserId']));
  $pin = trim(validateInput($db->conn, $_POST['pin']));
  $checkLogin = $auth->staffLogin($staffUserId,$pin);
    if($checkLogin)
   {
      redirect(" <h3 style='color: green';><script>alert('Logged in Successfully !!!')</script> Logged in Successfully !!!</h3>","admin/dashboard.php");
   }    else
     {
      $checkAccount = $auth->staffAccount($staffUserId);
      if ($checkAccount){
             redirect("<h3 style='color: red';><script>alert(' Please You dont Have an Account Create one !!!')</script> Please You dont Have an Account Create one !!!</h3>","admin/index.php");
         }
        else{
           redirect("<h3 style='color: red';><script>alert('Invalid Staff ID or Pin !!!')</script>Invalid Staff ID or Pin !!!</h3>","admin/index.php");

        }
      }

}

if(isset($_POST['trans'])){
  $tNumber = trim(validateInput($db->conn, $_POST['tNumber']));
  $studentUserId= trim(validateInput($db->conn, $_POST['studentUserId']));
  $contact = trim(validateInput($db->conn, $_POST['contact']));
  $email = trim(validateInput($db->conn, $_POST['email']));
  $programme = trim(validateInput($db->conn, $_POST['programme']));
  $graduationYear = trim(validateInput($db->conn, $_POST['graduationYear']));

  $transcript = new TransRequest;
  $result= $transcript->reqTranscript($studentUserId,$tNumber,$email,$contact,$programme,$graduationYear);
  if($result){
    redirect(" <h3 style='color: green';><script>alert('Transcript Requested  Successfully')</script> Transcript Requested  Successfully </h3>","student/dashboard.php");
  } else{
  redirect(" <h3 style='color: green';><script>alert('Transcript Requested  Failed')</script> Transcript Requested  Failed </h3>","student/review.php");
   }
}

//Registering Staff
if(isset($_POST['register_staff']))
 {
     $staffUserId = validateInput($db->conn, $_POST['staffUserId']);
     $pin= validateInput($db->conn, $_POST['pin']);

     $register = new RegisterController;
     $checkStaffLenghEmpty = $register->isStaffIdLenght($staffUserId);
     if($checkStaffLenghEmpty)
    {
          $checkStaffIdExist = $register->checkStaffId($staffUserId);
          if($checkStaffIdExist)
          {
            $checkPinEmpty = $register->isPinLenght($pin);
            if($checkPinEmpty)
             {
               $checkPinExist = $register->checkPin($pin);
               if($checkPinExist)
                {
                  $registration_query=$register->staffRegistration($staffUserId,$pin);
                  if($registration_query)
                     {
                        redirect("<h3 style='color: green;'><script>alert('Successfully Registered Welcome !!!')</script>Successfully Registered Welcome !!!</h3>","admin/index.php");
                     }
                   else {
                           redirect("<h3 style='color: red;'><script>alert('Something went wrong cannot register staff !!!')</script> Something went wrong cannot register staff !!!</h3>","register.php");
                        }
                }
                else {
                       redirect("<h3 style='color: red;'><script>alert('Pin already exist!!!')</script> Pin already exist!!!</h3>","register.php");
                     }
             }
            else {
                    redirect("<h3 style='color: red;'><script>alert(' Pin cannot be empty or cannot be less than 6 characters!!!')</script> Pin cannot be empty or cannot be less than 6 characters!!!</h3>","register.php");
                 }
         }
         else{
               redirect("<h3 style='color: red;'><script>alert('Staff ID  exist already!!!')</script> Staff ID  exist already!!!</h3>","register.php");
             }
      }
      else{
           redirect("<h3 style='color: red;'><script>alert(' Staff ID cannot be left empty or Staff ID must be more than 6 characters!!!')</script> Staff ID cannot be left empty or Staff ID must be more than 6 characters!!!</h3>","register.php");
         }

   }




   


?>


