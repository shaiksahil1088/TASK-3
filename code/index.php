<?php
session_start();
include 'config.php';

// Pagination settings
$limit = 5; // students per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch students for current page
$result = mysqli_query($conn, "SELECT * FROM students LIMIT $offset, $limit");

// Get total number of students
$total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students"));
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f4f9; padding:20px; }
        h2 { text-align:center; color:#333; }
        table { border-collapse: collapse; width: 80%; margin: 20px auto; box-shadow: 0 5px 15px rgba(0,0,0,0.1); background: #fff; border-radius:10px; overflow:hidden; }
        th, td { padding:12px 20px; text-align:left; }
        th { background:#6c63ff; color:white; }
        tr:nth-child(even) { background:#f2f2f2; }
        a.button { padding:6px 12px; margin:2px; border:none; border-radius:5px; cursor:pointer; color:white; text-decoration:none; display:inline-block; }
        a.edit { background:#00b894; }
        a.delete { background:#d63031; }
        .add-student { display:block; width:150px; margin:20px auto; background:#6c63ff; text-align:center; padding:10px; border-radius:5px; color:white; text-decoration:none; }
        p.message { text-align:center; font-weight:bold; color:green; }
        .pagination { text-align:center; margin-top:20px; }
        .pagination a, .pagination span { margin: 0 5px; padding: 6px 12px; border-radius:5px; background:#6c63ff; color:white; text-decoration:none; }
        .pagination span.current { background:#00b894; }
        .search-student{
            display:block; width:150px; margin:20px auto; background:#6c63ff; text-align:center; padding:10px; border-radius:5px; color:white; text-decoration:none;
        }
    </style>
</head>
<body>

<h2>Student Records</h2>

<?php
// Show session message if exists
if(isset($_SESSION['success'])){
    echo "<p class='message'>{$_SESSION['success']}</p>";
    unset($_SESSION['success']);
}
?>

<a href="create.php" class="add-student">+ Add New Student</a>
<a href="search.php" class="search-student">serch</a>

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
            <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
            <a href="delete.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

<!-- Pagination -->
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
