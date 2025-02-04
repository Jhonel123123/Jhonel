<?php include 'Konek.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jhonel Bandiola</title>
    <link rel="stylesheet" href="styles.css">
   

<body>
    <h2>A very very very simple Describe yourself Crude nga app</h2>
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
                    <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

