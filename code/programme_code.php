<?php
include('../config/app.php');
include('../controllers/ProgrammeController.php');

if(isset($_POST['reg_program'])){
   
   $inputData= [
    'studentUserId'=>validateInput($db->conn, $_POST['studentUserId']),
    'number'=>validateInput($db->conn, $_POST['number']),
    'indexNumber'=>validateInput($db->conn, $_POST['indexNumber']),
    'fullname'=>validateInput($db->conn, $_POST['fullname']),
    'graduateType'=>validateInput($db->conn, $_POST['graduateType']),
    'programme'=>validateInput($db->conn, $_POST['programme']),
    'admissionYear'=>validateInput($db->conn, $_POST['admissionYear']),
    'transcriptEmail'=>validateInput($db->conn, $_POST['transcriptEmail']),
    'graduationYear'=>validateInput($db->conn, $_POST['graduationYear']),
    ];

    $programme = new ProgrammeController;
  
$checkProgram = $programme->programExist($inputData);
if($checkProgram){
    echo "<script> alert('Your data have been save already')</script>";
     $result = $programme-> update($inputData);
      if($result){
      redirect("<h4 style='color:green;font:200'><script>alert('Programme Details Updated Successfully')</script>Programme  Details Updated Successfully</h4>","student/review.php");
    }
    else{
      redirect("<h4 style='color:red; font:200'><script>alert('Something Went Wrong Programme Not Updated')</script>Something Went Wrong Programme  Not Updated</h4>","student/programme.php");
    }
}
  else{
   $result = $programme->createNewProgramme($inputData);
    if($result){
        redirect("<h4 style='color:green;font:200'><script>alert('Programme Details added Successfully')</script>Programme  Details added Successfully</h4>","student/review.php");
    }
    else{
         redirect("<h4 style='color:red; font:200'><script>alert('Something Went Wrong Programme Not Created')</script>Something Went Wrong Programme  Not Created</h4>","student/programme.php");
      }
  }
}