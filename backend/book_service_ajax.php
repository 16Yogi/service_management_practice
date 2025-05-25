<?php
session_start();
include('db_connection.php');

$username = $_SESSION['username'] ?? '';
$mobile = $_SESSION['mobile'] ?? '';
$user_address = $_SESSION['user_address'] ?? '';
$service_id = $_POST['service_id'] ?? null;
$action = $_POST['action'] ?? '';

if (!$username || !$mobile || !$user_address || !$service_id || !$action) {
    echo "<div class='alert alert-danger'>Invalid data.</div>";
    exit;
}

$stmt = $con->prepare("SELECT * FROM services WHERE service_id = ?");
$stmt->bind_param("i", $service_id);
$stmt->execute();
$service = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$service) {
    echo "<div class='alert alert-danger'>Service not found.</div>";
    exit;
}

$servicename = $service['servicename'];
$service_desc = $service['service_desc'];
$service_img = $service['service_img'];

if ($action === 'book') {
    $stmt = $con->prepare("SELECT * FROM service_status WHERE service_id = ? AND customer_number = ?");
    $stmt->bind_param("is", $service_id, $mobile);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->close();
        $stmt = $con->prepare("UPDATE service_status SET service_status = 1 WHERE service_id = ? AND customer_number = ?");
        $stmt->bind_param("is", $service_id, $mobile);
        $stmt->execute();
    } else {
        $stmt->close();
        $stmt = $con->prepare("INSERT INTO service_status (servicename, service_id, customer_name, customer_number, customer_address, service_status) 
                               VALUES (?, ?, ?, ?, ?, 1)");
        $stmt->bind_param("sisss", $servicename, $service_id, $username, $mobile, $user_address);
        $stmt->execute();
    }
} elseif ($action === 'cancel') {
    $stmt = $con->prepare("UPDATE service_status SET service_status = 0 WHERE service_id = ? AND customer_number = ?");
    $stmt->bind_param("is", $service_id, $mobile);
    $stmt->execute();
}
$stmt->close();

// Re-fetch status
$stmt = $con->prepare("SELECT service_status FROM service_status WHERE service_id = ? AND customer_number = ?");
$stmt->bind_param("is", $service_id, $mobile);
$stmt->execute();
$stmt->bind_result($status);
$stmt->fetch();
$stmt->close();
$status = $status ?? 0;

// Send back updated HTML
?>

<div class="card">
    <div class="row no-gutters">
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($servicename) ?></h5>
                <p class="card-text"><?= htmlspecialchars($service_desc) ?></p>
                <p class="text-warning"><strong>Rs. 1500/-</strong></p>

                <?php if ($status == 0): ?>
                    <button class="btn btn-info btn-sm book-btn" data-id="<?= $service_id ?>">Book Service</button>
                <?php else: ?>
                    <button class="btn btn-danger btn-sm cancel-btn" data-id="<?= $service_id ?>">Cancel Booking</button>
                    <div class="tracker mt-3">
                        <div class="progress-line"></div>
                        <div class="progress-fill" style="width: <?= $status == 1 ? '25%' : ($status == 2 ? '50%' : '100%') ?>"></div>
                        <div class="steps">
                            <div class="step <?= $status >= 1 ? 'active' : '' ?>">
                                <div class="circle"></div>
                                <div class="label">Book Initiated</div>
                            </div>
                            <div class="step <?= $status >= 2 ? 'active' : '' ?>">
                                <div class="circle"></div>
                                <div class="label">Booking Confirmed</div>
                            </div>
                            <div class="step <?= $status == 3 ? 'active' : '' ?>">
                                <div class="circle"></div>
                                <div class="label">Completed</div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-4">
            <img src="uploads/<?= htmlspecialchars($service_img); ?>" class="card-img" alt="Service Image">
        </div>
    </div>
</div>
