<?php
// backend/session.php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'] ?? '';
    $usertype = $_SESSION['usertype'] ?? '';
    $usermobile = $_SESSION['mobile'] ?? '';
    $useraddress = $_SESSION['user_address'] ?? '';
} else {
    header("Location:components/login.php");
}
?>
