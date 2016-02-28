

<html>
<head></head>

<body>




</form>

<?php
require 'database.php';
$productName = $mysqli->real_escape_string($_POST['productName']);
$productNumber = $mysqli->real_escape_string($_POST['productNumber']);
//$productOwner = $_SESSION['sellerID'];
$productOwner=$mysqli->real_escape_string($_POST['yourID']);;
$category = $mysqli->real_escape_string($_POST['category']);
$price = $mysqli->real_escape_string($_POST['price']);
$soldCount = 0;
$productDescription = $mysqli->real_escape_string($_POST['productDescription']);


mysql_connect("localhost", "chenmingfei", "chenmingfei");
mysql_select_db ("module8");
$sql = "INSERT INTO products(productName,productNumber,productOwner,category,price,soldCount,productDescription)
VALUES('{$productName}','{$productNumber}','{$productOwner}','{$category}','{$price}','{$soldCount}','{$productDescription}')";

$current_id = mysql_query($sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysql_error());
if(isset($current_id)) {


header("Location: myShop.php?productName=$productName&sellerID=$productOwner");
	
}
?>





</body>
</html>
