<?php 
include('db.php');

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$stmt = $mysqli->prepare("INSERT INTO customers (first_name, last_name, email, phone, address) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param('sssss', $first_name, $last_name, $email, $phone, $address);

if($stmt->execute()) {
    header("Location: index.php?success=customer");
} else {
    echo "Error saving customer.";
}

$stmt->close();
?>
