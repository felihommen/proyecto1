	<!doctype html>
<?php
include 'bd.php';
$lang = $_GET['lang'];
$bd = new bd;
?>
<html>
<head>
	<meta charset="utf-8">
	<script src="jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">	
	<title>Sports</title>
 </head>
<body>	
 
	<div>
		
        <?php 
        echo $lang.'<br/>'; 
        $bd->getSports();
        ?> 
        
	</div>
</body>
</html>