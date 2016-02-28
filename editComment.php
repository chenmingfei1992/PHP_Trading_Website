<!DOCTYPE html> 
<html> 
<head>
	<title>Edit product</title>
</head>
<body>


<?php

	require 'database.php';

	//get productID from session
	$commentID= $_GET['commentID'];
	$buyerID = $_GET['buyerID'];
	//send the query for selecting columns in product table
	$stmt = $mysqli->prepare("select words from comments where id = ?");  
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// user productID as parameter
	$stmt->bind_param('i', $commentID);
	$stmt->execute();
	// the old information will be put into the form, waiting for the user to edit
	$stmt->bind_result($words);
	$stmt->fetch();
	$stmt->close();

	// the updated information input by the user after editing
	$newWords = $_POST['words'];
	


	// send the query for updating the information
	$newstmt = $mysqli->prepare("update comments set words ='$newWords' where id=?");
	if(!$newstmt)
		{
			printf("Query fail:%s\n", $mysqli->error);exit;
		}
	//use productID as parameter	
	$newstmt->bind_param('i',$commentID);
	$newstmt->execute();
	$newstmt->close();
	// If all the text forms are input and submitted, go back to homepage, otherwise, stays on editing page
	if($_POST['words'])
	{
	 header("Location: myCart.php?buyerID=$buyerID");
	}

?>

<!--form for editing the product contents, author name, and Number-->
<form method="post" action="#"> 

	new Comment words: <br><textarea name="words" id="words" cols="50" rows="5" ><?php echo $words; ?> </textarea><br />
	<input type="Submit" name="submit" id="submit" value="Edit!">
</form>

</body>		
</html>