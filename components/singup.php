<?php
  include('../backend/singup_backend.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="../asset/css/index.css">
</head>
<body>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="col logup-form p-3">
                <form method="post">
                    <h2>singup Page</h2>
                    <hr>
                    <div class="form-row">
                      <div class="col">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="fname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Fullname" name="fullname">
                      </div>
                      <div class="col">
                        <label for="exampleInputEmail1">Mobile Number</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Mobile" name="mobile">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Full Address</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Full Address" name="fulladd">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password"  class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirm Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password" name="cpassword">
                    </div>
                    <a href="login.php">Login</a>
                    <button type="submit" class="btn btn-primary" name="create_ac">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>