<?php 

include 'mysqli_connect.php';
session_start();
$_SESSION['userid']='bhushi3890';
$userid=$_SESSION['userid'];

/*if($userid){
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 30 minutes ago
    header("Location:logout.php");
}*/

include 'imageupload.php';
//include 'profile.php';
//$pic=mysqli_query("SELECT * from profile where user_id='$userid'");

//$result=mysqli_fetch_assoc($pic);

?>
<html>
<head>

    <link rel="stylesheet" type="text/css" href="css/ns-style-other.css" />
    <script src="js/modernizr.custom.js"></script>

    <meta http-equiv="refresh" content="1020">
    <link href="css/p.css" type="text/css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <link href="css/jquery.cssemoticons.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
  <script src="js/jquery.cssemoticons.min.js" type="text/javascript"></script>
  
    <style>
    .content-switcher{
      display:none;
      height:100px;
      width:670px;
      background: white;
       
        }
    .content,.commentsDisplay{display:none;}
   
    
    .caption{
    margin-top: 60px;
    display: none;
    }
    #status:hover.caption{
 display: block;
    }
    .profile_information{
      display: none;
      width:400px;height: 640px;background: #f5f5f5;z-index:999;padding: 6px;
      float: left;position: absolute;margin: auto;margin-left: 1000px;border-radius: 5px;

      }
      .blur{
        opacity: 0.2;
    filter: alpha(opacity=20);
      }
    .field {
        padding: 6px;}
.underline{border-bottom:1px solid #ccc;border-top:none;border-left:none;border-right:none;line-height:30px;}
#hider{display: none;}
#hider,#shower{text-decoration: none;color: #56bc8a;padding-top: 4px;}   
#notifications::-webkit-scrollbar{
    width:8px;
    background-color:#f5f5f5;border-radius:10px;
    

} 
#notifications::-webkit-scrollbar-thumb{
    background-color: white;
    border-radius:10px;
}
#notifications::-webkit-scrollbar-thumb:hover{
    background-color:#56bc8a;
    border:1px solid #333333;display: block;
}
#notifications::-webkit-scrollbar-thumb:active{
    background-color:#56bc8a;
    border:1px solid #333333;display: block;
}
#notifications::-webkit-scrollbar-track{
      border:1px gray solid;
      border-radius:10px;
     -webkit-box-shadow:0 0 6px gray inset;
}
.ns-effect-thumbslider .ns-content {
  background-color:#2c4762;color:white;
  font-weight: lighter;
  padding: 0 40px 0 80px;
  height: 64px;
  line-height: 20px;
}
.modifier:hover > *{
  background-color: #56bc8a;
  color:#fff;
}

    </style>
      <script type="text/javascript">

/*$(document).ready(function(){
  $('.posttext').emoticonize({
        //delay: 800,
        //animate: false,
        //exclude: 'pre, code, .no-emoticons'
      });
  $('.content2').emoticonize({
        //delay: 800,
        //animate: false,
        //exclude: 'pre, code, .no-emoticons'
      });
});*/

$(function() { //When the document loads
  $(".modifier").bind("click", function() {
    $(window).scrollTop($("#comments_81").offset().top); //scroll to div with container as ID.
    return false; //Prevent Default and event bubbling.
  });
});

      </script>
      <script type="text/javascript">
      function emot(className)
    {
        $('.'+className).emoticonize({
        //delay: 800,
        //animate: false,
        //exclude: 'pre, code, .no-emoticons'
      });   
     }</script>
    <script type="text/javascript">

      function showimagepreview(input) {
      if (input.files && input.files[0]) {
      var filerdr = new FileReader();
      filerdr.onload = function(e) {
      $('#imgprvw').attr('src', e.target.result);
      }
      filerdr.readAsDataURL(input.files[0]);
      }
    }
     function showimagepreview2(input) {
      if (input.files && input.files[0]) {
      var filerdr = new FileReader();
      filerdr.onload = function(e) {
      $('#imgprvwe').attr('src', e.target.result);
      }
      filerdr.readAsDataURL(input.files[0]);
      }
    }
</script>
    <script>
    var intervalVar;

function hidecomments(postid){
    $("#commenter_"+postid).slideUp();
   $(".loadmore"+postid).show();
    $(".hidemore"+postid).hide();
    clearInterval(intervalVar);
}
 function selectElement(i){
 $(".content").show(); 
$(".content-switcher").hide();
$("#item"+i).show();
}
function showprofile(){
 $(".profile_information").toggle(); 
 $("#main").toggleClass("blur");

}
function showcomments(postid){
   $("#commenter_"+postid).slideDown();
  $(".hidemore"+postid).show();
  $(".loadmore"+postid).hide();

  
}
function setCommentsInterval(postid) {
  getComments(postid);
  intervalVar=setInterval(function() { getComments(postid); },1000);
  //console.log(intervalVar);                
}

function getComments(postid){
  
                        var request=new XMLHttpRequest();
                        container=document.getElementById("commenter_"+postid);
                        if(!request)
                            request=new ActiveXObject(Microsoft.XMLHTTP);
                        request.open('POST','comments.php',false);                        
                        request.setRequestHeader('postid',postid);
                        request.setRequestHeader('prevcommentid',container.getAttribute('data-prev-cmnt-id'));                         
                        request.send(null);                                                 
//                        console.log(request.getResponseHeader('dataprevcommentid')+" "+container.getAttribute('data-prev-cmnt-id'));
                        if(request.getResponseHeader('dataprevcommentid')!=container.getAttribute('data-prev-cmnt-id')) {
                          container.innerHTML+=request.responseText;
                          emot('pavan');
                          container.setAttribute('data-prev-cmnt-id',request.getResponseHeader('dataprevcommentid'));
                        }
                                                                      
}
function addComments(postid, userid, comment){
                        if(comment !== "\n" && comment !== "") { 
                            comment=comment.replace(/(\n|\n|\r)/gm,"");
                            console.log(comment);
                            var request=new XMLHttpRequest();
                            if(!request)
                              request=new ActiveXObject(Microsoft.XMLHTTP);
                            request.open('POST','addComments.php',false);                        
                            request.setRequestHeader('postid',postid);
                            request.setRequestHeader('userid',userid);  
                            request.setRequestHeader('comment',comment);                          
                            request.send(null);   
                      }
                        document.getElementById('comment'+postid).value="";

}
function setSession(variable, value) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "setSession.php?variable=" + variable + "&value=" + value, true);
        xmlhttp.send();
        }
    </script>
    <script>
  function tonePlay(){
       var audio = document.getElementById("audio");
       audio.play();
                 }
   </script>
    <script>
if(typeof(EventSource) !== "undefined") {
    setSession("prev_comment",0);
    setSession("prev_post",0);
    var source = new EventSource("notification.php");

    source.onmessage = function(event) {
       
       var json = JSON.parse(event.data);

//console.log(json);
        for(var i=0;i<document.getElementById("chatarea").childElementCount*2;i++) {         
           if(document.getElementById("chatarea").childNodes[i]) {
               if(document.getElementById("chatarea").childNodes[i].nodeName==="DIV"){
                   resetUserStatus(document.getElementById("chatarea").childNodes[i]);
               }               
            }
        }

       for(var i=0;i<json.length-1;i++) {
           if(json[i].id) {               
               document.getElementById("comments_count_"+json[i].id).innerHTML = "<p>comments("+json[i].count+")</p>";          
           } else if(json[i].uid && document.getElementById("chatterman_status_"+json[i].uid).className!=="green_circle"){
               var chatterman='<div id="chatterman_'+json[i].uid+'" class="chatterman"  data-id="'+json[i].uid+'" data-name="'+json[i].name+'" onclick="javascript:addChatBox(this);displayChatBox(this);">\n\
                               <img src="'+json[i].path+'" class="chatpicture"/>\n\
                               <span class="chattername">'+json[i].name+'</span>\n\
                             <div id="chatterman_status_'+json[i].uid+'" class="green_circle"></div></div>';
                var msgCount=document.getElementById("chatterman_"+json[i].uid).getAttribute('data-msg-count');
               document.getElementById("chatarea").removeChild(document.getElementById("chatterman_"+json[i].uid));
               document.getElementById("chatarea").innerHTML=chatterman+document.getElementById("chatarea").innerHTML;               
               document.getElementById("chatterman_"+json[i].uid).setAttribute('data-msg-count',msgCount);
               document.getElementById("chatterman_status_"+json[i].uid).className="green_circle";
           } else if(json[i].fromusername) {
                  var child='<p style="color:red;background-color:white;border:2px solid white;border-radius:4px;position:absolute;width:5px;padding:0px 16px 0px 6px;margin-left:220px;margin-top:10px;">'+json[i].msgCount+'</p>';
                  var chattermanID=document.getElementById("chatterman_"+json[i].fromusername);   
                  console.log(chattermanID.getAttribute('data-msg-count')+" "+json[i].msgCount);               
                  //if(chattermanID.getAttribute('data-msg-count')!='null') {
                      if(chattermanID.getAttribute('data-msg-count')!=json[i].msgCount) {                        
                        tonePlay();
                    }
                  //}
                  chattermanID.removeAttribute('data-msg-count');
                  chattermanID.innerHTML=child+chattermanID.innerHTML;
           } else if(json[i].comment_id) {
            setSession("prev_comment",json[i].comment_id);
             nameraja(json[i].notification);
              
          } else if(json[i].post_id) {
            setSession("prev_post",json[i].post_id);
                nameraja(json[i].post_notification);
                
          }
       }       
       
      //document.getElementById("notifications").innerHTML = json[json.length-1].notifications + "<br>";  
      //nameraja(json[json.length-1].notifications);
    };
    
} else {
    document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
}
function resetUserStatus(object){
    var chattermanID=document.getElementById("chatterman_"+object.getAttribute('data-id'));
    var chatterman_status=document.getElementById("chatterman_status_"+object.getAttribute('data-id'));
    chatterman_status.className="red_circle";
    if(chattermanID.firstChild.nodeName==="P"){
        chattermanID.setAttribute('data-msg-count',chattermanID.firstChild.innerHTML);
        chattermanID.removeChild(chattermanID.firstChild);
    }    
}
</script>

</head>
<?php
    
$result5 = mysqli_query($dbc,"SELECT SNAME,profile_pic FROM student where username='$userid'");
    if($row5 = mysqli_fetch_assoc($result5)){
        
        $name = $row5['SNAME'];
		$profile_pic = $row5['profile_pic'];
        //echo "<img src=",$row5['profile_pic'],">";
    }
?>
<body>
<audio id="audio" src="image/tone.mp3" style="display:none;" ></audio>
<div class="maincontent">
	<div id="heading" style="background: url(image/background.png);position:fixed;">
      <p class="ourtitle">DISCUSS</p>
      <div class="ourname"><?php echo $name;?></div>
		<a href="#" class="profile1" onclick="showprofile()">    </a>
      
		<a href="logout.php" class="logout">     </a>

    </div>
    <div class="profile_information">
		<div class="form-holder">
			<form enctype="multipart/form-data" action="dashboard.php" method="POST"  >
        <div class="field">
			<div class="right">Name:</div><div class="left"><input type="text" name="profilename" class="underline" value="<?=$name?>"/></div>
        </div>
      <div class="field">
        <div class="right">Profile pic:</div><div class="left">
		<input type="file" name="filUpload" id="filUpload" onchange="showimagepreview(this)" style="float:left;" />
        <img id="imgprvw" alt="uploaded image preview"/>
        </div>
         
      </div>
     
      <div class="field">
        <div class="right">Enter new password:</div><div class="left"/><input type="password" name="password1" class="underline"/></div>
      </div>
      <div class="field">
        <div class="right">Re-enter password:</div><div class="left"/><input type="password " name="password2" class="underline"/></div>
      </div>
      <div id="edit">
        <input type="submit" class="Sub" value="Save" style="float:left;margin-left:6px;" name="savechanges"></form>
		<form method ="post" action="logout.php">
		<input type="submit" class="Sub" value="Logout" style="float:left;margin-left:6px;" name="logout"/>
		</form>
     </div>
    
    </div>
          </div>

        <div id="main" style="float:left;margin-left:400px;">
    
    <div class="top" style="margin-top:60px;">
      <div class="profile" style="background:url('<?php echo $profile_pic ?>');
      background-repeat:no-repeat;background-size:100% 100%;"></div>
       
      <div class="post">
          <div class="content-switcher" id="item4">
          <form id="form2" method="post" action="dashboard.php">
            <textarea class="statusarea" name="status" placeholder="Whats on your mind..."></textarea>
            <input type="submit" class="Sub" value="Post" name="status_submit">
            </form>
          </div> 

          <div class="content-switcher" id="item1">
          <form id="form1" runat="server" style="padding:10px 0px 0px 10px;" action="dashboard.php" method="POST" enctype="multipart/form-data">
          <input type="text" name="image_title" style="float:left;width:650px; border-bottom:1px solid #ccc;border-top:none;border-left:none;border-right:none;line-height:30px;" placeholder="Title">
            <div class="form_image" style="clear:both;padding-top:5px;">
            <input type="file" name="fileUpload" onchange="showimagepreview2(this)" style="float:left;" />
              </div>
              <img id="imgprvwe" alt="uploaded image preview"/>
               <input type="submit" class="Sub2"  value="Post" name="image_submit">
            </form>
            </div>   

          <div class="content-switcher" id="item2">
          <form id="form3"  style="padding:10px 0px 0px 10px;" method="post" action="dashboard.php">
          <input name="url_title" type="text" style="float:left;width:650px; border-bottom:1px solid #ccc;border-top:none;border-left:none;border-right:none;line-height:30px;" placeholder="Title">
          <input name="youtube_url" type="text" style="float:left;width:650px; border-bottom:1px solid #ccc;border-top:none;border-left:none;border-right:none;line-height:30px;" placeholder="YouTube Url">
          <input type="submit" class="Sub"  value="Post" name="url_submit"/>
            </form>
            </div> 

        <div id="status" onclick="selectElement(4); return false;"></div>
        <div id="photo" onclick="selectElement(1); return false;"></div>
        <div id="video"  onclick="selectElement(2);"></div>    
        <!--<div id="videoupload"  onclick="selectElement(3);"></div>-->	
		

     </div>
    </div>
   
   <?php
   $results=mysqli_query($dbc,"SELECT * FROM post ORDER BY PID DESC ");
   while($get_results=mysqli_fetch_assoc($results)){
      $type = $get_results['TYPE'];
      $user = $get_results['SID'];
      $post_id = $get_results['PID'];
      $pic2=mysqli_query($dbc,"SELECT SNAME from student where SID='$user'");
      $result2=mysqli_fetch_array($pic2);
	  $result2 = $result2['0'];
	  echo $result2;
	  

      //$pcontent = $get_results['pcontent'];

      if($type==='image') { 
		  echo $result2;
          $select = mysqli_query($dbc,"SELECT PATH,FILENAME FROM pimage where PID = '$post_id'");
          while($pimage = mysqli_fetch_assoc($select))
		  {
		  $pimage1 = $pimage['PATH'];
		  $pimage2 = $pimage['FILENAME'];
		  
		  
        ?>
           <div class="top" id="post_post_<?php echo $post_id;?>">
              <div class="profile" style="background:url('<?php echo $result2['profile_pic'] ?>');background-repeat:no-repeat;background-size:100% 100%;"></div>
                
                <div class="ppost" style="" >
                <div class="content2" style="margin-top:-14px;">
                <p style="width:650px; border:none;line-height:30px;color:#a7a7a7;"><?php echo $result2; ?> posted:-<br/><?=$pimage2?></p>
                <img src="<?php echo $pimage1?>" class="postimage"/>
              </div>

            </div>
          </div>
    <?php  }
	  }
    else if($type==='status') { 
	
		$select = mysqli_query($dbc,"SELECT CONTENT FROM ptext where PID = '$post_id'");
        $pstatus = mysqli_fetch_array($select);
	    $pstatus = $pstatus['0'];
		echo $result2;
      
      ?>
      <div class="top" id="post_post_<?php echo $post_id;?>">
      <div class="profile" style="background:url('<?php echo $result2['profile_pic'] ?>');background-repeat:no-repeat;background-size:100% 100%;"></div>
   
     <div class="ppost" >
       <div class="content2" style="margin-top:-14px;">
        <p style="width:650px; border:none;line-height:30px;color:#a7a7a7;"><?php echo $result2;?> says:-</p>
        <p class="posttext">
        <?=$pstatus=str_replace("\r\n", "<br>", $pstatus);?>
          </p>
       </div>
        
      <?php
   }
    else if($type==='youtube_url') { 
	
	    $select = mysqli_query($dbc,"SELECT CONTENT,FILENAME FROM pvideo where PID = '$post_id'");
        $pvideo = mysqli_fetch_array($select);
	    $pvideo = $pvideo['0'];
		$pvideo1 = $pvideo['1'];

      ?>
      <div class="top" id="post_post_<?php echo $post_id;?>">
      <div class="profile" style="background:url('<?php echo $result2['profile_pic'] ?>');background-repeat:no-repeat;background-size:100% 100%;"></div>
   
     <div class="ppost" >
       <div class="content2" style="margin-top:-14px;">
        <p style="width:650px; border:none;line-height:30px;color:#a7a7a7;"><?php echo $result2;?> posted:-<br/><?=$pvideo1?></p>
     <div class="postvideo">
     <iframe width="560" height="315" src="http://www.youtube.com/embed/<?=$pvideo?>" frameborder="0" allowfullscreen>
     </iframe></div>
       </div>
       <div id="comments_count_<?php echo $post_id;?>"><p><?php echo "comments(".$count.")"; ?></p></div>
         <a href="javascript:setCommentsInterval('<?php echo $post_id ?>');showcomments('<?php echo $post_id ?>');"id="shower"  class="loadmore<?php echo $post_id ?>">Show Comments...</a> 
               <a href="javascript:hidecomments('<?php echo $post_id ?>');"  class="hidemore<?php echo $post_id ?>" id="hider">Hide Comments...</a>
              
              <div id="comments_<?php echo $post_id;?>">   
              <div id="commenter_<?php echo $post_id;?>" class="commentsDisplay" style='width: 700px; margin-left: -10px; box-sizing: border-box; height: auto;display:block;'>        
             </div>       
             </div>
             
             <div class="comments_section" style="width:700px;margin-left:-10px;height:60px;border-radius:4px;">
                
                <div class="comments" id="writercomments"style="width:680px;height:60px;background-color:none;">
                <?php echo $result2;?>
                <form action="post.php?postid=<?=$post_id?>" method="POST">
                  
                <textarea rows="4" cols="50" 
                onkeypress="javascript:if (event.keyCode==13||event.keyCode==13) { addComments('<?php echo $post_id ?>', '<?php echo $userid?>', this.value); getComments('<?php echo $post_id ?>');showcomments('<?php echo $post_id ?>'); }" type="text" 
                    placeholder="comment here" id="comment<?php echo $post_id ?>" class="commented" width="300" style="overflow:none;" /></textarea>
                </form>
                </div>
              </div>


            
     </div>
  </div>
      <?php
   }

 }

   ?>

  </div>

  </div>

  <div   style="position:fixed;max-height:830px; width:400px;">
    
    <div id="notifications" style="max-height:800px;overflow-y:scroll;margin-top:65px;"></div>
  </div>

        
  
  <script src="js/classie.js"></script>
    <script src="js/notificationFx.js"></script>
    <script>
      function nameraja(msg) {
      setTimeout( function() {
              var notification = new NotificationFx({
              wrapper : document.getElementById( 'notifications' ),
              message :msg, //'<div class="ns-thumb"><img src="image/photo.jpg"/></div><div class="ns-content"><p><a href="#">Zoe Moulder</a> accepted your invitation.</p></div>',
              layout : 'other',
              ttl : 10000000,
              effect : 'thumbslider',
              type : 'Profile', // notice, warning, error or success
             
            });

            // show the notification

            notification.show();
            emot('ns-content'); 

          }, 3000 );      
      }
 
    function closeit(cid){
      $("#"+cid).hide();
     // console.log(cid);

     } 
     function closepost(cid){
      $("#post_"+cid).hide();
    //  console.log(cid);

     } 


     
    </script>

  <script>
    $("#top").click(function(){
     // console.log("hello");
      $(window).scrollTop("0px");
    })
  </script>
 
</body>
</html>
<?php //}
//else
//{
//header("Location:login.php");  
 //} 
?>