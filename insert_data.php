<html>
<head>
<title> Checking Data</title>
</head>

<body>

<?php
	 $hid = trim($_POST['hid']);
	 $text1 = urldecode($_POST['text1']);
	//// echo $text1+" text";
	 //print_r($hid); 
         
    require_once('mysqli_connect.php');
      	
     $query = "INSERT INTO thread(sid,hid,title) VALUES(?,?,?)";
	 $stmt = mysqli_prepare($dbc,$query);
     $sid='800903743';
     mysqli_stmt_bind_param($stmt,"sss",$sid,$hid,$text1);
     $status=mysqli_stmt_execute($stmt);                 			
?>
</body>
</html>