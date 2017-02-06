<?php

     require_once('mysqli_connect.php');
     $output=null;
     $hid=isset($_GET['hid']) ? $_GET['hid'] : NULL;
     $page=isset($_GET['page']) ? $_GET['page'] : NULL;
     $sid=isset($_SESSION['sid']) ? $_SESSION['sid'] : NULL;
      //echo $hid ." page:-". $page;   
     if($page!=null && $hid!=null && $page=="newuser"){    
         $query = "select hid,hcode,hname from hierarchy where hparent=".(int)$hid;
         $result = mysqli_query($dbc,$query);
         $count = mysqli_num_rows($result);			
         if($count==0){
            echo "Query returned no results";

         }else{
                $output="[";
                while($row = mysqli_fetch_array($result)){
                    $output=$output."{\"value\":\"".$row['0']."\",\"code\":\"".$row['1']."\",\"name\":\"".$row['2']."\"},";  
                }    
                $output=substr($output, 0, -1); 
                $output=$output."]";
                echo $output;
        }
    }else if($page!=null && $page="wall"){
         $query = "select hid,hcode,hname,hparent,hlevel from hierarchy where hlevel<=4 or hparent!=null && hid = (select hid from student_hierarchy where sid=".(int)$sid.")";
         $result = mysqli_query($dbc,$query);
         $count = mysqli_num_rows($result);			
         if($count==0){
            echo "Query returned no results";

         }else{
                $output="[";
                while($row = mysqli_fetch_array($result)){
                    $output=$output."{\"hid\":\"".$row['0']."\",\"hcode\":\"".$row['1']."\",\"hname\":\"".$row['2']."\",\"hparent\":\"".$row['3']."\"},";  
                }    
                $output=substr($output, 0, -1); 
                $output=$output."]";
                echo $output;
        }
         
     }
?>