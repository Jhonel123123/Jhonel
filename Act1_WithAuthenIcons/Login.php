<?php
session_start();
include 'Konek.php';


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}


if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "Stp[";
    }
}


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: Login.php");
    exit();
}


if (!isset($_SESSION['user_id'])) {
?>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        a {
            display: block;
            margin-top: 10px;
        }
    </style>
    <div class="card">
        <h2><i class="fas fa-sign-in-alt"></i> Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>
        <a href="?register=true"><i class="fas fa-user-plus"></i> Register</a>
    </div>
    
    <?php if (isset($_GET['register'])): ?>
    <div class="card">
        <h2><i class="fas fa-user-plus"></i> Register</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register"><i class="fas fa-user-check"></i> Register</button>
        </form>
        <a href="Login.php"><i class="fas fa-arrow-left"></i> Back to Login</a>
    </div>
    <?php endif; ?>
<?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jhonel Bandiola - Authenticated</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="Login.php?logout=true" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>

    <h2><i class="fas fa-database"></i> CRUD App with Authentication</h2>
    <form action="create.php" method="POST">
        <input type="text" name="name" placeholder="Your name?" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <button type="submit"><i class="fas fa-plus"></i> Add Item</button>
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
