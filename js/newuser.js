
//validation functions
function validateText(id){
	if($("#"+id).val()==null || $("#"+id).val()==""){
		var $td=$("#"+id).closest('td');
		$td.addClass("has-error");
		var $div=$("<div>", {id: "msg"+id , class: "labelStyle", style: "color:red;width: 100% ; height:10px;"});
		$div.text("This is a mandatory field");
		$td.append($div);
		return false;
	}
	else{
		 var td=$("#"+id).closest('td');
		 td.removeClass("has-error");
		 $("#msg"+id).remove();
		 return true;
	} 	 
} 

function verifyStuId(id){		 
		 var myString=$("#"+id).val();
		 if(myString!=null && myString.length == 9 && /^800......$/.test(myString)){		
			var $td=$("#"+id).closest('td');
			$td.removeClass("has-error");
			$("#msgInvalidId").remove();
			return true;
		 }
		 else{  
		 	var $td=$("#"+id).closest('td');
			$td.addClass("has-error");
			var $div=$("<div>", {id: "msgInvalidId" , class: "labelStyle", style: "color:red;width: 100% ; height:10px;"});
			$div.text("Please enter a valid 9-digit Srudent Id starting with 800. e.g 80093734");
			$td.append($div);
			return false;
		 }	
}
function verifyName(id){		 
		 var myString=$("#"+id).val();
		 if(myString!=null && myString.length <= 25 && /^[a-zA-Z\s]+$/.test(myString)){		
			var $td=$("#"+id).closest('td');
			$td.removeClass("has-error");
			$("#msgInvalidId").remove();
			return true;
		 }
		 else{  
		 	var $td=$("#"+id).closest('td');
			$td.addClass("has-error");
			var $div=$("<div>", {id: "msgInvalidId" , class: "labelStyle", style: "color:red;width: 100% ; height:10px;"});
			$div.text("Surname only can contain alphabets.Maximum length is 25.");
			$td.append($div);
			return false;
		 }	
}
function verifyUname(id){		 
		 var myString=$("#"+id).val();
		 if(myString!=null && myString.length == 8 && /^[a-zA-Z0-9]+$/.test(myString)){		
			var $td=$("#"+id).closest('td');
			$td.removeClass("has-error");
			$("#msgInvalidId").remove();
			return true;
		 }
		 else{  
		 	var $td=$("#"+id).closest('td');
			$td.addClass("has-error");
			var $div=$("<div>", {id: "msgInvalidId" , class: "labelStyle", style: "color:red;width: 100% ; height:10px;"});
			$div.text("Username can only have Alphabets and numbers.");
			$td.append($div);
			return false;
		 }	
}

//onReady function
 $(document).ready(function(){
 		$("#submit_id").click(function(){						 
				if(!validateText("sid_id") || !verifyStuId("sid_id") || !validateText("sname_id") || !verifyName("sname_id")||  !validateText("major_id") || !validateText("uname_id")|| !verifyUname("uname_id") || !validateText("pass_id")){
					return false;						  
				}else{
					  $("form#signUpForm").submit();
				}						 
		});					   							  
 
 });

//Ajax call function javascript
/*function ajaxFunction(url,stateChangeFunc)
{
    var httpxml;
    try
    {
    // Firefox, Opera 8.0+, Safari
        httpxml=new XMLHttpRequest();
    }
    catch (e)
    {
    // Internet Explorer
        try
        {
            httpxml=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            try
            {
                httpxml=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e)
            {
                alert("Your browser does not support AJAX!");
                return false;
            }
        }
    }
    ///////End of First part- Checking browser support//////
    /////// Start of posting data to server ///////
    httpxml.onreadystatechange=stateChangeFunc;
    httpxml.open("GET",url,true);
    httpxml.send(null);
}
//////// End of posting data to server ////////


function stateChangeFunc() 
{
        if(httpxml.readyState==4)
        {
            // do adding of new code;
            alert("reached");
        }
}
*/

//
function fetchSpecilizations(degree){
    console.log(""+degree.value);
    var $url="Query_children.php";
    $url=$url+"?hid="+degree.value+"&page=newuser";
    $.get($url, function(data){
  
        console.log("data"+data);
        var $optionsData=$.parseJSON(data);
        var $optionsString='';
        for (i = 0; i < $optionsData.length; i++) {
            $optionsString +="<option value=\""+$optionsData[i].value+"\">"+$optionsData[i].name +"("+$optionsData[i].code+")</option>";
        }
        var $major = $("#major_id");
        //console.info($("#major_id").hasClass);
        //var mj=document.getElementById("major_id");
        //console.info(mj.className);
        $major.empty().append($optionsString);
        //console.info($major);
    });
    
}