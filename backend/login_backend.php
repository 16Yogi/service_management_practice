<?php
include("db_connection.php"); 
session_start();

if (isset($_POST['login'])) {
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $mobile = mysqli_real_escape_string($con, $mobile);
    $password = mysqli_real_escape_string($con, $password);

    $query = "SELECT * FROM users WHERE mobile='$mobile' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if ($user['password'] === $password) {
            $_SESSION['mobile'] = $user['mobile'];
            $_SESSION['usertype'] = $user['usertype']; 
            $_SESSION['username'] = $user['username']; 
            $_SESSION['user_address'] = $user['user_address'];

            // Redirect based on usertype
            if ($user['usertype'] == 1) {
                header("Location: ../dashboard/index.php");
            } elseif ($user['usertype'] == 2) {
                header("Location: ../index.php");
            } else {
                // Unknown usertype
                echo "<script>alert('Invalid user type'); window.location.href='../components/login.php';</script>";
            }
            exit();
        } else {
            echo "<script>alert('Invalid password'); window.location.href='../components/login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid mobile or user not found'); window.location.href='../components/login.php';</script>";
    }
}
?>
