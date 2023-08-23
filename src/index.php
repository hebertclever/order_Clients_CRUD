<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';

    if (isset($_POST['id'])) {
        $stmt = $mysqli->prepare("UPDATE customers SET first_name=?, last_name=?, email=?, phone=?, address=? WHERE id=?");
        $stmt->bind_param('sssssi', $first_name, $last_name, $email, $phone, $address, $_POST['id']);
    } else {
        $stmt = $mysqli->prepare("INSERT INTO customers (first_name, last_name, email, phone, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $first_name, $last_name, $email, $phone, $address);
    }

    $stmt->execute();
    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $stmt = $mysqli->prepare("DELETE FROM customers WHERE id=?");
    $stmt->bind_param('i', $_GET['delete']);
    $stmt->execute();
    $stmt->close();
}

$customers = $mysqli->query("SELECT * FROM customers");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>

<body class="bg-gray-100 py-8">

    <div class="container mx-auto flex">

        
        <div class="w-96 pr-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-700">Add Customer</h2>
            <form action="save_customer.php" method="post">
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-600">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="mt-1 p-2 w-full border rounded-md transition-shadow focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-600">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="mt-1 p-2 w-full border rounded-md transition-shadow focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="text" name="email" id="email" class="mt-1 p-2 w-full border rounded-md transition-shadow focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-600">Phone</label>
                    <input type="text" name="phone" id="phone" class="mt-1 p-2 w-full border rounded-md transition-shadow focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-600">Address</label>
                    <input type="text" name="address" id="address" class="mt-1 p-2 w-full border rounded-md transition-shadow focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
                <div class="text-right">
                    <input type="submit" value="Salvar Cliente" class="py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white rounded-md transition-all transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </form>
        </div>

        <!-- Tabela -->
        <div class="flex-grow">
            <table class="min-w-full bg-white mt-8">
                <thead>
                    <tr>
                        <th class="w-1/5 px-6 py-2">First Name</th>
                        <th class="w-1/5 px-6 py-2">Last Name</th>
                        <th class="w-1/5 px-6 py-2">Email</th>
                        <th class="w-1/5 px-6 py-2">Phone</th>
                        <th class="w-1/5 px-6 py-2">Address</th>
                        <th class="w-1/12 px-6 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($customer = $customers->fetch_assoc()) : ?>
                        <tr class="hover:bg-gray-100">
                            <td class="border px-6 py-2"><?= $customer['first_name'] ?></td>
                            <td class="border px-6 py-2"><?= $customer['last_name'] ?></td>
                            <td class="border px-6 py-2"><?= $customer['email'] ?></td>
                            <td class="border px-6 py-2"><?= $customer['phone'] ?></td>
                            <td class="border px-6 py-2"><?= $customer['address'] ?></td>
                            <td class="border px-6 py-2">
                                <a href="#"><i class="fas fa-pencil-alt text-blue-500"></i></a>
                                <a href="index.php?delete=<?= $customer['id'] ?>"><i class="fas fa-trash-alt text-red-500 ml-4"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>
S