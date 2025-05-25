<?php
include('db_connection.php');
if(isset($_POST['create_ac'])){
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobile'];
    $usertype = 2;
    $address = $_POST['fulladd'];
    $password = $_POST['password'];
    $password1 = $_POST['cpassword'];

    $sql = "INSERT INTO users(username,mobile,usertype,user_address,password) VALUES ('$fullname','$mobile',$usertype,'$address','$password')";
    $result = mysqli_query($con,$sql);
    if($result){
        echo "<script>alert('Account created')</script>";
    }else{
        echo "<script>alert('Account creation failed')</script>";
    }
}
?>
