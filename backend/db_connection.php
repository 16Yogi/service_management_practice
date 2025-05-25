<?php
    $con = mysqli_connect("localhost","root","1234","service_management");
    if(!$con){
        die("Connection failed: " . mysqli_connect_error());
    }
?>