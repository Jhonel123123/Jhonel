<?php include 'Konek.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jhonel Bandiola</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<body>
    <h2>A very very very simple Describe yourself Crude nga app</h2>
    <a href="Login.php?logout=true" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    <form action="create.php" method="POST">
        <input type="text" name="name" placeholder="your name good sir?" required>
        <textarea name="description" placeholder="Description" required></textarea>

        <button type="submit">Add Item</button>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM items";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                <a href="update.php?id=<?php echo $row['id']; ?>" class="edit"><i class="fas fa-edit"></i></a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure?');"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

