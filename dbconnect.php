<?php
$con = mysqli_connect("www.vtwebconsulting.com", "vtwebcon_weekend", "imsMay33", "vtwebcon_pollinas");
	
$execute = mysqli_query($con, $query);
mysqli_close($con);

?>