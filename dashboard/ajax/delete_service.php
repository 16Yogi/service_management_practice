<?php
include('../../db_connection.php');

$service_id = $_POST['service_id'] ?? null;

if (!$service_id) {
    http_response_code(400);
    echo "Service ID missing.";
    exit;
}

// First delete from service_status table
$stmt1 = $con->prepare("DELETE FROM service_status WHERE service_id = ?");
$stmt1->bind_param("i", $service_id);
$stmt1->execute();
$stmt1->close();

// Then delete from services table
$stmt2 = $con->prepare("DELETE FROM services WHERE service_id = ?");
$stmt2->bind_param("i", $service_id);

if ($stmt2->execute()) {
    echo "Service deleted successfully.";
} else {
    http_response_code(500);
    echo "Failed to delete service.";
}

$stmt2->close();
$con->close();
?>
