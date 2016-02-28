<?php
// Connect to Mongo and set DB and Collection
//$mongo = new Mongo();
$m = new MongoClient();
// $db = $mongo->myfiles;     

// // GridFS
// $gridFS = $db->getGridFS();     
$gridfs = $m->selectDB('test')->getGridFS();

// Find image to stream
$image = $gridfs->findOne("1.jpg");

// Stream image to browser
header('Content-type: image/jpeg');
echo $image->getBytes();

?>