<?php 
echo 'this works';

$statement = "SELECT id FROM images WHERE id=1";

include('dbconnect.php');

$row = mysqli_fetch_assoc($execute);

echo $row['id'];

?>