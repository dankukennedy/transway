<?php
include('../config/app.php');
include('../controllers/IdentificationController.php');

if(isset($_POST['identity'])){
    $inputData= [
    'studentUserId'=>validateInput($db->conn, $_POST['studentUserId']),
    'idCard'=>validateInput($db->conn, $_POST['idCard']),
    'idCardNumber'=>validateInput($db->conn, $_POST['idCardNumber']),
    'IdCardImage'=>validateInput($db->conn, $_POST['IdCardImage']),
    ];

    $identity = new IdentificationController;




$checkIdentity = $identity->identityExist($inputData);
if($checkIdentity){
    echo "<script> alert('Your data have been save already')</script>";
     $result = $identity-> update($inputData);
      if($result){
      redirect("<h4 style='color:green;font:200'><script>alert('Identification Details Updated Successfully')</script>Identification  Details Updated Successfully</h4>","student/programmes.php");
    }
    else{
      redirect("<h4 style='color:red; font:200'><script>alert('Something Went Wrong Identification Not Updated')</script>Something Went Wrong Identification  Not Updated</h4>","student/personal-information.php");
    }
}
  else{
   $result = $identity->createNewIdentification($inputData);
    if($result){
        redirect("<h4 style='color:green;font:200'><script>alert('Identification Details added Successfully')</script>Identification  Details added Successfully</h4>","student/programmes.php");
    }
    else{
         redirect("<h4 style='color:red; font:200'><script>alert('Something Went Wrong Identification Not Created')</script>Something Went Wrong Identification  Not Created</h4>","student/personal-information.php");
      }
  }

}



