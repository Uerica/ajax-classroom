<?php 
session_start();
if( isset($_SESSION["memId"]) == true){
	echo $_SESSION["memName"];
}else{
	echo "notLogin";
}	
 ?>
