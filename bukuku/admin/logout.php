<?php 
session_start();
session_destroy();
header("admin/index.php");
?>