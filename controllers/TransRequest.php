<?php 

class TransRequest{
    public function __construct()
    {
       $db=new DatabaseConnection;
       $this->conn=$db->conn;
    }
 


    public function reqTranscript($studentUserId,$tNumber,$email,$contact,$programme,$graduationYear)
    {
        $trans_query="INSERT INTO transcripts(studentUserId,tNumber,email,contact,programme,graduationYear) VALUES('$studentUserId','$tNumber','$email','$contact','$programme','$graduationYear')";
        $result = $this->conn->query($trans_query);
        return $result;
    }


    public function totalTransRequest(){
      $appQuest="SELECT COUNT(*) AS count FROM transcripts ";
      $result = $this-> conn->query($appQuest);
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row;
      }else{
        return false;
      }
    }

    public function totalTransReady(){
      $appQuest="SELECT COUNT(*) AS count FROM transcripts WHERE disable = 1";
      $result = $this-> conn->query($appQuest);
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row;
      }else{
        return false;
      }
    }

    public function totalTranDelivered(){
      $appQuest="SELECT COUNT(*) AS count FROM transcripts WHERE disable = 1";
      $result = $this-> conn->query($appQuest);
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row;
      }else{
        return false;
      }
    }

    public function totalTransServe(){
      $appQuest="SELECT COUNT(*) AS count FROM transcripts WHERE disable = 1";
      $result = $this-> conn->query($appQuest);
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row;
      }else{
        return false;
      }
    }

    public function newApplication(){
        $appQuest="SELECT COUNT(*) AS count FROM transcripts WHERE disable = 0";
        $result = $this-> conn->query($appQuest);
        if($result->num_rows > 0){
          $row = $result->fetch_assoc();
          return $row;
        }else{
          return false;
        }
    }




}