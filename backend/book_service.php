<?php
session_start();
include('../db_connection.php'); // Adjust path

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Unknown error'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'] ?? '';
    $mobile = $_SESSION['mobile'] ?? '';
    $user_address = $_SESSION['user_address'] ?? '';
    $service_id = $_POST['service_id'] ?? null;

    if (empty($username) || empty($mobile) || empty($user_address) || !$service_id) {
        $response['message'] = 'User/session data missing or invalid service ID.';
        echo json_encode($response);
        exit;
    }

    // Get service name for insertion
    $stmt = $con->prepare("SELECT servicename FROM services WHERE service_id = ?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $stmt->bind_result($servicename);
    $stmt->fetch();
    $stmt->close();

    if (empty($servicename)) {
        $response['message'] = 'Invalid service ID.';
        echo json_encode($response);
        exit;
    }

    if (isset($_POST['book-btn'])) {
        $stmt = $con->prepare("SELECT service_id FROM service_status WHERE service_id = ? AND customer_number = ?");
        $stmt->bind_param("is", $service_id, $mobile);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            $stmt = $con->prepare("UPDATE service_status SET service_status = 1 WHERE service_id = ? AND customer_number = ?");
            $stmt->bind_param("is", $service_id, $mobile);
            $stmt->execute();
            $stmt->close();
        } else {
            $stmt->close();
            $status = 1;
            $stmt = $con->prepare("INSERT INTO service_status (servicename, service_id, customer_name, customer_number, customer_address, service_status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sisssi", $servicename, $service_id, $username, $mobile, $user_address, $status);
            $stmt->execute();
            $stmt->close();
        }
        $response['success'] = true;
        $response['message'] = 'Service booked successfully.';
    }

    if (isset($_POST['cancel-btn'])) {
        $stmt = $con->prepare("UPDATE service_status SET service_status = 0 WHERE service_id = ? AND customer_number = ?");
        $stmt->bind_param("is", $service_id, $mobile);
        $stmt->execute();
        $stmt->close();
        $response['success'] = true;
        $response['message'] = 'Booking canceled successfully.';
    }
}

echo json_encode($response);
?>
