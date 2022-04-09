<?php 
include 'config.php';
 
$username = $_POST['username'];
$password = $_POST['password'];
 

$sql = "select * from user_ where username='$username' and password='$password'";
$result = $conn->query($sql);
 
if($cek > 0){
	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("admin/index.php");
}else{
	header("index.php");	
}
 
?>