<?php
class DatabaseConnection
{
    public function __construct()
    {
      $conn = new mysqli(BD_HOST,BD_USER,BD_PASSWORD,BD_DATABASE);
      if($conn-> connect_error)
        {
      die("<h1>Database Connection Failed</h1>");
        }
       //echo "Database Connected Successfully";
        return $this-> conn = $conn;
     }

}


?>