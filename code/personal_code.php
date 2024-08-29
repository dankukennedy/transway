<?php
include('../config/app.php');
include('../controllers/PersonalController.php');

if(isset($_POST['personal'])){
    $inputData= [
    'studentUserId'=>validateInput($db->conn, $_POST['studentUserId']),
    'surename'=>validateInput($db->conn, $_POST['surename']),
    'othername'=>validateInput($db->conn, $_POST['othername']),
    'gender'=>validateInput($db->conn, $_POST['gender']),
    'dob'=>validateInput($db->conn, $_POST['dob']),
    'code'=>validateInput($db->conn, $_POST['code']),
    'country'=>validateInput($db->conn, $_POST['country']),
    'number'=>validateInput($db->conn, $_POST['number']),
    'address'=>validateInput($db->conn, $_POST['address']),
    'postAddress'=>validateInput($db->conn, $_POST['postAddress']),
    'profileImg'=>validateInput($db->conn, $_POST['profileImg']),
    ];

    $personal= new PersonalController;

    $checkPersonal = $personal->personalExist($inputData);
    if($checkPersonal){
        echo "<script> alert('Your data have been save already')</script>";
         $result = $personal-> update($inputData);
          if($result){
          redirect("<h4 style='color:green;font:200'><script>alert('Personal Details Updated Successfully')</script>Personal  Details Updated Successfully</h4>","student/identification.php");
        }
        else{
          redirect("<h4 style='color:red; font:200'><script>alert('Something Went Wrong Personal Not Updated')</script>Something Went Wrong Personal  Not Updated</h4>","student/personal-information.php");
        }
    }
   else{
     $result = $personal->createNewPersonal($inputData);
      if($result){
        redirect("<h4 style='color:green;font:200'><script>alert('Personal Details added Successfully')</script>Personal  Details added Successfully</h4>","student/identification.php");
      }
      else{
          redirect("<h4 style='color:red; font:200'><script>alert('Something Went Wrong Personal Not Created')</script>Something Went Wrong Personal  Not Created</h4>","student/personal-information.php");
       }
  }

}

