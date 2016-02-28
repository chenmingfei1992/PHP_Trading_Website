<?php


	session_start();

	
	// connect to mysql database
	require 'database.php';

	// Get username and password from login page
	$username = $_POST['username'];
	$password = $_POST['password'];
	$userType = $_POST['userType'];
	//flag for nonuser
	
	//encrypt the input password
	$encry_password = crypt($password, '$1$asdf$');

    // prepare to select columns of database

    if($userType =='seller')
    {  
	  $stmt = $mysqli->prepare("select sellerID,sellerName, sellerPassword from seller where sellerName=?");
    }
    elseif ($userType =='buyer')
     {
	   $stmt = $mysqli->prepare("select buyerID,buyerName, buyerPassword from buyer where buyerName=?");
     }

	if(!$stmt)
		{ 
		  // If query tailed, print error message 	
          printf("Query prep failed: %s\n", $mysqli->error);
          exit;
        }
    // query with input username
	$stmt->bind_param('s',$username);
	$stmt->execute();
	//put results in variables 
	$stmt->bind_result($userID,$userName,$pwd_hash);
	$stmt->fetch();
	
	// check whether passwords match correctly
	if(crypt($password,$pwd_hash)==$pwd_hash )
	{  
	   // set the username and userID as session variable for all the php files
		if($userType=='seller')
		{
          $_SESSION['sellerID'] = $userID;
           $_SESSION['sellerName'] = $userName;
           echo "ssdde!";
           header("Location: ./home.php");
        }
        elseif($userType=='buyer')
         {
          $_SESSION['buyerID'] = $userID;
           $_SESSION['buyerName'] = $userName;
            echo "ssdde!";
           header("Location: ./home.php");
        }
       
    }
    else
    {   // if password not match, back to login page
       echo "login fail.";
       header("Location: ./preLogin.php");
    }

?>
