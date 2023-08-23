<?php 
include('db.php');

$customer_id = $_POST['customer_id'];
$total = $_POST['total'];

$stmt = $mysqli->prepare("INSERT INTO orders (customer_id, total) VALUES (?, ?)");
$stmt->bind_param('id', $customer_id, $total);

if($stmt->execute()) {
    header("Location: index.php?success=order");
} else {
    echo "Error saving order.";
}

$stmt->close();
?>
