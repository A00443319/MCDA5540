<?php
function OpenCon()
 {
 $dbhost = "dbcourse.cs.smu.ca";
 $dbuser = "u45";
 $dbpass = "faceCOLD60";
 $db = "u45";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>