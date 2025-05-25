<?php
// session_start();
// $servername = "localhost";
// $username = "Admin";
// $password = "Test@123";
// $_SERVER
//connect to index.php
// $conn = mysqli_connect($servername, $username, $password);
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
  include("../components/header.php");
  include("../backend/db_connection.php");
  include("../backend/session.php");
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Index |</title>
    <!-- Bootstrap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- font awesome -->
    <script
      src="https://kit.fontawesome.com/ec51b9d2d0.js"
      crossorigin="anonymous"
    ></script>
    <!-- css -->
    <link rel="stylesheet" href="../asset/css/index.css" />
    
  </head>
  <body>
    <!-- navigation bar -->
    <div class="container-fluid bg-light" id="nav">
      <nav class="navbar navbar-expand-lg navbar-light d-flex justify">
        <a class="navbar-brand" href="#"><b>Dashboard</b></a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav left">
            <li class="nav-item">
              <a class="nav-link" href="#">Date: <span id="date"></span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa-solid fa-angle-down"></i
              ></a>
              <div class="dropdown-menu">
                <a href="" class="dropdown-item">
                  <?php
                    echo $username;
                  ?>
                </a>

                <a href="../backend/logout.php" class="dropdown-item"
                  >Logout</a
                >
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- end navigation -->
    <!-- dashboard -->
    <div class="container-fluid py-3 px-4" id="dash-cf">
      <div class="row">
        <div class="col-2 py-2" id="left-side">
          <div
            class="nav flex-column nav-pills"
            id="v-pills-tab"
            role="tablist"
            aria-orientation="vertical"
          >
            <!-- button for home -->
            <button
              class="nav-link active text-left"
              id="v-pills-profile-tab"
              data-toggle="pill"
              data-target="#v-pills-home"
              type="button"
            >
              <i class="fa-solid fa-home pr-3"></i>Home
            </button>
            <!-- end button for home -->
            <!-- button for list upload -->
            <button
              class="nav-link text-left"
              id="v-pills-users-tab"
              data-toggle="pill"
              data-target="#v-pills-list-upload"
              type="button"
            >
              <i class="fa-solid fa-file pr-3"></i>List Upload
            </button>
            <!-- end button for list upload -->
            <!-- button for add user -->
            <button
              class="nav-link text-left"
              id="v-pills-users-tab"
              data-toggle="pill"
              data-target="#v-pills-add-user"
              type="button"
            >
              <i class="fa-solid fa-user pr-3"></i>Booking List
            </button>
            <!-- end button for add user -->
          </div>
        </div>

        <div class="col-9 mx-3 py-3 px-4" id="right-side">
          <div class="tab-content" id="v-pills-tabContent">
            <!-- profile -->
            <div
              class="tab-pane fade profile show active"
              id="v-pills-home"
              role="tabpanel"
            >
              <div class="row">
                <div class="col-6">
                  <h1>Home</h1>
                </div>
                <div class="col-6">
                  <h6 class="text-success mt-3 text-right">
                    Active <i class="fa-solid fa-circle"></i>
                  </h6>
                </div>
              </div>
              <hr />

              <div class="col">
                <?php

                  $select = "SELECT * FROM services";
                  $result = mysqli_query($con, $select);

                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col items my-5">
                  <div class="row">
                    <div class="col-lg-8">
                      <h3><?php echo $row['servicename']; ?></h3>
                      <p><?php echo $row['service_desc']; ?></p>
                      <p class="text-warning"><b>RS- 1500/-</b></p>
                      <button class="btn btn-info">Book Service</button>
                      <button class="btn btn-danger mx-2">Delete</button>
                    </div>
                    <div class="col-lg-4">
                      <img src="../uploads/<?php echo $row['service_img']; ?>" alt="" class="img-fluid" />
                    </div>
                  </div>
                </div>
                <?php
                    }
                  } else {
                    echo "<p>No services found.</p>";
                  }
                ?>
              </div>
            <!-- end profile -->
            <!-- start meeting -->
            <?php
              include("../backend/service_list.php"); 
            ?>

            <div class="tab-pane fade" id="v-pills-list-upload" role="tabpanel">
              <h1>List upload</h1>
              <hr />

              <div id="upload-response"></div>

              <form id="product-upload-form" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <input type="text" class="form-control" name="product_name" required>
                </div>

                <div class="form-group">
                  <label for="product_desc">Product Description</label>
                  <input type="text" class="form-control" name="product_desc" required>
                </div>

                <div class="form-group">
                  <label for="product_id">Product ID</label>
                  <input type="number" class="form-control" name="product_id" required>
                </div>

                <div class="form-group">
                  <label for="product_img">Product Image</label>
                  <input type="file" class="form-control" name="product_img" accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>

            <script>
              $('#product-upload-form').on('submit', function(e) {
                e.preventDefault();
              
                var formData = new FormData(this);
              
                $.ajax({
                  url: '../backend/service_list.php',
                  type: 'POST',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    $('#upload-response').html('<div class="alert alert-success">' + response + '</div>');
                    $('#product-upload-form')[0].reset(); 
                  },
                  error: function(xhr, status, error) {
                    $('#upload-response').html('<div class="alert alert-danger">Error: ' + error + '</div>');
                  }
                });
              });
            </script>
            <!-- assingment -->
            <div class="tab-pane fade" id="v-pills-add-user" role="tabpanel">
              <div class="row py-2">
                <div class="col-10">
                  <h3>Booking List</h3>
                </div>
              </div>
              <hr />
              <div class="col">
                <div class="col items my-5">
                  <div class="row">
                      <div class="col-lg-8">
                          <h3>Lorem ipsum dolor sit.</h3>
                          <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, eaque!</p>
                          <p class="text-warning"><b>RS- 1500/-</b></p>
                          <button class="btn btn-info">Book Service</button>
                          <span class="text-success"><b>Status:</b></span>
                        </div>
                      <div class="col-lg-4">
                          <img src="https://images.pexels.com/photos/6349399/pexels-photo-6349399.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end assingment -->
          </div>
        </div>
      </div>
    </div>
    <script>
      setInterval(() => {
        const d = new Date();
        document.getElementById("date").innerHTML = d.toLocaleString();
      }, 1000);
    </script>
  </body>
</html>
