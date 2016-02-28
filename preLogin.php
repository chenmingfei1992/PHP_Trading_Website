<!doctype html>
<html lang="en">
<head>
 

  <link rel="stylesheet" type="text/css" media="all" href="style.css">
  <title> log in</title>

</head>

<body>

	<section id="container">
		
	    Sign in
		<form name="hongkiat" id="hongkiat-form" method="post" action = "check.php">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<input type="text" name="username" id="username" placeholder="Your name" autocomplete="off" tabindex="1" class="txtinput">
		
			<input type="password" name="password" id="password" placeholder="Your password" autocomplete="off" tabindex="2" class="txtinput">

			<input type="checkbox" name="userType" value="buyer">I'm a customer
            <input type="checkbox" name="userType" value="seller">I'm a seller
		
			</section>
			
			
		</div>


		<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
			<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Login in!">
			<br style="clear:both;">
		</section>
		</form>


	</section>






	<section id="container">
		
	   <section id="container">
		
	    Sign up
		<form name="hongkiat" id="hongkiat-form" method="post" action = "register.php">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<input type="text" name="regName" id="regName" placeholder="Your name" autocomplete="off" tabindex="1" class="txtinput">
		
			<input type="password" name="regPass" id="regPass" placeholder="Your password" autocomplete="off" tabindex="2" class="txtinput">

			<input type = "number" name="account" id="account" placeholder="initial account" autocomplete="off" tabindex="3" class="txtinput">
			<input type="checkbox" name="userType" value="buyer">I want to buy
            <input type="checkbox" name="userType" value="seller">I want to sell
		
			
			
		</div>


		<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
			<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="sign up!">
			<br style="clear:both;">
		</section>
		</form>

		
	</section>
	<form action = "home.php" method = "Post">
	<input type = "submit" value = "Directly Get In"/><br>
</form>

</body>
</html>