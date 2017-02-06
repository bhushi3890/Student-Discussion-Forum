<html>
<head>
<title>The Wall</title>
<link rel="stylesheet" type="text/css" href="/db/css/login.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="shortcut icon" type="image/x-icon" href="/db/image/Discuss logo.png" />
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style>
    .greyBackground{    
        background-color:#d9d9d9;
    }    
    
    #tree_id li.container{
        font-size: 20px;
        color: yellow;
        list-style:none;
    }    
    #tree_id div.listDiv{
        padding-left: 5px;
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
<div >
    <div id="hierarchy_span" style="background-color:#666699; width:400px; height:96%;float:left;">
        
    </div>
    <div style="display:block; width:1450px; height:96%; float:left;">
        <div style="height:70%" class="container" id="thread_con">
        </div>
        <div >
            <hr style="border-color:black; margin:15px 15px 15px 15px; width"/>
            <table style="width:100%; margin:15px 15px 15px 15px;" >
                <tr>
                    <td colspan="3" style="height: 200px;">
                        <textarea id="threadArea" style="bottom:0;width:100%; height:100%; padding:15px 15px 15px 15px; "></textarea>
                    </td>
                </tr>
                <tr style="width:2px"></tr>
                <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td style="float:right; width:50px;">
                        <button id="postBtn" name="postName"  class="submitBtn btn btn-info" onclick="postData();">post</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    ghid='';
    ganchor='';
    $(document).ready(function(){
                
        function bindClick(){
            $("#tree_id span").bind("click",function(){
                console.log("inside"+$(this).children("ul").css("display"));
                if($(this).parent("li").children("ul").css("display") == "none"){
                    $(this).addClass("glyphicon-menu-down").removeClass("glyphicon-menu-right");
                    
                    $(this).parent("li").children("ul").show();
                    $(this).parent("li").siblings("li").children("ul").hide();
                } else { 
                    $(this).addClass("glyphicon-menu-right").removeClass("glyphicon-menu-down");
                    $(this).parent("li").children("ul").hide(); 
                    $(this).parent("li").siblings("li").children("ul").hide();
                }
                 event.stopPropagation();

            });

        }
        
        
        function fetchHierarhyData(){
            var $url="Query_children.php";
            $url=$url+"?page=wall";
            $.get($url, function(data){
                var hData=$.parseJSON(data);
                var $maxLevel=-1;
                var $parentMap=new Array();
                var $contentMap=new Array();
                
                for(var i = 0; i < hData.length; i++){
                    var $parentArray=$parentMap[hData[i].hparent];
                    if($parentArray!=null){
                        $parentArray.push(hData[i]);
                        $parentMap[parseInt(hData[i].hparent)]=$parentArray;
                    }else{
                        $parentArray=new Array();
                        $parentArray.push(hData[i]);
                        $parentMap[parseInt(hData[i].hparent)]=$parentArray;    

                    }

                }
                
                for(var i = $parentMap.length-1; i >0 ; i--){
                    if($parentMap[i]!=undefined){              
                        var content="<ul class=\"list-group\" style=\"display:none;\">";
                        for(var j = 0; j < $parentMap[i].length; j++){
                            $parentMap[i][j].hname
                            content+="<li class=\"list-group-item\"><span class=\"glyphicon glyphicon-menu-right\"></span><a id=\""+$parentMap[i][j].hcode+"\" href=\"#\" onclick=\"setHID(this)\">"+$parentMap[i][j].hname+"("+$parentMap[i][j].hcode+")"+"</a><input id=\""+$parentMap[i][j].hcode+"_hid\" type=\"hidden\" name=\""+$parentMap[i][j].hname+"_name\" value=\""+$parentMap[i][j].hid+"\" />"
                            if($contentMap[parseInt($parentMap[i][j].hid)]!=undefined ){
                                console.log($contentMap[parseInt($parentMap[i][j].hid)]);
                                content+=$contentMap[parseInt($parentMap[i][j].hid)];
                                content+="</li>";
                            }
                            
                        }
                        content+="</ul>";
                        if($contentMap[i]==undefined){
                            $contentMap[i]=content;
                        }
                        content='';
                        
                    }
                }
                console.log("----------------result:----------");
                console.log($contentMap[1]);
                $("#hierarchy_span").append($contentMap[1]);
                var ful=$("#hierarchy_span ul").first()
                    ful.attr("id","tree_id");
                    ful.show();
                bindClick();
                
          });
          console.log("done");
        }
        
        fetchHierarhyData();
        console.log("bind");
        
    });
    function setHID(anchor){
        
        ghid=$("#"+anchor.id+"_hid").val();
        ganchor=anchor;
        console.log("hid;"+ghid);
        var $url="get_threads.php";
            $url=$url+"?hid="+ghid;
            $.get($url, function(data){
                console.log("sethid: "+data);
                var $tData=$.parseJSON(data);
                console.log("sethid: "+data);
                var content="<h2>Current Active Discussions </h2><div class=\"list-group\">";
                        for(var j = 0; j < $tData.length; j++){
                            
                            content+="<a style=\"font-size:xx-large;\" href=\"file:///C:/xampp/htdocs/db/dashboard.php?tid="+$tData[j].tid+"\" class=\"list-group-item active\">"+$tData[j].title+"</a></br>"
                                                        
                        }
                        content+="</div>";
                        
                $("#threadArea").val("");
                
                $("#thread_con").empty().append(content);
            });
    }
    function postData(){
        console.log("post hid:"+ghid);
        var $url="insert_data.php";
        var text=$("#threadArea").val();
        console.log(text);
        if(text!=undefined && text!=''){
            $.post($url,{
                
                hid: escape(ghid),
                text1: text
            
                }, function(data){
                    console.log(data);
                    console.log("done with poling");
            });
        }
    }   
</script>        
</html>


