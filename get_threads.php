<?php

     require_once('mysqli_connect.php');
     $output=null;
     $hid=isset($_GET['hid']) ? $_GET['hid'] : NULL;
            
        
         $query = "select tid,title from thread where hid=".(int)$hid;
         $result = mysqli_query($dbc,$query);
         $count = mysqli_num_rows($result);			
         if($count==0){
            echo "Query returned no results";

         }else{
                $output="[";
                while($row = mysqli_fetch_array($result)){
                    $output=$output."{\"tid\":\"".$row['0']."\",\"title\":\"".$row['1']."\"},";  
                }    
                $output=substr($output, 0, -1); 
                $output=$output."]";
                echo $output;
        }
    
?>