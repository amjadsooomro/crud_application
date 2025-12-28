<?php
include("db_conn.php"); 
$id = $_GET['id'];
// echo $id;
// die();
$query="DELETE FROM student where id = ".$id;

$res=mysqli_query($conn,$query);
// print_r($res);
// die();
if($res){
	header("location:index.php?");
 }
 else{
header("location:delet.php?"); 	
 }

 ?>