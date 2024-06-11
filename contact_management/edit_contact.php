<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM contacts WHERE id='$id'";
    $result = $conn->query($sql);
    $contact = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE contacts SET name='$name', email='$email', phone='$phone' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: contacts.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Edit Contact</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $contact['name']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $contact['email']; ?>" required><br>
        Phone: <input type="text" name="phone" value="<?php echo $contact['phone']; ?>" required><br>
        <button type="submit">Update Contact</button>
    </form>
</body>
</html>
