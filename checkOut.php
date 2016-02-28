<!DOCTYPE html> 
<html> 
<head>
	<title>Edit product</title>
	  <link rel="stylesheet" type="text/css" media="all" href="style.css">
</head>
<body>


<?php

	require 'database.php';
    
	//get productID from session
	$productID= $_GET['productID'];
	$buyerAccount= $_GET['buyerAccount'];
	$buyerID= $_GET['buyerID'];
	//send the query for selecting columns in product table
	$stmt = $mysqli->prepare("select productNumber,price,productOwner,soldCount from products where productID = ?");  
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// user productID as parameter
	$stmt->bind_param('i', $productID);
	$stmt->execute();
	// the old information will be put into the form, waiting for the user to edit
	$stmt->bind_result($productNumber,$price,$sellerID,$soldCount);
	$stmt->fetch();
	$stmt->close();

		//send the query for selecting columns in product table
	$stmt1 = $mysqli->prepare("select sellerAccount from seller where sellerID = ?");  
	if(!$stmt1){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// user productID as parameter
	$stmt1->bind_param('i', $sellerID);
	$stmt1->execute();
	// the old information will be put into the form, waiting for the user to edit
	$stmt1->bind_result($sellerAccount);
	$stmt1->fetch();
	$stmt1->close();

	$newBuyerAccount = $buyerAccount - $price;
	$newProductNumber = $productNumber-1;
	$newSellerAccount = $sellerAccount + $price;
	$newSoldCount = $soldCount+1;


	// send the query for updating the information
	$stmt2 = $mysqli->prepare("update products set productNumber ='$newProductNumber',soldCount='$newSoldCount' where productID=?");
	if(!$stmt2)
		{
			printf("Query fail:%s\n", $mysqli->error);exit;
		}
	//use productID as parameter	
	$stmt2->bind_param('i',$productID);
	$stmt2->execute();
	$stmt2->close();
	

    $stmt3 = $mysqli->prepare("update seller set sellerAccount ='$newSellerAccount' where sellerID=?");
	if(!$stmt3)
		{
			printf("Query fail:%s\n", $mysqli->error);exit;
		}
	//use productID as parameter	
	$stmt3->bind_param('i',$sellerID);
	$stmt3->execute();
	$stmt3->close();

	$stmt4 = $mysqli->prepare("update buyer set buyerAccount ='$newBuyerAccount' where buyerID=?");
	if(!$stmt4)
		{
			printf("Query fail:%s\n", $mysqli->error);exit;
		}
	//use productID as parameter	
	$stmt4->bind_param('i',$buyerID);
	$stmt4->execute();
	$stmt4->close();


	// If all the text forms are input and submitted, go back to homepage, otherwise, stays on editing page
	if(($_POST['firstName'])&&($_POST['lastName'])&&($_POST['add1'])&&($_POST['phone']))
	{
       $status = "paid";
       $stmt5 = $mysqli->prepare("update cart set status ='$status' where boughtID=?");
	if(!$stmt5)
		{
			printf("Query fail:%s\n", $mysqli->error);exit;
		}
	//use productID as parameter	
	$stmt5->bind_param('i',$productID);
	$stmt5->execute();
	$stmt5->close();

	 header("Location: myCart.php?buyerID=$buyerID");
	}

?>




<section id="container">
		
	    Sign in
		<form name="hongkiat" id="hongkiat-form" method="post" action = "#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<input type="text" name="firstName" id="username" placeholder="First Name" autocomplete="off" tabindex="1" class="txtinput">
			<input type="text" name="lastName" id="username" placeholder="Last Name" autocomplete="off" tabindex="2" class="txtinput">
			<input type="text" name="add1" id="address" placeholder="Address" autocomplete="off" tabindex="3" class="txtinput">
			<input type="text" name="phone" id="telephone" placeholder="Telephone" autocomplete="off" tabindex="4" class="txtinput">
		
		
			</section>
			
			
		</div>


		<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
			<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="confirm check out">
			<br style="clear:both;">
		</section>
		</form>


	</section>

</body>		
</html>