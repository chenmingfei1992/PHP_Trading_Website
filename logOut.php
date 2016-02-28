<?php
session_start();
// Clear the session variables
unset($_SESSION['buyerID']);
unset($_SESSION['sellerID']);

//Go back to login page
header("Location: ./home.php");

?>