<!DOCTYPE html> 
<html> 
<head>
	<title> delete products</title>
</head>
<body>
	



<?php
require_once 'database.php';

// get productID from session
$productID= $_GET['productID'];
$buyerID = $_GET['buyerID'];


//send the query to delete product from database
$stmt = $mysqli->prepare("delete from cart where boughtID=?");
if(!$stmt){printf("Query fail: $mysqli->error");exit;}
//use productID as parameter
$stmt->bind_param('i',$productID );
$stmt->execute();
$stmt->close();
header("Location: myCart.php?buyerID=$buyerID");

?>
</body>		
</html>