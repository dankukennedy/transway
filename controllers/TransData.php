<?php 

class TransData{
    public function __construct()
    {
       $db=new DatabaseConnection;
       $this->conn=$db->conn;
    }

    public function totalFetchTrans(){
        $appQuest="SELECT * FROM transcripts  order by createdAt desc ";
        $result = $this-> conn->query($appQuest);
        if($result->num_rows > 0){
          return $result;
        }else{
          return false;
        }
      }

      
    public function totalFetchTransReady(){
        $appQuest="SELECT * FROM transcripts WHERE disable = 1 order by createdAt desc ";
        $result = $this-> conn->query($appQuest);
        if($result->num_rows > 0){
          return $result;
        }else{
          return false;
        }
      }

      public function newApplication(){
        $appQuest="SELECT * FROM transcripts WHERE disable = 0 order by createdAt desc";
        $result = $this-> conn->query($appQuest);
        if($result->num_rows > 0){
          return $result;
        }else{
          return false;
        }
    }


// Method to get paginated records
public function getPaginatedApplications1($limit, $offset) {
  $sqlQuery = "SELECT * FROM transcripts WHERE disable = 0 ORDER BY createdAt DESC LIMIT $limit OFFSET $offset";
  $result = $this->conn->query($sqlQuery);

  if ($result) {
      return $result->fetch_all(MYSQLI_ASSOC);
  }
  return [];
}



}
