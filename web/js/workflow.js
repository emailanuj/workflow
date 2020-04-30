var elementArray={};
var formDBArray={};
var currFormArr={};
var fieldsArray=[];
var diagram_json={};
$(document).on('click',"#savestartevent",function(){
	debugger;
	 var diagram_json={};
	 diagram_json['bpmn']=bpmnjson;
	 diagram_json=JSON.stringify(diagram_json);
	 $('#form_json_data').val(diagram_json);
	 formdata=$('#seModal0').serializeArray();
	 
	$.ajax({
	    type: "post",
	    url: baseURL + '/workflow/mongo-create',
	    data:formdata,
	    dataType: "json",
	    success: function (jsonData) {
	    	if(jsonData.status=="success"){
	    		localStorage.setItem(jsonData.id,jsonData.json_data);
	    		localStorage.setItem('form_json',diagram_json);
	    		$('.workflow_form').empty();
	    		alert('Data saved successfully !');
	    	}
	    },
	    error: function (xhr, status, errorThrown) {
	    	alert('Something went wrong !')
	    	console.log('Error');
	    	console.log(errorThrown);
	        console.log(xhr.status);
	        console.log(xhr.responseText);
	    },
	}); 
});
$(document).on('click',"#SEClose",function(){
	$('.workflow_form').empty();
});
$(document).on('click',"#close",function(){
	$('.workflow_form').empty();
});
$(document).on('click',"#saveWorkflowModal",function(){
	window.workflowmodal = document.getElementById('workflowmodal');
	workflowmodal.style.display = "block";
});
// For Showing Modal
function showFunction(element_id,form_type){
    // clearLocalStorage();
	var workflow_id=$('#workflow_id').val();
	debugger;
	$.ajax({
		type: "post",
		url: baseURL + '/workflow/get-ajax-form',
		data: {'element_id':element_id,'form_type':form_type,'workflow_id':workflow_id},
		dataType: "json",
		success: function (jsonData) {
		   $('.workflow_form').empty();
		   $('.workflow_form').append(jsonData.html);
		   populateData(element_id,workflow_id);
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
function populateData(blockId,workflow_id){
	console.log('Under populate data method');
    /* ----------------------- Testing ------------------------*/
    debugger;
    if(localStorage.getItem(workflow_id)){
        var localJSONData=JSON.parse(localStorage.getItem(workflow_id));
        var localData=localJSONData[blockId];
        if(localData){
        	if(localData['keywords']=='API'){
        		$('.api_cls').css("display", "block");
        		$('.ds_cls').css("display", "none");
        		$('.formdata_cls').css("display", "none");
        	}else{
        		$('.api_cls').css("display", "none");
        		$('.ds_cls').css("display", "block");
        	}
        	if(localData['data_source']=='function_name'){
        		$('.func_cls').css("display", "block");
        		$('.formdata_cls').css("display", "none");
        	}else{
        		$('.func_cls').css("display", "none");
        	}
        	if(localData['data_source']=='form_data'){
        		$('.func_cls').css("display", "none");
        		$('.formdata_cls').css("display", "block");
        	}else{
        		$('.formdata_cls').css("display", "none");
        	}
             $.each( localData, function( key, value ) {
            	 $('#workflowstarteventmodel-'+key).val(value);
            	});
                    	  
        }
        else{
           $("#seModal0").trigger("reset");
           console.log('No Data Found for Current Key');
        }
     }
  }

// For Showing Hiding Dropdowns
$(document).on('change',"#workflowstarteventmodel-keywords",function(){
	selected_value=this.value;
	if(selected_value=='API'){
		$('.api_cls').css("display", "block");
		$('.ds_cls').css("display", "none");
		$('.formdata_cls').css("display", "none");
	}else{
		$('.api_cls').css("display", "none");
		$('.ds_cls').css("display", "block");
	}
});
$(document).on('change',"#workflowstarteventmodel-data_source",function(){
	selected_value=this.value;
	if(selected_value=='function_name'){
		$('.func_cls').css("display", "block");
		$('.formdata_cls').css("display", "none");
	}else{
		$('.func_cls').css("display", "none");
	}
	if(selected_value=='form_data'){
		$('.func_cls').css("display", "none");
		$('.formdata_cls').css("display", "block");
	}else{
		$('.formdata_cls').css("display", "none");
	}
});

function clearLocalStorage(){
	alert('Clear Storage Called');
    localStorage.clear();
}
