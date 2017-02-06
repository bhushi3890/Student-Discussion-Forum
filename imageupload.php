<?php 
require_once('mysqli_connect.php');
$_SESSION['userid']='bhushi3890';
$userid=$_SESSION['userid'];

/*if($userid){

  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 30 minutes ago
    header("Location:logout.php");
}
}*/

if(isset($_POST['status_submit']))
{
	//echo "status submit";
	$pcontent=$_POST['status'];
	$result = mysqli_query($dbc,"SELECT SID from student WHERE username = '$userid'");
	$row=mysqli_fetch_array($result);
	$row1 = $row['0'];
	
	
	mysqli_query($dbc, "INSERT INTO post(SID,TYPE) values($row1,'status')");
	$query = mysqli_query($dbc,"SELECT PID from post WHERE SID='$row1' ORDER BY PID DESC");
    $query = mysqli_fetch_array($query);
	$query = $query['0'];
	$status_upload= "INSERT INTO ptext(CONTENT,PID) values('$pcontent','$query')";
              mysqli_query($dbc,$status_upload);
			  echo "data inserted";
              header("Location:dashboard.php");
              header("Refresh: 1; url=dashboard.php");
	
	}


if(isset($_POST['image_submit'])){
	
	echo "inside image";
		
 function GetImageExtension($imagetype)
        {
          
          if(empty($imagetype))
          {
              return false;
          }
          switch($imagetype)
          {
              case 'image/bmp':
                return '.bmp';
              case 'image/gif':
                return '.gif';
              case 'image/jpeg':
                return '.jpg';
              case 'image/png':
                return '.png';
              default: return false;
          }
        }
      /*code to respond to the submission of image*/
      if(!empty($_FILES["fileUpload"]["name"]))
      {
         
          $file_name=$_FILES["fileUpload"]["name"];
          $temp_name=$_FILES["fileUpload"]["tmp_name"];
          $imgtype=$_FILES["fileUpload"]["type"];
          $ext= GetImageExtension($imgtype);
          $imagename=uniqid().$ext;
          $target_path = "posts/".$imagename;
          //echo $imagename;
          
          
          if(move_uploaded_file($temp_name,$target_path))
          {
			  $title=$_POST['image_title'];
			  $post = mysqli_query($dbc,"INSERT INTO post(SID,TYPE)values('$userid', 'image')");
			  $query = mysqli_query($dbc,"SELECT PID from post WHERE SID='$userid' ORDER BY PID DESC");
			  $query2 = mysqli_fetch_array($query);
			  $query2 = $query2['0'];
			  echo $query2;
              $image_upload="INSERT INTO pimage (FILENAME,PATH,PID) values('$title','$target_path','$query2')";
              mysqli_query($dbc,$image_upload);

              header("Location:dashboard.php");
              header("Refresh: 1; url=dashboard.php");
          }
      }

  
}
if(isset($_POST['url_submit'])){
	$url=$_POST['youtube_url'];
	$pcontent=$_POST['url_title'];
	$vid=split("=", $url);
	$videoid=$vid[1];
	if($videoid){
			$post = mysqli_query($dbc,"INSERT INTO post (SID,TYPE) values('$userid', 'youtube_url')");
			$query = mysqli_query($dbc,"SELECT PID from post WHERE SID='$userid' ORDER BY PID DESC");
			$result=mysqli_fetch_array($query);
			$result = $result['0'];
			echo $result;
			$url_upload="INSERT INTO pvideo (FILENAME,CONTENT,PID) values('$pcontent','$videoid','$result')";
              mysqli_query($dbc,$url_upload);
              header("Location:dashboard.php");
              header("Refresh: 1; url=dashboard.php");
}
}

?>