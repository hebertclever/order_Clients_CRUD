<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'] ?? '';
    $total = $_POST['total'] ?? '';

    $stmt = $mysqli->prepare("INSERT INTO orders (customer_id, total) VALUES (?, ?)");
    $stmt->bind_param('id', $customer_id, $total);
    $stmt->execute();
    $stmt->close();
}

$result = $mysqli->query("SELECT id, first_name, last_name FROM customers");
?>




<form action="save_order.php" method="post">
    Customer: 
    <select name="customer_id">
        <?php while ($row = $result->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></option>
        <?php endwhile; ?>
    </select>
    Total: <input type="text" name="total">
    <input type="submit" value="Add Order">
</form>
