<?php
include 'config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    // If no id is provided, redirect back to index
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];

// safely escape it
$id = mysqli_real_escape_string($conn, $id);

$result = mysqli_query($conn, "SELECT * FROM students WHERE id='$id'");
$row = mysqli_fetch_assoc($result);
$message = "";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE students SET name='$name', email='$email', phone='$phone' WHERE id='$id'";
    if(mysqli_query($conn, $sql)){
        header("Location: index.php");
        exit;
    } else {
        $message = "❌ Error: ". mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f4f9; padding:20px; }
        form { width: 50%; margin:auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.1);}
        input[type=text], input[type=email] { width:100%; padding:10px; margin:8px 0; border-radius:5px; border:1px solid #ccc; }
        button { background:#00b894; color:white; padding:10px 15px; border:none; border-radius:5px; cursor:pointer; }
        p.message { text-align:center; font-weight:bold; color:#d63031; margin-top:10px; }
        h2 { text-align:center; color:#333; }
    </style>
</head>
<body>

<h2>Edit Student</h2>
<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
    Phone: <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br><br>
    <button type="submit" name="submit">Update Student</button>
</form>

<?php if($message != ""){ ?>
<p class="message"><?php echo $message; ?></p>
<?php } ?>

<a href="index.php" style="display:block; text-align:center; margin-top:20px; color:#6c63ff;">Back to List</a>

</body>
</html>
