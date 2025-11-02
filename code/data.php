<?php
include 'config.php';
?>
<?php
$data=$_GET['data'];
$sql="SELECT * FROM students WHERE id='$data'";
$result=mysqli_query($conn,$sql);
if(!$result){
    die("❌ Error: ". mysqli_error($conn));
}else{
$row=mysqli_fetch_assoc($result);
echo "<h2>Hello, {$row['name']}</h2>";

echo json_encode($row);

}
?>