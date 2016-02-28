<!DOCTYPE html> 
<html> 
<head>
	<title> delete comments</title>
</head>
<body>
	



<?php
require_once 'database.php';

// get commentID from session
$commentID= $_GET['commentID'];
$buyerID = $_GET['buyerID'];


//send the query to delete comment from database
$stmt = $mysqli->prepare("delete from comments where id=?");
if(!$stmt){printf("Query fail: $mysqli->error");exit;}
//use commentID as parameter
$stmt->bind_param('i',$commentID );
$stmt->execute();
$stmt->close();
header("Location: myCart.php?buyerID=$buyerID");

?>
</body>		
</html>