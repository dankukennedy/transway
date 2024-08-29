<?php
//session_start();

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $escapedMessage = json_encode($message);
    //echo "<script>alert($escapedMessage);</script>";

    echo "<h3 style='color: green;'>$message</h3>";
    unset($_SESSION['message']);
}
?>
