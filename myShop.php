<!DOCTYPE html>
<head>

	  <link rel="stylesheet" type="text/css" media="all" href="style.css">
	<script src="clockScript.js"></script>
</head>
<body>

	
<canvas id="canvas" width="200" height="200"></canvas><br>
<br>


<?php

echo "<a href='./home.php?'> Home Page </a> ";

?>


<?php




	require 'database.php';
	
	$sellerID=$_GET['sellerID'];
	$newName=$_GET['productName'];
	echo $newName+"jdeodeode";

   $stmt2 = $mysqli->prepare("select sellerName,sellerAccount from seller where sellerID = ?");  
	if(!$stmt2){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// use productID as parameter
	$stmt2->bind_param('i', $sellerID);
	$stmt2->execute();
	//story the information from database into variables
	$stmt2->bind_result($sellerName,$sellerAccount);
	$stmt2->fetch();
	$stmt2->close();


	printf("<br> SellerID:  %s", $sellerID);
	 printf("Current Account:  %s", $sellerAccount);
	 echo "<br>";echo "<br>";


	// send the query to select columns of story table
	$stmt = $mysqli->prepare("select productID,productName,productNumber,productOwner,category,price,soldCount,productDescription,imageType,imageData from products where productOwner = ?");  
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// use productID as parameter
	$stmt->bind_param('i', $sellerID);
	$stmt->execute();

   $result = $stmt->get_result();
 
echo "<ul>\n";
while($row = $result->fetch_assoc()){

	    // header("Content-type: ". $row["imageType"]);
     //    echo $row["imageData"];
	 echo '<dt><strong>Technician Image:</strong></dt><dd>'. '<img src="data:image/jpeg;base64,' . base64_encode($row['imageData']) . '" width="150" height="150">'. '</dd>';
	    $productID = $row["productID"];
	    printf("<br> product ID:  %s <br>", $row["productID"]);
	    printf("<br> Name:  %s <br>", $row["productName"]);
	    printf(" Price:  %s", $row["price"]);
	    printf(" category:  %s", $row["category"]);
	    printf(" sold out:  %s", $row["soldCount"]);
	    printf("<br> Description:  %s", $row["productDescription"]);
	    //header("Content-type: " .$imageType);
	    //header("Content-type: " . $row["imageType"]);
        //echo $imageData;
        
		//$productID = $row["productID"];
		echo "<br>";
		echo "<a href='./editProduct.php?productID=$productID'>  edit  </a> ";
		echo "<a href='./deleteProduct.php?productID=$productID'>  delete </a> ";
		echo "<br>";
}

echo "</ul>\n";


	$stmt->fetch();
	$stmt->close();

	


?>


<?php
if(count($_FILES) > 0) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
mysql_connect("localhost", "chenmingfei", "chenmingfei");
mysql_select_db ("module8");
$imgData =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
$updateID= $_POST['productID'];
// $sql = "INSERT INTO output_images(imageType ,imageData)
// VALUES('{$imageProperties['mime']}', '{$imgData}')";

//$sql = "UPDATE products SET imageType='{$imageProperties['mime']}',imageData ='{$imgData}' where productOwner = '$sellerID' and productName ='$newName'";
$sql = "UPDATE products SET imageType='{$imageProperties['mime']}',imageData ='{$imgData}' where productID = '$updateID'";

$current_id = mysql_query($sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysql_error());


if(isset($current_id)) {
header("Location: myShop.php?sellerID =$sellerID ");
}}}
?>





<form action = "addProduct.php" method = "Post">
<input type = "text" name="yourID" placeholder="yourID"/>
<input type = "text" name="productName" placeholder="productName"/>
<select name="category">
<option value="Motors">Motors</option>
<option value="Fashion">Fashion</option>
<option value="Electronics">Electronics</option>
<option value="Art">Collectibles and Art</option>
<option value="Home">Home and Garden</option>
<option value="Sporting">Sporting</option>
<option value="Toys">Toys and Hobbies</option>
<option value="Gifts">Deals and Gifts</option>
</select>
<input type = "text" name="productNumber" placeholder="productNumber"/>
<input type = "text" name="price" placeholder="price"/><br>
Description:<br> <textarea name="productDescription" id="productDescription" cols="50" rows="5" >  </textarea><br />

<br>
	<input type = "submit" value = "add!"/>
</form>

<form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">
<label>Upload Image File:</label><br/>
<input name="userImage" type="file" class="inputFile" />
<input type = "text" name="productID" placeholder="product id"/><br>
<input type="submit" value="Submit" class="btnSubmit" />


</body>
</html>