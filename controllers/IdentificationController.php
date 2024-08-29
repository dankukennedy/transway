<?php
class IdentificationController{

    public function __construct()
    {
       $db=new DatabaseConnection;
       $this->conn=$db->conn;
    }

    public function index($studentUserId)
    {
      $studentUserId;
        $ideQry="SELECT * FROM identity WHERE studentUserId = '$studentUserId' order by id desc";
        $result=$this->conn->query($ideQry);
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
    public function identityExist($inputData){
      $studentUserId = $inputData['studentUserId'];
      $ideQuery = "SELECT studentUserId from identity WHERE studentUserId = $studentUserId LIMIT 1";
      $result=$this->conn->query($ideQuery);
      if($result->num_rows > 0){
             return true;
      }else{
        return false;
      }

    }


 public function createNewIdentification($inputData){
    $data ="'".implode("','",$inputData)."'";
    $identQuery = "INSERT INTO identity(studentUserId,idCard,idCardNumber,IdCardImage) VALUES($data)";
    $result= $this->conn->query($identQuery);
    if($result){
       return true;
    }
     else{
       return false;
     }

    }
    
    public function update($inputData)
    {
      $studentUserId=$inputData['studentUserId'];

      $idCard=$inputData['idCard'];
      $idCardNumber=$inputData['idCardNumber'];
      $IdCardImage=$inputData['IdCardImage'];

      $idenUpdateQry=" UPDATE identity SET idCard='$idCard',idCardNumber='$idCardNumber',IdCardImage='$IdCardImage' WHERE studentUserId='$studentUserId' LIMIT 1 ";
      $result =$this->conn->query( $idenUpdateQry);
      if($result)
       {
        return true;
       }  else
         {
          return  false;
         }



    }
    


 }
