<?php
$con = mysqli_connect("vtwebconsulting.com:3306", "vtwebcon_weekend", "imsMay33", "vtwebcon_pollinas");
	
$execute = mysqli_query($con, $query);
mysqli_close($con);

?>