
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>product details</title>

<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery.imagezoom.min.js"></script>
<style type="text/css">
h1 {
    position: absolute;
    left: 100px;
    top: 150px;
}
.zoomDiv{z-index:999;position:absolute;top:0px;left:0px;width:200px;height:200px;background:#ffffff;border:1px solid #CCCCCC;display:none;text-align:center;overflow:hidden;}
</style>
</head>

<?php

echo "<a href='./home.php?'> Home Page </a> ";

?>
	

<?php
	require 'database.php';
	
	$productID=$_GET['productID'];

   $stmt = $mysqli->prepare("select productName,productNumber,productOwner,category,price,soldCount,productDescription,imageType,imageData from products where productID = ?");  
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// use productID as parameter
	$stmt->bind_param('i', $productID);
	$stmt->execute();

   $result = $stmt->get_result();
 
echo "<ul>\n";
while($row = $result->fetch_assoc()){
     
   



	 echo "<h1>".'<dt><strong>Technician Image:</strong></dt><dd>'. '<img src="data:image/jpeg;base64,' . base64_encode($row['imageData']) . '" width="200" height="200" rel="data:image/jpeg;base64,' . base64_encode($row['imageData']) . '" width="200" height="200" class="jqzoom">'. '</dd>'."</h1>";
	    printf("<br> Name:  %s <br>", $row["productName"]);
	    printf(" Price:  %s", $row["price"]);
	    printf(" category:  %s", $row["category"]);
	    printf(" sold out:  %s", $row["soldCount"]);
	    printf("<br> Description:  %s", $row["productDescription"]);
	    echo "<br>";

		$sellerID = $row["productOwner"];

       	$stmt2 = $mysqli->prepare("select sellerName from seller where sellerID = ?");  
	if(!$stmt2){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// use productID as parameter
	$stmt2->bind_param('i', $sellerID);
	$stmt2->execute();
	//story the information from database into variables
	$stmt2->bind_result($sellerName);
	$stmt2->fetch();
	$stmt2->close();

	  printf(" Seller:  %s", $sellerName);
	  echo "<br>";

		echo "<a href='./addToCart.php?productID=$productID'>  Add To Cart </a> ";
		echo "<br>";
}

echo "</ul>\n";


	$stmt->fetch();
	$stmt->close();



?>

<script type="text/javascript">
$(document).ready(function(){

	$(".jqzoom").imagezoom();


});
</script>
</body>
</html>