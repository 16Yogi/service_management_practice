<?php
// session_start();
// if($_SERVER['REQUEST_METHOD'] === 'POST'){
// $user = $_POST['username'];
// $pass = $_POST['password'];
// if($user === 'Admin' && $pass === 'Test@123'){
//     $_SESSION['admin'] = true;
//     header('Location: dashboard.php');
//     exit();
//   }
//   else{
//     $error = "Invalid username or password";
//   }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script
      src="https://kit.fontawesome.com/8ad8054466.js"
      crossorigin="anonymous"
    ></script>
    <style>
      form{
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        padding: 20px;
        border-radius: 10px;
        width: 22rem;
      }
    </style>
</head>
<body>
<section class="w-100 p-4 py-5 d-flex justify-content-center pb-4">
      <form method="POST">
        <h2 class="text-center">Log in</h2>
        <!-- User name input -->
        <div data-mdb-input-init="" class="form-outline mb-4" data-mdb-input-initialized="true">
          <label class="form-label" for="form2Example1" style="margin-left: 0px;">user name</label>
          <input type="text" name="username" id="form2Example1" class="form-control" fdprocessedid="p457l">
        <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 88.8px;"></div><div class="form-notch-trailing"></div></div></div>

        <!-- Password input -->
        <div data-mdb-input-init="" class="form-outline mb-4" data-mdb-input-initialized="true">
          <label class="form-label" for="form2Example2" style="margin-left: 0px;">Password</label>
          <input type="password" name="password" id="form2Example2" class="form-control" fdprocessedid="nhlubkb">
        <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 64.8px;"></div><div class="form-notch-trailing"></div></div></div>

        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">
          <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked="">
              <label class="form-check-label" for="form2Example31"> Remember me </label>
            </div>
          </div>

          <div class="col">
            <!-- Simple link -->
            <a href="#!">Forgot password?</a>
          </div>
        </div>

        <!-- Submit button -->
        <button type="submit" data-mdb-button-init="" data-mdb-ripple-init="" class="btn btn-primary btn-block mb-4" data-mdb-button-initialized="true" fdprocessedid="io0al9">Sign in</button>

        <!-- Register buttons -->
        <div class="text-center">
          <p>Not a member? <a href="#!">Register</a></p>
          <p>or sign up with:</p>
          <button type="button" data-mdb-button-init="" data-mdb-ripple-init="" class="btn btn-link btn-floating mx-1" data-mdb-button-initialized="true" fdprocessedid="qi0w3">
            <i class="fab fa-facebook-f"></i>
          </button>

          <button type="button" data-mdb-button-init="" data-mdb-ripple-init="" class="btn btn-link btn-floating mx-1" data-mdb-button-initialized="true" fdprocessedid="u3nzhu">
            <i class="fab fa-google"></i>
          </button>

          <button type="button" data-mdb-button-init="" data-mdb-ripple-init="" class="btn btn-link btn-floating mx-1" data-mdb-button-initialized="true" fdprocessedid="iuc8f5">
            <i class="fab fa-twitter"></i>
          </button>

          <button type="button" data-mdb-button-init="" data-mdb-ripple-init="" class="btn btn-link btn-floating mx-1" data-mdb-button-initialized="true" fdprocessedid="vp3vk5">
            <i class="fab fa-github"></i>
          </button>
        </div>
      </form>
    </section>
</body>
</html>