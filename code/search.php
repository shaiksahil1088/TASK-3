<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search data</title>
<style>
body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f4f9; padding:20px; }
table { border-collapse: collapse; width: 80%; margin: 20px auto; background: #fff; border-radius:10px; overflow:hidden; }
th, td { padding:12px 20px; text-align:left; }
th { background:#6c63ff; color:white; }
tr:nth-child(even) { background:#f2f2f2; }
a.edit, a.delete { padding:6px 12px; margin:2px; border-radius:5px; cursor:pointer; color:white; text-decoration:none; }
a.edit { background:#00b894; }
a.delete { background:#d63031; }
</style>
</head>
<body>

<form method="POST" action="search.php" style="text-align:center; margin-bottom:20px;">
    <input type="text" name="search" placeholder="Search by name, email, or phone" style="padding:10px; width:300px; border-radius:5px; border:1px solid #ccc;">
    <button type="submit" name="submit" style="padding:10px 15px; background:#6c63ff; color:white; border:none; border-radius:5px; cursor:pointer;">Search</button>
</form>

<?php
if(isset($_POST['submit'])){
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $result = mysqli_query($conn, "SELECT * FROM students WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'");
}
?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>

<?php
if(isset($result)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><a href="data.php?data=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
<?php 
        }
    } else {
        echo "<tr><td colspan='5' style='text-align:center;'>No results found</td></tr>";
    }
}
?>

</table>

</body>
</html>
