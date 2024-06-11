<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$sql = "SELECT * FROM contacts WHERE user_id=" . $_SESSION['user_id'];
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Contact Management System</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="contacts.php">Manage Contacts</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <h2>Dashboard</h2>
        <a href="add_contact.php"><button class="add">Add Contact</button></a>
        <h3>Contacts</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td>
                    <a href="edit_contact.php?id=<?php echo $row['id']; ?>"><button class="edit">Edit</button></a>
                    <a href="delete_contact.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this contact?');"><button class="delete">Delete</button></a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
