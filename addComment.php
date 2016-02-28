<!DOCTYPE html> 
<html> 
<head>
	<title>Add Comment</title>
</head>
<body>


<?php

	require 'database.php';

   
	//get productID from session
	$productID= $_GET['productID'];
	$buyerID = $_GET['buyerID'];
	//$words =  mysqli_real_escape_string($_POST['words']);
	$words = $_POST['words'];

	mysql_connect("localhost", "chenmingfei", "chenmingfei");
	mysql_select_db ("module8");
	$sql = "INSERT INTO comments(productID,buyerID,words)VALUES('{$productID}','{$buyerID}','{$words}')";

    $current_id = mysql_query($sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysql_error());

	// If all the text forms are input and submitted, go back to homepage, otherwise, stays on editing page
	if($_POST['words'])
	{
	 header("Location: myCart.php?buyerID=$buyerID");
	}

?>

<!--form for editing the product contents, author name, and Number-->
<form method="post" action="#"> 
    Give your comment: <textarea name="words" id="words" cols="50" rows="5" > </textarea><br />
	<input type="Submit" name="submit" id="submit" value="Comment!">
</form>

</body>		
</html>