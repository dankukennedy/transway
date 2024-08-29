<?php

// Ensure this line includes the file where BD_HOST, BD_USER, BD_PASSWORD, BD_DATABASE are defined
include_once('../config/app.php');

class DatabaseConnection
{
    public $conn;

    public function __construct()
    {
        // Ensure constants are defined before trying to use them
        if(!defined('BD_HOST') || !defined('BD_USER') || !defined('BD_PASSWORD') || !defined('BD_DATABASE')) {
            die("<h1>Database configuration constants are not defined</h1>");
        }

        $conn = new mysqli(BD_HOST, BD_USER, BD_PASSWORD, BD_DATABASE);
        if ($conn->connect_error) {
            die("<h1>Database Connection Failed</h1>");
        }

        // Return the connection
        return $this->conn = $conn;
    }
}
?>
