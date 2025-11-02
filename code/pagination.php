

<?php
session_start();
include 'config.php';

// Pagination setup
$limit = 5; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;

// Get total number of students
$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Calculate offset
$offset = ($page - 1) * $limit;

// Fetch students for current page
$result = mysqli_query($conn, "SELECT * FROM students LIMIT $limit OFFSET $offset");
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f4f9; padding:20px; }
        h2 { text-align:center; color:#333; }
        table { border-collapse: collapse; width: 80%; margin: 20px auto; box-shadow: 0 5px 15px rgba(0,0,0,0.1); background: #fff; border-radius:10px; overflow:hidden;}
        th, td { padding:12px 20px; text-align:left; }
        th { background:#6c63ff; color:white; }
        tr:nth-child(even) { background:#f2f2f2; }
        button { padding:6px 12px; margin:2px; border:none; border-radius:5px; cursor:pointer; color:white; }
        button.edit { background:#00b894; }
        button.delete { background:#d63031; }
        a { text-decoration:none; color:white; }
        .add-student { display:block; width:150px; margin:20px auto; background:#6c63ff; text-align:center; padding:10px; border-radius:5px; color:white; }
        p.message { text-align:center; font-weight:bold; color:green; }
        .pagination { text-align:center; margin-top:20px; }
        .pagination a, .pagination span { margin: 0 5px; padding: 6px 12px; border-radius:5px; background:#6c63ff; color:white; text-decoration:none; }
        .pagination span.current { background:#00b894; }
    </style>
</head>
<body>

<h2>Student Records</h2>

<?php
if(isset($_SESSION['success'])){
    echo "<p class='message'>{$_SESSION['success']}</p>";
    unset($_SESSION['success']);
}
?>

<a href="create.php" class="add-student">+ Add New Student</a>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td>
            <button class="edit"><a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a></button>
            <button class="delete"><a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></button>
        </td>
    </tr>
    <?php } ?>
</table>

<div class="pagination">
    <?php if($page > 1){ ?>
        <a href="?page=<?php echo $page-1; ?>">« Previous</a>
    <?php } ?>

    <?php
    for($i = 1; $i <= $total_pages; $i++){
        if($i == $page){
            echo "<span class='current'>$i</span>";
        } else {
            echo "<a href='?page=$i'>$i</a>";
        }
    }
    ?>

    <?php if($page < $total_pages){ ?>
        <a href="?page=<?php echo $page+1; ?>">Next »</a>
    <?php } ?>
</div>

</body>
</html>
