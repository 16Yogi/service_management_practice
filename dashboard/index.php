<?php
  include("../components/header.php");
  include("../backend/db_connection.php");
  include("../backend/session.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ec51b9d2d0.js" crossorigin="anonymous"></script>
    <style>
      #left-side .nav-link.active {
        background-color: #007bff;
        color: white;
      }
      .img-fluid {
        max-width: 100%;
        height: auto;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid bg-light">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#"><b>Dashboard</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link">Date: <span id="date"></span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa-solid fa-angle-down"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">
                  <?php
                    echo $username;
                  ?>
                </a>
                <a class="dropdown-item" href="../backend/logout.php">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <div class="container-fluid py-3 px-4">
      <div class="row">
        <div class="col-2 py-2" id="left-side">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active text-left" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"> <i class="fa-solid fa-home pr-3"></i>Home </a>
            <a class="nav-link text-left" id="v-pills-list-tab" data-toggle="pill" href="#v-pills-list" role="tab"> <i class="fa-solid fa-file pr-3"></i>List Upload </a>
            <a class="nav-link text-left" id="v-pills-booking-tab" data-toggle="pill" href="#v-pills-booking" role="tab"> <i class="fa-solid fa-user pr-3"></i>Booking List </a>
          </div>
        </div>

        <div class="col-9 mx-3 py-3 px-4" id="right-side">
          <div class="tab-content" id="v-pills-tabContent">
            <!-- Home Tab -->
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <h1>Home</h1>
              <hr />
              <!-- Add service items dynamically here -->
              <div class="col">
  <?php
    $select = "SELECT * FROM services";
    $result = mysqli_query($con, $select);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
  ?>
  <!-- Place ID on this div -->
  <div class="col items my-5" id="serviceCard<?= $row['service_id']; ?>">
    <div class="row">
      <div class="col-lg-8">
        <h3><?php echo $row['servicename']; ?></h3>
        <p><?php echo $row['service_desc']; ?></p>
        <p class="text-warning"><b>RS- 1500/-</b></p>
        <button class="btn btn-danger mx-2 delete-service-btn" data-id="<?= $row['service_id']; ?>">Delete</button>
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

            </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  $(".delete-service-btn").click(function () {
    const serviceId = $(this).data("id");

    if (confirm("Are you sure you want to delete this service?")) {
      $.ajax({
        url: "ajax/delete_service.php",
        type: "POST",
        data: { service_id: serviceId },
        success: function (response) {
          alert(response);
          $("#serviceCard" + serviceId).fadeOut();
        },
        error: function () {
          alert("Failed to delete service.");
        }
      });
    }
  });
});
</script>



            <!-- List Upload Tab -->
            <div class="tab-pane fade" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
              <h1>List Upload</h1>
              <hr />
              <form id="product-upload-form" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Product Name</label>
                  <input type="text" class="form-control" name="product_name" required />
                </div>
                <div class="form-group">
                  <label>Product Description</label>
                  <input type="text" class="form-control" name="product_desc" required />
                </div>
                <div class="form-group">
                  <label>Product ID</label>
                  <input type="number" class="form-control" name="product_id" required />
                </div>
                <div class="form-group">
                  <label>Product Image</label>
                  <input type="file" class="form-control" name="product_img" accept="image/*" required />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              <div id="upload-response"></div>
            </div>

            <!-- Booking List Tab -->
            <div class="tab-pane fade" id="v-pills-booking" role="tabpanel" aria-labelledby="v-pills-booking-tab">
              <h3>Booking List</h3>
              <hr />
              <div class="col">
                <?php

                 $select = "SELECT s.*, ss.customer_name, ss.customer_number, ss.customer_address, ss.service_status FROM services s INNER JOIN service_status ss ON s.service_id = ss.service_id WHERE ss.service_status = 1";
                  $result = mysqli_query($con, $select);

                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col items my-5" id="bookingCard<?= $row['service_id']; ?>">
                  <div class="row">
                    <div class="col-lg-8">
                      <h3><?php echo $row['servicename']; ?></h3>
                      <p><?php echo $row['service_desc']; ?></p>
                      <p class=""><strong>Client Name:</strong> <?php echo $row['customer_name']; ?></p>
                      <p class=""><strong>Client Contect:</strong><?php echo $row['customer_number']; ?></p>
                      <p class=""><strong>Client Address:</strong><?php echo $row['customer_address']; ?></p>

                      <!-- <button class="btn btn-info">Confirm</button> -->
                      <!-- <button class="btn btn-danger mx-2">Cancel</button> -->
                      <button class="btn btn-info confirm-btn" data-id="<?= $row['service_id']; ?>">Confirm</button>
                      <button class="btn btn-danger mx-2 cancel-btn" data-id="<?= $row['service_id']; ?>">Cancel</button>
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
            </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  $(".confirm-btn").click(function () {
    let serviceId = $(this).data("id");

    $.ajax({
      url: "ajax/update_status.php",
      type: "POST",
      data: {
        service_id: serviceId,
        action: "confirm"
      },
      success: function (response) {
        alert("Service Confirmed!");
        // Optionally reload index content or just remove this card
        $("#bookingCard" + serviceId).fadeOut();
      },
      error: function () {
        alert("Failed to confirm booking.");
      }
    });
  });

  $(".cancel-btn").click(function () {
    let serviceId = $(this).data("id");

    $.ajax({
      url: "ajax/update_status.php",
      type: "POST",
      data: {
        service_id: serviceId,
        action: "cancel"
      },
      success: function (response) {
        alert("Service Canceled!");
        $("#bookingCard" + serviceId).fadeOut();
      },
      error: function () {
        alert("Failed to cancel booking.");
      }
    });
  });
});
</script>

          </div>
        </div>
      </div>
    </div>

    <script>
      setInterval(() => {
        const d = new Date();
        document.getElementById("date").innerHTML = d.toLocaleString();
      }, 1000);

      $('#product-upload-form').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
          url: '../backend/service_list.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            $('#upload-response').html('<div class="alert alert-success">' + response + '</div>');
            $('#product-upload-form')[0].reset();
          },
          error: function (xhr, status, error) {
            $('#upload-response').html('<div class="alert alert-danger">Error: ' + error + '</div>');
          },
        });
      });
    </script>
  </body>
</html>
