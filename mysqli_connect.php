<?php
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME','discussion');
DEFINE('DB_USER','root');
DEFINE('DB_PASSWORD','password');

$dbc =  @mysqli_connect("localhost","root","123","discussion_forum_v003") OR die('Could not connect to MySQL'. mysqli_connect_error());

?>