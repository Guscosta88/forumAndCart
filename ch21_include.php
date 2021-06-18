<?php
function doDB() {
global $mysqli;

//connect to server and select database; you may need it
$mysqli = mysqli_connect("localhost", "ba3f14a466d6d0",
"9457db6d", "heroku_d7a77ab923d0ff8");

//if connection fails, stop script execution
 if (mysqli_connect_errno()) {
 printf("Connect failed: %s\n", mysqli_connect_error());
 exit();
}
}
?>