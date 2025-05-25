<?php
$mobile = $_SESSION['mobile'] ?? '';
if (!empty($service_id) && !empty($mobile)) {
    $stmt = $con->prepare("SELECT service_status FROM service_status WHERE service_id = ? AND customer_number = ?");
    $stmt->bind_param("is", $service_id, $mobile);
    $stmt->execute();
    $stmt->bind_result($status);
    if ($stmt->fetch()) {
        if ($status == 1) {
            echo "<span class='badge bg-success'>Booked</span>";
        } else {
            echo "<span class='badge bg-secondary'>Cancelled</span>";
        }
    } else {
        echo "<span class='badge bg-warning'>Not Booked</span>";
    }
    $stmt->close();
}
?>
