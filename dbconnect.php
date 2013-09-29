<?php
$con = mysqli_connect("localhost", "root", "", "pollinas");
	
$execute = mysqli_query($con, $query);
mysqli_close($con);

?>