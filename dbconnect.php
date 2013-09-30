<?php
$con = mysqli_connect("50.31.162.18", "vtwebcon_weekend", "imsMay33", "vtwebcon_pollinas");
	
$execute = mysqli_query($con, $query);
mysqli_close($con);

?>