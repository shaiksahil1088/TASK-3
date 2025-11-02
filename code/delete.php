<?php
include 'config.php';

// Check if 'id' is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM students WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        // Redirect back to index after deletion
        header("Location: index.php");
        exit;
    } else {
        echo "❌ Error: " . mysqli_error($conn);
    }
} else {
    // No id provided
    echo "❌ Invalid request.";
}
?>
