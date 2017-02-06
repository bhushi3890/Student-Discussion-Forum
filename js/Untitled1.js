function validateText(id){
	if($("#"+id).val()==null || $("#"+id).val()==""){
		var td=$("#"+id).closest('td');
		td.addClass("has-error");
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
		 alert("myString");
		 if(myString!=null && myString.length == 9 && /^800......$/.test(myString)){		
			var $td=$("#"+id).closest('td');
			$td.removeClass("has-error");
			$("#msg").remove();
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
function verifyStuId(id){		 
		 var myString=$("#"+id).val();
		 alert("myString");
		 if(myString!=null && myString.length == 9 && /^800......$/.test(myString)){		
			var $td=$("#"+id).closest('td');
			$td.removeClass("has-error");
			$("#msg").remove();
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

 $(document).ready(function(){
 		$("#submit_id").click(function(){						 
				if(!validateText("sid_id") || !verifyStuId("sid_id") || !validateText("sname_id") ||  !validateText("major_id") || !validateText("uname_id") || !validateText("pass_id")){
					return false;						  
				}else{
					  $("form#signUpForm").submit();
				}						 
		});					   							  
 
 });
