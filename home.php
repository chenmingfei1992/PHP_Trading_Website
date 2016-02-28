<!DOCTYPE html>
<html>
<head> 

	  <link rel="stylesheet" type="text/css" media="all" href="style.css">
<SCRIPT type="text/javascript" language="javascript"></SCRIPT>


<script src="counting.js"></script>

	<title> eBay</title>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_CN/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



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
echo "<a href='./logOut.php'>  Log Out </a> ";

}
elseif(isset($_SESSION['buyerID']))
{   
	$buyerID = $_SESSION['buyerID'];
	$buyerName = $_SESSION['buyerName'];
	echo $buyerName;
	echo "<a href=\"./myCart.php?buyerID=$buyerID\">My account\n\n</a>";
	echo "<a href='./logOut.php'>  Log Out </a> ";
}
else
{
   
echo "<a href=\"./preLogin.php\">Login\n\n</a>";
echo "<a href=\"./preLogin.php\">Register\n\n</a>";

}


?>
<br>
<h1>weclome to my mini-eBay</h1>
<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count"></div>
            <!-- <canvas id="canvas" width="200" height="200"></canvas> -->
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

<?php

$c1 = "Motors";
$c2 = "Fashion";
$c3 = "Electronics";
$c4 = "Art";
$c5 = "Home";
$c6 = "Sporting";
$c7 = "Toys";
$c8 = "Gifts";

echo "<a href=\"./category.php?category=$c1\">Motors</a>";
echo  "&nbsp";echo  "&nbsp";echo  "&nbsp";echo  "&nbsp";
echo "<a href=\"./category.php?category=$c2\">Fashion</a>";
echo  "&nbsp";echo  "&nbsp";echo  "&nbsp";echo  "&nbsp";
echo "<a href=\"./category.php?category=$c3\">Electronics</a>";
// echo "<a href=\"./category.php?category=$c4\">Collectibles & Art</a>";
// echo "<a href=\"./category.php?category=$c5\">Home & Garden</a>";
// echo "<a href=\"./category.php?category=$c6\">Sporting Goods</a>";
// echo "<a href=\"./category.php?category=$c7\">Toys & Hobbies</a>";
// echo "<a href=\"./category.php?category=$c8\">Deals & Gifts</a>";

?>

<br>
<br><br>

<?php
// send the query to select columns of story table
	$stmt1 = $mysqli->prepare("select productID,productName,price,imageType,imageData from products order by price limit 10");  
	if(!$stmt1){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}

	$stmt1->execute();
   $result1 = $stmt1->get_result();
 



echo "<table border=1>";
echo "<tr><th>Product</th><th>Price</th><th>Image</th></tr>";


while($row1 = $result1->fetch_assoc()){

	 $productName = $row1["productName"];
	    $productID = $row1["productID"];
	    $price = $row1["price"];
if($price!=0)
{
echo "<tr><td>"."<a href=\"./showProduct.php?productID=$productID\">$productName\n\n</a>"."</td><td>"."US dollars:   ".$price."</td><td>".'<img src="data:image/jpeg;base64,' . base64_encode($row1['imageData']) . '" width="400" height="300">'."</td></tr>";
//echo "<tr><td class="$class">" . $productName . "</td><td class="$class">" . $row1["price"] . "</td><td class="$class">".$productName. "</td></tr>";
//echo "<tr><td class="$class">" . $row["productName"] . "</td><td class="$class">" . $row["price"] ."</td><td class="$class">" . $productName . "</td></tr>";
}
}

echo "</table>";




    // while($row1 = $result1->fetch_assoc()){

	    // header("Content-type: ". $row["imageType"]);
     //    echo $row["imageData"];
	   //  echo '<dt><strong>Technician Image:</strong></dt><dd>'. '<img src="data:image/jpeg;base64,' . base64_encode($row1['imageData']) . '" width="100" height="100">'. '</dd>';
	   //  $productName = $row1["productName"];
	   //  $productID = $row1["productID"];
	   //  $price = $row1["price"];
	   //  echo "<a href=\"./showProduct.php?productID=$productID\">$productName\n\n</a>";
	   // echo $price;
	  

           
        // }

 



?>

</body>
</html>