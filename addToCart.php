

<html>
<head></head>

<body>




</form>

<?php
require 'database.php';
session_start();
if(isset($_SESSION['buyerID']))
{   

$buyerID = $_SESSION['buyerID'];
$productID=$_GET['productID'];
$status = "notPaid";


mysql_connect("localhost", "chenmingfei", "chenmingfei");
mysql_select_db ("module8");
$sql = "INSERT INTO cart(buyerID,boughtID,status) VALUES('{$buyerID}','{$productID}','{$status}')";

$current_id = mysql_query($sql) or die("<b>Error:</b> Problem on Insert<br/>" . mysql_error());
if(isset($current_id)) 
{
header("Location: myCart.php?buyerID=$buyerID");	
}


}


else
{

header("Location: preLogin.php?");

}


?>





</body>
</html>
