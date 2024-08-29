<?php

class ProgrammeController{

    public function __construct()
    {
       $db=new DatabaseConnection;
       $this->conn=$db->conn;
    }

    public function index($studentUserId)
    {
      $studentUserId;
        $proQry="SELECT * FROM programme WHERE studentUserId = '$studentUserId' order by id desc";
        $result=$this->conn->query($proQry);
        if ($result->num_rows > 0) {
          // Fetch all rows as an associative array
          $data = [];
          while ($row = $result->fetch_assoc()) {
              $data[] = $row;
          }
          return $data;
        }else
          {
            return false;
          }
    }

   public function createNewProgramme($inputData){
     $data ="'".implode("','",$inputData)."'";
     $proQuery = "INSERT INTO programme(studentUserId,number,indexNumber,fullname,graduateType,programme,admissionYear,transcriptEmail,graduationYear) VALUES($data)";
     $result= $this->conn->query($proQuery);
     if($result){
        return true;
     } 
      else{
        return false;
      }
      
     }

     public function programExist($inputData){
      $studentUserId = $inputData['studentUserId'];
      $proQuery = "SELECT studentUserId from programme WHERE studentUserId = $studentUserId LIMIT 1";
      $result=$this->conn->query($proQuery);
      if($result->num_rows > 0){
             return true;
      }else{
        return false;
      }

    }


     public function update($inputData)
      {
        $studentUserId=$inputData['studentUserId'];

        $number=$inputData['number'];
        $indexNumber=$inputData['indexNumber'];
        $fullname=$inputData['fullname'];
        $graduateType=$inputData['graduateType'];
        $programme=$inputData['programme'];
        $admissionYear=$inputData['admissionYear'];
        $transcriptEmail=$inputData['transcriptEmail'];
        $graduationYear=$inputData['graduationYear'];

        $proUpdateQry=" UPDATE programme SET number='$number',indexNumber='$indexNumber',fullname='$fullname',graduateType='$graduateType',programme='$programme',admissionYear='$admissionYear',transcriptEmail='$transcriptEmail',graduationYear='$graduationYear' WHERE studentUserId='$studentUserId' LIMIT 1 ";
        $result =$this->conn->query( $proUpdateQry);
        if($result)
         {
          return true;
         }  else
           {
            return  false;
           }

      }
}