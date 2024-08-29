<?php 

class TransFetch{
    public function __construct()
    {
       $db=new DatabaseConnection;
       $this->conn=$db->conn;
    }
 
    public function transFetch($studentUserId)
    {
      $studentUserId;
        $pesQry="SELECT * FROM transcripts WHERE studentUserId = '$studentUserId' order by id desc limit 1";
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



public function newApplication() {
  $sqlQuery = "SELECT COUNT(*) as total FROM transcripts ";
  $result = $this->conn->query($sqlQuery);
  
  if ($result) {
      $row = $result->fetch_assoc();
      return (int)$row['total'];
  }
  return 0;
}
public function totalTranDelivered() {
  $appQuest = "SELECT COUNT(*) as total FROM transcripts WHERE disable = 1";
  $result = $this->conn->query($appQuest);
  if ($result) {
    $row = $result->fetch_assoc();
    return (int)$row['total'];
}
return 0;
}

public function newApplicationServe() {
  $appQuest = "SELECT COUNT(*) as total FROM transcripts WHERE disable = 1 ";
  $result = $this->conn->query($appQuest);
  if ($result) {
    $row = $result->fetch_assoc();
    return (int)$row['total'];
}
return 0;
}

// Method to get paginated records
public function getPaginatedApplications($limit, $offset) {
  $sqlQuery = "SELECT * FROM transcripts ORDER BY createdAt DESC LIMIT $limit OFFSET $offset";
  $result = $this->conn->query($sqlQuery);

  if ($result) {
      return $result->fetch_all(MYSQLI_ASSOC);
  }
  return [];
}
 public function totalFetchTransReady(){
  $appQuest="SELECT * FROM transcripts WHERE disable = 1 order by createdAt desc ";
  $result = $this->conn->query($appQuest);
  if ($result) {
    $row = $result->fetch_assoc();
    return (int)$row['total'];
}
return 0;
 }

// Method to get paginated records
public function getPaginatedApplications1($limit, $offset) {
  $sqlQuery = "SELECT * FROM transcripts WHERE disable = 1 ORDER BY createdAt DESC LIMIT $limit OFFSET $offset";
  $result = $this->conn->query($sqlQuery);
  
  if ($result) {
      return $result->fetch_all(MYSQLI_ASSOC);
  }
  return [];
}

// Method to get paginated records
public function getPaginatedApplications2($limit, $offset) {
  $sqlQuery = "SELECT * FROM transcripts WHERE disable = 0 ORDER BY createdAt DESC LIMIT $limit OFFSET $offset";
  $result = $this->conn->query($sqlQuery);
  
  if ($result) {
      return $result->fetch_all(MYSQLI_ASSOC);
  }
  return [];
}





}