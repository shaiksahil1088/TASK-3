<?php
session_start();  // start session at the top
include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO students (name, email, phone) VALUES ('$name','$email','$phone')";
    
    if(mysqli_query($conn, $sql)){
        // Set session message
        $_SESSION['success'] = "✅ Student added successfully!";
        // Redirect to the same page to avoid form resubmission
        header("Location: create.php");
        exit;
    } else {
        $error = "❌ Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f4f9;
        padding: 20px;
    }
    h2 {
        color: #333;
        text-align: center;
    }
    form {
        width: 50%;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    input[type="text"], input[type="email"] {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    button {
        background: #6c63ff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    p.message {
        text-align: center;
        font-weight: bold;
        color: green;
    }
    p.error {
        text-align: center;
        font-weight: bold;
        color: red;
    }
    </style>
</head>
<body>

<h2>Add New Student</h2>

<?php
// Display success message if set
if(isset($_SESSION['success'])){
    echo "<p class='message'>{$_SESSION['success']}</p>";
    unset($_SESSION['success']); // remove it immediately so it shows only once
}

// Display error if set
if(isset($error)){
    echo "<p class='error'>{$error}</p>";
}
?>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Phone: <input type="text" name="phone" required><br><br>
    <button type="submit" name="submit">Add Student</button>
    <a href="index.php" style="margin-left:20px; color:#6c63ff;">Back to List</a>
</form>

</body>
</html>

