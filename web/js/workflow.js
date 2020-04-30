var elementArray={};
var formDBArray={};
var currFormArr={};
var fieldsArray=[];
var diagram_json={};
$(document).on('click',"#savestartevent",function(){
	debugger;
	 formdata=$('#seModal0').serializeArray();
	 diagram_json['bpmn']=bpmnjson;
	 diagram_json=JSON.stringify(diagram_json);
	$.ajax({
	    type: "post",
	    url: baseURL + '/mongo-workflow/mongo-create',
	    data:formdata,
	    dataType: "json",
	    success: function (jsonData) {
	    	console.log(jsonData);
	    	return jsonData.status;
	    },
	    error: function (xhr, status, errorThrown) {
	    	console.log('Error');
	    	console.log(errorThrown);
	        console.log(xhr.status);
	        console.log(xhr.responseText);
	    },
	}); 
});

// For Showing Modal
function showFunction(element_id,form_type){
    // clearLocalStorage();
	debugger;
	$.ajax({
		type: "post",
		url: baseURL + '/workflow/get-ajax-form',
		data: {'element_id':element_id,'form_type':form_type},
		dataType: "json",
		success: function (jsonData) {
		   $('.workflow_form').empty();
		   $('.workflow_form').append(jsonData.html);
		   populateData(element_id);
		   return jsonData.status;
		},
		error: function (xhr, status, errorThrown) {
			console.log('Error');
		    console.log(errorThrown);
		    console.log(xhr.status);
		    console.log(xhr.responseText);
		},
	});
}
function populateData(blockId){
    /* ----------------------- Testing ------------------------*/
    // debugger;
    if(localStorage.getItem('formData')){
        var localJSONData=JSON.parse(localStorage.getItem('formData'));
        var localData=localJSONData[blockId];
        if(localData){
            console.log('Getting Data From Local Storage');
            console.log(localData);
            // Populate Data
            len=Object.keys(localData).length;
            formDBArray[blockId]=len;
            var currentForm=1;
            current_forms=$("#form_size").val();
            // For Removing Forms
            for(var nf=1;nf<=current_forms;nf++){
            	$( "#seModal"+nf ).remove();                
            }
            fromDBLength=formDBArray[blockId];
            formCurrentLength=currFormArr[blockId];
            if(len>1){
                for(var nf=current_forms;nf<len-1;nf++){
                   // clone_form();
                    currentForm+=1;
                    $("#form_size").val(currentForm);
                    
                }
            }
            currFormArr[blockId]=currentForm;
            fieldsArray.push(currentForm);
            $("#form_size").val(len-1);
            console.log(localData);
            for(var el=0;el<len;el++){
                if(localData[el]){
                    if(localData.id!=''){
                    	if(localData[el]['keywords']=='API'){
                    		$('.api_cls').css("display", "block");
                    		$('.ds_cls').css("display", "none");
                    		$('.formdata_cls').css("display", "none");
                    	}else{
                    		$('.api_cls').css("display", "none");
                    		$('.ds_cls').css("display", "block");
                    	}
                    	if(localData[el]['data_source']=='function_name'){
                    		$('.func_cls').css("display", "block");
                    		$('.formdata_cls').css("display", "none");
                    	}else{
                    		$('.func_cls').css("display", "none");
                    	}
                    	if(localData[el]['data_source']=='form_data'){
                    		$('.func_cls').css("display", "none");
                    		$('.formdata_cls').css("display", "block");
                    	}else{
                    		$('.formdata_cls').css("display", "none");
                    	}
                    	  $("#step_no").val(localData[el]['step_no']);
                    	  $("#if_fail").val(localData[el]['if_fail']);
                    	  $("#next_process").val(localData[el]['next_process']);
                    	  $("#keywords").val(localData[el]['keywords']);
                    	  $("#api_url").val(localData[el]['api_url']);
                    	  $("#api_method").val(localData[el]['api_method']);
                    	  $("#api_type").val(localData[el]['api_type']);
                    	  $("#api_headers").val(localData[el]['api_headers']);
                    	  $("#function_execute").val(localData[el]['function_execute']);
                    	  $("#auth_type").val(localData[el]['auth_type']);
                    	  $("#token_from").val(localData[el]['token_from']);
                    	  $("#token_url").val(localData[el]['token_url']);
                    	  $("#username").val(localData[el]['username']);
                    	  $("#password").val(localData[el]['password']);
                    	  $("#data_source").val(localData[el]['data_source']);
                    	  $("#get_data_function").val(localData[el]['get_data_function']);
                    	  $("#form_data").val(localData[el]['form_data']);
                    	  
                    }
                    console.log('End Localstorage fetch data');
                }else{
                    $("#seModal0").trigger("reset");
                    console.log('No Data Found for Current Key');
                }
            }
        }else{
            // For Removing Extra Forms
            current_forms=$("#form_size").val();
            maxVal=Math.max.apply(Math,fieldsArray);
            if(current_forms>0){
                for(i=1;i<=maxVal;i++){
                	$( "#seModal"+i ).remove();
                }
            }
            $("#form_size").val('0');
            $("#seModal0").trigger("reset");
        }
    }
}
