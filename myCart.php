<!DOCTYPE html>
<head>
	<script src="clockScript.js"></script>
	
	  <link rel="stylesheet" type="text/css" media="all" href="style.css">
</head>
<body>
<?php

echo "<a href='./home.php?'> Home Page </a> ";

?>
	
<canvas id="canvas" width="200" height="200"></canvas>
<audio controls>

  <source src="IamYours.mp3" type="audio/mpeg">

</audio>
<br>
<br>

<?php
	require 'database.php';
	
	$buyerID=$_GET['buyerID'];
	

   $stmt2 = $mysqli->prepare("select buyerName,buyerAccount from buyer where buyerID = ?");  
	if(!$stmt2){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// use productID as parameter
	$stmt2->bind_param('i', $buyerID);
	$stmt2->execute();
	//story the information from database into variables
	$stmt2->bind_result($buyerName,$buyerAccount);
	$stmt2->fetch();
	$stmt2->close();


	printf("<br> buyerID:  %s", $buyerID);
	 printf("Current Account:  %s", $buyerAccount);
	 echo "<br>";echo "<br>";


$stmt = $mysqli->prepare("select boughtID from cart where buyerID = ?");  
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// use productID as parameter
	$stmt->bind_param('i', $buyerID);
	$stmt->execute();

   $result = $stmt->get_result();
 

while($row = $result->fetch_assoc()){

    $productID = $row["boughtID"];

   $stmt0 = $mysqli->prepare("select status from cart where boughtID = ?");  
	if(!$stmt0){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// use productID as parameter
	$stmt0->bind_param('i', $productID);
	$stmt0->execute();
	//story the information from database into variables
	$stmt0->bind_result($status);
	$stmt0->fetch();
	$stmt0->close();




	// send the query to select columns of story table
	$stmt1 = $mysqli->prepare("select productName,productNumber,productOwner,category,price,soldCount,productDescription,imageType,imageData from products where productID = ?");  
	if(!$stmt1){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	// use productID as parameter
	$stmt1->bind_param('i', $productID);
	$stmt1->execute();
   $result1 = $stmt1->get_result();
 

    while($row1 = $result1->fetch_assoc()){

	    // header("Content-type: ". $row["imageType"]);
     //    echo $row["imageData"];
	    echo '<dt><strong>Technician Image:</strong></dt><dd>'. '<img src="data:image/jpeg;base64,' . base64_encode($row1['imageData']) . '" width="50" height="50">'. '</dd>';
	    printf("<br> Name:  %s <br>", $row1["productName"]);
	    printf(" Price:  %s", $row1["price"]);
	    printf(" category:  %s", $row1["category"]);
	    printf(" sold out:  %s", $row1["soldCount"]);
	    printf("<br> Description:  %s", $row1["productDescription"]);
        echo "<br>";

	    $stmt3 = $mysqli->prepare("select id,buyerID,words from comments where productID = ?");  
	    if(!$stmt3){
		  printf("Query Prep Failed: %s\n", $mysqli->error);
		  exit;
	    }
	    // use productID as parameter
	    $stmt3->bind_param('i', $productID);
	    $stmt3->execute();
        $result3 = $stmt3->get_result();
 

        while($row3 = $result3->fetch_assoc()){
           $getBuyerID= $row3["buyerID"];
           $commentID= $row3["id"];
           if($row3["words"])
           {
           printf(" comment:  %s", $row3["words"]);
           echo "<br>";
           if($getBuyerID==$buyerID)
           {
           	echo "<a href='./editComment.php?commentID=$commentID&buyerID=$buyerID'> Edit </a> ";
           	echo "<a href='./deleteComment.php?commentID=$commentID&buyerID=$buyerID'> Delete </a> ";
           	echo "<br>";
           }
           }
           
        }


        echo "<br>"."status: ";
	    if($status=="paid")
	      {
	       	echo "paid";
             
            echo "<a href='./addComment.php?productID=$productID&buyerID=$buyerID'> Give A Comment </a> ";
            // echo "<a href='./editComment.php?productID=$productID&buyerID=$buyerID'> Edit Comment </a> ";
            // echo "<a href='./removeComment.php?productID=$productID&buyerID=$buyerID'> Remove My Comment </a> ";

	      }
	    else
	    	{echo "Not paid";}
	    //header("Content-type: " .$imageType);
	    //header("Content-type: " . $row["imageType"]);
        //echo $imageData;
        
		echo "<br>";
		echo "<a href='./checkOut.php?productID=$productID&buyerAccount=$buyerAccount&buyerID=$buyerID'>  check out </a> ";
		echo "<a href='./removeFromCart.php?productID=$productID'>  remove from cart</a> ";
		echo "<br>";
      }  



	  $stmt1->fetch();
	    $stmt1->close();
}

        $stmt->fetch();
	    $stmt->close();


?>







</body>
</html>