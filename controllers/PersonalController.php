<?php

class PersonalController{

    public function __construct()
    {
       $db=new DatabaseConnection;
       $this->conn=$db->conn;
    }


    public function index($studentUserId)
    {
      $studentUserId;
        $pesQry="SELECT * FROM personal WHERE studentUserId = '$studentUserId' order by id desc";
        $result=$this->conn->query($pesQry);
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

public function personalExist($inputData){
  $studentUserId = $inputData['studentUserId'];
  $exQuery = "SELECT studentUserId from personal WHERE studentUserId = $studentUserId LIMIT 1";
  $result=$this->conn->query($exQuery);
  if($result->num_rows > 0){
         return true;
  }else{
    return false;
  }

}

    public function createNewPersonal($inputData){
        $data ="'".implode("','",$inputData)."'";
        $perQuery = "INSERT INTO personal(studentUserId,surename,othername,gender,dob,code,country,number,address,postAddress,profileImg) VALUES($data)";
        $result= $this->conn->query($perQuery);
        if($result){
           return true;
        }
         else{
           return false;
         }

        }

        public function update($inputData)
        {
          $personal_id= $inputData['studentUserId'];

          $surename=$inputData['surename'];
          $othername=$inputData['othername'];
          $gender=$inputData['gender'];
          $dob=$inputData['dob'];
          $code=$inputData['code'];
          $country=$inputData['country'];
          $number=$inputData['number'];
          $address=$inputData['address'];
          $postAddress=$inputData['postAddress'];
          $profileImg=$inputData['profileImg'];

          $perUpdateQry=" UPDATE personal SET surename='$surename',othername='$othername',gender='$gender',dob='$dob',code='$code',country='$country',number='$number',address='$address',postAddress='$postAddress',profileImg='$profileImg' WHERE studentUserId='$personal_id' LIMIT 1 ";
          $result =$this->conn->query( $perUpdateQry);
          if($result)
           {
            return true;
           }  else
             {
              return  false;
             }


        }

}



