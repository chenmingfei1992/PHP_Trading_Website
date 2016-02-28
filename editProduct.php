<!DOCTYPE html> 
<html> 
<head>
	<title>Edit product</title>
</head>
<body>


<?php

	require 'database.php';

	//get productID from session
	$productID= $_GET['productID'];
	//send the query for selecting columns in product table
	$stmt = $mysqli->prepare("select productName,productNumber,category,price,productDescription,productOwner from products where productID = ?");  
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// user productID as parameter
	$stmt->bind_param('i', $productID);
	$stmt->execute();
	// the old information will be put into the form, waiting for the user to edit
	$stmt->bind_result( $productName,$productNumber,$category,$price,$productDescription,$sellerID);
	$stmt->fetch();
	$stmt->close();

	// the updated information input by the user after editing
	$newName = $_POST['Name'];
	$newNumber = $_POST['Number'];
	$newCate = $_POST['cate'];
	$newPrice = $_POST['price'];
	$newDescrip = $_POST['Descrip'];


	// send the query for updating the information
	$newstmt = $mysqli->prepare("update products set productName ='$newName', productNumber ='$newNumber',category='$newCate', price = '$newPrice',productDescription ='$newDescrip' where productID=?");
	if(!$newstmt)
		{
			printf("Query fail:%s\n", $mysqli->error);exit;
		}
	//use productID as parameter	
	$newstmt->bind_param('i',$productID);
	$newstmt->execute();
	$newstmt->close();
	// If all the text forms are input and submitted, go back to homepage, otherwise, stays on editing page
	if(($_POST['Name'])&&($_POST['Number'])&&($_POST['cate'])&&($_POST['price'])&&($_POST['Descrip']))
	{
	 header("Location: myShop.php?productName=$newName&sellerID=$sellerID");
	}

?>

<!--form for editing the product contents, author name, and Number-->
<form method="post" action="#"> 
	new Name:<input name="Name" id="Name" type="Text" size="50" value ="<?php echo $productName; ?>" maxlength="50"><br />
	new Number:<input name="Number" id="Number" type="Text" size="50" value ="<?php echo $productNumber; ?>" maxlength="50"><br />
	new Category:<input name="cate" id="cate" type="Text" size="50" value ="<?php echo $category; ?>" maxlength="50"><br />
	new Price:<input name="price" id="price" type="Text" size="50" value ="<?php echo $price; ?>" maxlength="50"><br />
	new Description<textarea name="Descrip" id="Descrip" cols="50" rows="5" > <?php echo $productDescription; ?> </textarea><br />
	<input type="Submit" name="submit" id="submit" value="Edit!">
</form>

</body>		
</html>