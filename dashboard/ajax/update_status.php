<?php
session_start();
include('../../db_connection.php');

$service_id = $_POST['service_id'] ?? null;
$action = $_POST['action'] ?? null;

if (!$service_id || !$action) {
    http_response_code(400);
    echo "Missing data.";
    exit;
}

$status = 1; // default
if ($action === 'confirm') {
    $status = 2; // Booking Confirmed
} elseif ($action === 'cancel') {
    $status = 0; // Cancelled
}

$stmt = $con->prepare("UPDATE service_status SET service_status = ? WHERE service_id = ?");
$stmt->bind_param("ii", $status, $service_id);

if ($stmt->execute()) {
    echo "Status updated.";
} else {
    http_response_code(500);
    echo "Failed to update.";
}

$stmt->close();
?>
