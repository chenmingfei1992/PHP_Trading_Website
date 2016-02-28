<!DOCTYPE html>
<html>
<head> 

	  <link rel="stylesheet" type="text/css" media="all" href="style.css">
	<title> eBay</title>
</head>

<body>


  <br><br>       

<span id="ad" > Advertisement: 80% discount</span><br>
<span id="countdownie"  background: "#b2f" ></span><br>

<video width="320" height="240" controls>
  <source src="audiNew.mp4" type="video/mp4">
</video>
<video width="320" height="240" controls>
  <source src="Gucci.mp4" type="video/mp4">
</video>
<video width="320" height="240" controls>
  <source src="iwatchAd.mp4" type="video/mp4">
</video>
<br>


<br>
<?php // connect to database
	require 'database.php'; // Get the username from session 
	
?>
<br>

<?php
session_start();
if(isset($_SESSION['sellerID']))
{   
	$sellerID = $_SESSION['sellerID'];
	$sellerName = $_SESSION['sellerName'];
	echo $sellerName;
	echo "<a href=\"./myShop.php?sellerID=$sellerID\">My shop\n\n</a>";
}
elseif(isset($_SESSION['buyerID']))
{   
	$buyerID = $_SESSION['buyerID'];
	$buyerName = $_SESSION['buyerName'];
	echo $buyerName;
	echo "<a href=\"./myCart.php?buyerID=$buyerID\">My account\n\n</a>";
}
else
{
   
echo "<h1>"."<a href=\"./preLogin.php\">Login\n\n</a>"."</h1>";
echo "<a href=\"./preLogin.php\">Register\n\n</a>";

}


?>
<?php

echo "<a href='./home.php?'> Home Page </a> ";

?>
<br>


<br>
<br><br>

<form method="post" action="#"> 
<input type="Submit" name="submit" id="submit" value="ByPrice">
</form>
<br>
<?php
// send the query to select columns of story table

   $category = $_GET['category'];

    if ($_POST['submit'])
    {
    	$stmt1 = $mysqli->prepare("select productID,productName,price,imageType,imageData from products order by price desc ");
    }
     
     else
     {
	$stmt1 = $mysqli->prepare("select productID,productName,price,imageType,imageData from products where category= ? ");

   }
	if(!$stmt1){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt1->bind_param('s', $category);
	$stmt1->execute();
   $result1 = $stmt1->get_result();
 

    // while($row1 = $result1->fetch_assoc()){

	   //  // header("Content-type: ". $row["imageType"]);
    //  //    echo $row["imageData"];
	   //  echo '<dt><strong>Technician Image:</strong></dt><dd>'. '<img src="data:image/jpeg;base64,' . base64_encode($row1['imageData']) . '" width="50" height="50">'. '</dd>';
	   // $productName = $row1["productName"];
	   // $productID = $row1["productID"];
	   //  printf(" Price:  %s", $row1["price"]);
	   //  echo "<a href=\"./showProduct.php?productID=$productID\">$productName\n\n</a>";
	     
    //     }
echo "<table border=1>";
echo "<tr><th>Product</th><th>Price</th><th>Image</th></tr>";


while($row1 = $result1->fetch_assoc()){

	 $productName = $row1["productName"];
	    $productID = $row1["productID"];
	    $price = $row1["price"];

echo "<tr><td>"."<a href=\"./showProduct.php?productID=$productID\">$productName\n\n</a>"."</td><td>"."US dollars:   ".$price."</td><td>".'<img src="data:image/jpeg;base64,' . base64_encode($row1['imageData']) . '" width="400" height="300">'."</td></tr>";

 
}


?>

</body>
</html>