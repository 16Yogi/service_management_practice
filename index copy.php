<?php
  include("backend/session.php");
  // echo $username;
  // echo $usermobile;
  // echo $useraddress;
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elc</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="asset/css/index.css">
    <?php
      include("backend/db_connection.php");

    ?>
</head>
<body>
    <!-- nav start -->
    <div class="container-fluid nav-sec">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand logo" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Service</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Status</a>
              </li>
              <li class="nav-item">
              <?php
                if($username!=''){
              ?>
                <a class="nav-link" href="backend/logout.php">Logout</a>
              <?php
               } else {
              ?>
                <a class="nav-link" href="components/login.php">Login</a>
              <?php
                }
              ?>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </nav>
    </div>
    <!-- nav end -->
    <!-- banner start -->
    <div id="carouselExampleSlidesOnly" class="carousel slide banner" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" id="img">
                <!-- <img src="https://images.pexels.com/photos/1654760/pexels-photo-1654760.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="..."> -->
            </div>
            <div class="carousel-item" id="img">
              <!-- <img src="https://media.istockphoto.com/id/1437355350/photo/cargo-containes-at-sea-port-global-business.jpg?s=1024x1024&w=is&k=20&c=BTRI-6z04rWtJGEe0T5SzZWNq5qVp3JFtR0DvveKnyk=" class="d-block w-100" alt="..."> -->
            </div>
            <div class="carousel-item" id="img">
              <!-- <img src="https://media.istockphoto.com/id/1437355350/photo/cargo-containes-at-sea-port-global-business.jpg?s=1024x1024&w=is&k=20&c=BTRI-6z04rWtJGEe0T5SzZWNq5qVp3JFtR0DvveKnyk=" class="d-block w-100" alt="..."> -->
            </div>
        </div>
    </div>
    <!-- banner end -->
    <!-- service start -->
    <div class="container-fluid">
        <div class="container py-5">
            <div class="col py-3">
                <h2>Services</h2>
            </div>
            
            <?php
              $select = "SELECT s.service_id, s.servicename, s.service_desc, s.service_img, IFNULL(ss.service_status,0) AS service_status FROM services s LEFT JOIN service_status ss ON s.service_id = ss.service_id AND ss.customer_number = ?";
              $stmt = $con->prepare($select);
              $stmt->bind_param("s", $_SESSION['mobile']);
              $stmt->execute();
              $result = $stmt->get_result();

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
              ?>
              <div class="col-md-6 col-lg-12 mb-4">
                  <div class="card">
                      <div class="row no-gutters">
                          <div class="col-md-8">
                              <div class="card-body">
                                  <h5 class="card-title"><?php echo htmlspecialchars($row['servicename']); ?></h5>
                                  <p class="card-text"><?php echo htmlspecialchars($row['service_desc']); ?></p>
                                  <p class="text-warning"><strong>Rs. 1500/-</strong></p>

                                  <form method="post" action="backend/book_service.php">
                                      <input type="hidden" name="service_id" value="<?php echo $row['service_id']; ?>">
                                      <?php if ($row['service_status'] == 0) { ?>
                                          <input type="submit" name="book-btn" class="btn btn-info btn-sm" value="Book Service">
                                      <?php } else if ($row['service_status'] == 1) { ?>
                                          <input type="submit" name="cancel-btn" class="btn btn-danger btn-sm" value="Cancel Booking">
                                  </form>
                                      
                                  <p class="mt-2"><span class="text-success"><strong>Status:</strong></span>
                                    <div class="tracker">
                                      <div class="progress-line"></div>
                                      <div class="progress-fill" id="progressFill<?php echo $row['service_id']; ?>" style="width: 50%;"></div>
                                      <div class="steps">
                                        <div class="step active" id="step1<?php echo $row['service_id']; ?>">
                                          <div class="circle"></div>
                                          <div class="label">Book Initiated</div>
                                        </div>
                                        <div class="step active" id="step2<?php echo $row['service_id']; ?>">
                                          <div class="circle"></div>
                                          <div class="label">Booking Confirmed</div>
                                        </div>
                                        <div class="step" id="step3<?php echo $row['service_id']; ?>">
                                          <div class="circle"></div>
                                          <div class="label">Completed</div>
                                        </div>
                                      </div>
                                    </div>
                                  </p>
                                  <?php } ?>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <img src="uploads/<?php echo htmlspecialchars($row['service_img']); ?>" class="card-img" alt="Service Image">
                          </div>
                      </div>
                  </div>
              </div>
            <?php
                }
            } else {
                echo "<p>No services found.</p>";
            }
            $stmt->close();
            ?>
        </div>
    </div>
    <!-- service end -->
    <!-- footer start-->
    <div class="container-fluid py-5" id="footer-cf">
        <div class="container py-2">
          <h2>Contact us</h2>
          <hr class="bg-white" />
          <div class="row py-2">
            <div class="col-lg-7 col-md-6 col-sm-12">
              <h4>Social Media</h4>
              <ul class="px-0 py-2">
                <li><a href="/"><i className="fa-brands fa-youtube"></i></a></li>
                <li><a href="/"><i className="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="/"><i className="fa-brands fa-instagram"></i></a></li>
                <li><a href="/"><i className="fa-brands fa-x-twitter"></i></a></li>
                <li><a href="/"><i className="fa-brands fa-linkedin-in"></i></a></li>
              </ul>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12" id="form">
              <h4>Subscribe</h4>
              <form onSubmit={handleSubmit}>
                <input
                  type="email"
                  className="form-control"
                  placeholder="Email.."
                />
                <button class="btn btn-info mt-2" type="submit">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid py-3" id="copyright">
        <div class="container">
          <p class="text-center">All Rights Reserved © - 2025 By ....</p>
        </div>
      </div>
    <!-- footer end -->
    <!-- js -->
    <script src="asset/js/"></script>
</body>
</html>