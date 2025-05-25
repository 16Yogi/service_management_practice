<?php
include('db_connection.php');

if (isset($_POST['product_name'], $_POST['product_desc'], $_POST['product_id']) && isset($_FILES['product_img'])) {
    $product_name = $_POST['product_name'];
    $product_desc = $_POST['product_desc'];
    $product_id = $_POST['product_id'];
    
    $fileError = $_FILES['product_img']['error'];

    if ($fileError === 0) {
        $img_name = basename($_FILES['product_img']['name']);
        $tmp_name = $_FILES['product_img']['tmp_name'];
        $upload_dir = '../uploads/';
        $target_path = $upload_dir . $img_name;

        // Create upload directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        if (move_uploaded_file($tmp_name, $target_path)) {
            $sql = "INSERT INTO services (servicename, service_desc, service_id, service_img) 
                    VALUES ('$product_name', '$product_desc', $product_id, '$img_name')";

            if (mysqli_query($con, $sql)) {
                echo "✅ Product uploaded successfully.";
            } else {
                echo "❌ Database error: " . mysqli_error($con);
            }
        } else {
            echo "❌ Failed to move uploaded file.";
        }
    } else {
        echo "❌ Upload error code: $fileError";
    }
} else {
    // echo "❌ All fields are required.";
}
?>
