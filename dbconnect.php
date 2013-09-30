<?php
$con = mysqli_connect("11.38.2.2", "vtwebcon_weekend", "imsMay33", "vtwebcon_pollinas");
	
$execute = mysqli_query($con, $query);
mysqli_close($con);

?>