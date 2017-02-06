<html>
<head>
<title> Checking Data</title>
</head>

<body>

<?php
	 $sname = trim($_POST['sname']);
	 $sid = trim($_POST['sid']);
	 $major = trim($_POST['major']);
     $degree= trim($_POST['degree']);   
	 $uname = trim($_POST['uname']);
	 $pass = $_POST['pass'];
	 
	 require_once('mysqli_connect.php');
			
     $query = "INSERT INTO student(sid,sname,degree,specialization,username,password) VALUES(?,?,?,?,?,?)";
	 $stmt = mysqli_prepare($dbc,$query);
     mysqli_stmt_bind_param($stmt,"isiiss", $sid,$sname,$degree,$major,$uname,$pass);
     mysqli_stmt_execute($stmt);
     $affected_rows = mysqli_stmt_affected_rows($stmt);
     		
     if($affected_rows == 1)
     {
      	  echo 'Student Data Entered';
      	  mysqli_stmt_close($stmt);
       	  mysqli_close($dbc);
      }
      else
      {
      		echo 'Error occurred';
        	echo mysqli_error($stmt);
        	mysqli_stmt_close($stmt);
        	mysqli_close($dbc);
      }                  			
		
?>
</body>
</html>