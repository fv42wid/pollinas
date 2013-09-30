<?php
$con = mysqli_connect("localhost", "root", "", "weekendref");
	
$execute = mysqli_query($con, $query);
mysqli_close($con);

?>