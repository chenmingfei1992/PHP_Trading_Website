<html>
<body>
<!--The name of the uploaded file to store. This should correspond to the file field's name attribute in the HTML form. -->
<form method="POST" enctype="multipart/form-data">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" />
    <label for="pic">Please upload a profile picture:</label>
    <input type="file" name="pic" id="pic" />
    <input type="submit" />
</form>



<?php
error_reporting(0); //// Turn off all error reporting
//If you wanted to store the uploaded image in MongoDB, you could do the following in the script handling the form submission: 
$m = new MongoClient();
$gridfs = $m->selectDB('test')->getGridFS();

$gridfs->storeUpload('pic', array('username' => $_POST['username']));
echo 'File Uploaded Successfully';

?>

</body>

	</html>