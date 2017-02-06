<html>
<head>
<title>SIGN UP</title>
<link rel="stylesheet" type="text/css" href="/db/css/newuser.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/db/js/newuser.js"></script>
<style>
video { 
  -webkit-transform: scaleX(4.4); 
  -moz-transform: scaleX(4.4);
}
</style>
</head>

<body class="greyBackground">
	  <div class="headerBar">
		 <span><image height="40px" width="inherit" src="/db/image/DiscussLogoTra.gif"/></span> 
		 <span><image height="inherit" width="inherit" src="/db/image/DiscussNameTra.gif"/></span>
		 <span style="float:right;padding-right:20px; padding-top:10px; font-size:large;"><a href="#">FAQ</a></span>
		 <span style="float:right;padding-right:20px; padding-top:10px; font-size:large;"><a href="#">About</a></span>
	 </div>
	 <!--div style="height:400px;">
		 <video style="height:inherit; width:inherit;" src="/db/video/Sachin.mp4" muted="" autoplay="" loop=""></video>
	</div-->
	 <div>
	 <form action="/db/check_data.php" id="signUpForm" method="post">	
	      <legend class="legendStyle">Join Discuss</legend>	  
		  <table  align="center" class="singupTable">
		  	 <tr>
				 	 <td style="width:20%"><label for="sid_id" class="labelStyle">Student Id</label></td> <td colspan=2><input id="sid_id" type="number"  maxlength=9 name="sid" class="form-control"></td>
		     </tr>
			 <tr style="height:10px"></tr>
			 <tr>
				 	 <td style="width:20%"><label for="sname_id" class="labelStyle">Student Name</label></td> <td colspan=2><input id="sname_id" type= "text" maxlength=25 name="sname" class="form-control"/></td>
		     </tr>
			 <tr style="height:10px"></tr>
             
              <tr>
                  <td style="width:20%"><label for="degree_id" class="labelStyle">Degree</label></td>
                  <td colspan=2>          
             <?php
                 // Code to fill the selectlist with Graduation options
                try{      
                 require_once('mysqli_connect.php');
                 $query = "select hid,hcode,hname from hierarchy where hparent=1";
                 $result = mysqli_query($dbc,$query);
                 
                 $count = mysqli_num_rows($result);			
                 if($count==0){
                     
                      throw new Exception('issue');
                     
                 }else{
                     
                        echo"<select id=\"degree_id\" name=\"degree\" class=\"form-control\" onchange=fetchSpecilizations(this);>
                                <option disabled selected> -- Select an option -- </option>";    
                        while($row = mysqli_fetch_array($result)){
                            echo "<option value=".$row['hid'].">".$row['hname']."</option>"  ;  
                        }    
                        echo "</select>";
                     
                 }
                }catch(Exception $e){
                    
                    echo "caught Exception".$e;
                }
                
              ?>
             
				 	 </td>
		     </tr>
			 <tr style="height:10px"></tr> 
			 <tr>
				 	 <td style="width:20%"><label for="major_id" class="labelStyle">Major Name</label></td><td colspan=2><select id="major_id" name="major" class="form-control" ></select></td>
		     </tr>
			 <tr style="height:10px"></tr>
			 <tr>
				 	 <td style="width:20%"><label for="uname_id" class="labelStyle">Username</label></td><td><input id="uname_id" type="text"  maxlength=8 name="uname" class="form-control"></td><td style="width:20%" align=" center"><label class="labelStyle">@Uncc.edu</label></td>
		     </tr>
			 <tr style="height:10px"></tr>
			 <tr>
				 	 <td style="width:20%"><label for="pass_id" class="labelStyle">Password</label></td><td colspan=2><input id="pass_id" type="password"  maxlength=20 name="pass" class="form-control"></td>
		     </tr>
			 <tr style="height:10px"></tr>	
			  <tr>
				 	 <td colspan=3><input type="button" id="submit_id" name="submitBtn" value="Sign Up" class="submitBtn btn btn-info"></td>
		     </tr>      		  
		  </table>
	</form>
	</div>	  
</body>
</html>