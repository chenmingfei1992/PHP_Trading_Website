<?php
 include "mongoAutoHelper.php";
require 'database.php';
// Get input username and password for registeration
$regPass = $_POST['regPass'];
$regName= $_POST['regName'];
$userType = $_POST['userType'];
$initialMoney = $_POST['account'];
// encrypt the passaword
$cryPass = crypt($regPass, '$1$asdf$');

if($userType =='seller')
{
$stmt = $mysqli->prepare("insert into seller(sellerName, sellerPassword,sellerAccount) values (?, ?,?)");
}
elseif ($userType =='buyer')
{
$stmt = $mysqli->prepare("insert into buyer (buyerName, buyerPassword,buyerAccount) values (?, ?,?)");
}


if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

// Use input username and encrypted password as parameters 
$stmt->bind_param('sss', $regName, $cryPass,$initialMoney);
//Insert the data into database
$stmt->execute();
$stmt->close();


$mongo = new MongoClient();

if($userType =='seller')

{
  $curDB = $mongo->selectCollection('test', 'sellerIDTable');     //test库中的ids表  

$seller = $mongo->selectCollection('test', 'seller');      //test库中的users表  

$id = getNextId($curDB,'userid',array('init'=>1,'step'=>1)); 
$obj = array("_id"=>$id,"sellerName"=>$regName,"sellerPassword"=>$cryPass,"sellerAccount"=>$initialMoney);  
  $seller->insert($obj);   //插入数据 
  echo $initialMoney;
   echo "Document inserted successfully";
}  

else if ($userType =='buyer')

{
  $curDB = $mongo->selectCollection('test', 'buyerIDTable');     //test库中的ids表  

$buyer = $mongo->selectCollection('test', 'buyer');      //test库中的users表  

$id = getNextId($curDB,'userid',array('init'=>1,'step'=>1)); 
$obj = array("_id"=>$id,"buyerName"=>$regName,"buyerPassword"=>$cryPass,"buyerAccount"=>$initialMoney);  
  $buyer->insert($obj);   //插入数据 
   
}  

header("Location: ./preLogin.php");

?>