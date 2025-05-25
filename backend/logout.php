<?php
    function logout(){
        session_start();
        if(isset($_SESSION['username'])){
            $_SESSION = [];

            if(ini_get("session.use_cookie")){
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
            header("location: ../components/login.php");
        }else{
            echo "<script>alert('user is login')</script>"; 
        }
    }
    
    logout();
?>