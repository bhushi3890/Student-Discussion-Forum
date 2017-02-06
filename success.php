<html>
<head>
<title> Please Login</title>
</head>

<body>

<?php

	if(isset($_POST['submit']))
	{
		$data_missing=NULL;
		
		if(empty($_POST['uname']))
		{
			$data_missing='1';
		}
		else
		{
			$uname = $_POST['uname'];
		}
		
		if(empty($_POST['pass']))
		{
				$data_missing= $data_missing . '2';
		}
		else
		{
			$pass = $_POST['pass'];
		}
		
		if(!isset($data_missing))
		{
			require_once('mysqli_connect.php');			
			$query = "SELECT sid,sname from student WHERE username= '$uname' AND password='$pass'";
			$result = mysqli_query($dbc,$query);
			$count = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result);
			if($count == 1)
			{
				session_start();
                $_SESSION["sid"]=$row['0'];
				mysqli_close($dbc);                
				header("Location: http://localhost/db/wall.php");
			}
			else
			{
				mysqli_close($dbc);	
				header("Location: http://localhost/db/login.php?error=yes");		
			}
		}
		else
		{
			$redirectTo="Location: http://localhost/db/login.php?missing=" . $data_missing;
			header($redirectTo);
			
		}
	}
?>

</body>
</html>
	