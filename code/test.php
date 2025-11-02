<?php
include 'config.php';  // connects to students_db

if($conn){
    echo "✅ Database connected successfully!";
} else {
    echo "❌ Connection failed: " . mysqli_connect_error();
}
?>
