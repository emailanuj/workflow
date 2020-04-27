var elementArray={};
var formDBArray={};
var currFormArr={};
var fieldsArray=[];

function saveData(){
    // debugger;
   console.log('Current Id '+selectedId);
    var json_data='';
    
    var formArray={};
    parent=[]
    var mainArr={}
    
    console.log('Start Data');
    //json_data=$('#seModal').serialize().split('&');
    total_forms=parseInt($("#form_size").val());
    for(var count=0;count<=total_forms;count++){
        var jsonArray = {};
        jsonArray["selectedId"]=selectedId;
        jsonArray["elementType"]=elementType;
        jsonArray["elementSubType"]=elementSubType;
        var form_id='seModal'+count;
        console.log(form_id);
        json_data=$('#'+form_id).serialize().split('&');
        //jsonArray.push(parent);
        
        $.each(json_data, function (key, value) {
            var item = {};
            var splittedValue = value.split('=');               
            jsonArray[splittedValue[0]]=splittedValue[1];
        });
        formArray[count]=jsonArray;
    }
    elementArray[selectedId]=formArray;
    console.log('Element Array');
    console.log(elementArray);
    console.log(JSON.stringify(jsonArray));
    console.log('End');
    console.log('Json Array '+jsonArray)
    console.log('Json Data '+json_data);
    console.log('Save Data Called');
// Managing Local Storage
    // Store Data
    //localStorage.setItem(selectedId, JSON.stringify(jsonArray));
    localStorage.setItem('formData', JSON.stringify(elementArray));
    // For Saving Data in MongoDB
    status=saveMongoData();
    semodal.style.display = "none";
    alert('Data saved successfully!');
}
//// Function for saving Mongo Data
function saveMongoData(){
	//debugger;
	
    var json_data='';
    var formArray={};
    // For saving diagram JSON
    var diagram_json={};
    diagram_json['bpmn']=bpmnjson;
    diagram_json=JSON.stringify(diagram_json);
    
    parent=[]
    var mainArr={}    
    console.log('Start Data');
    //json_data=$('#seModal').serialize().split('&');
    total_forms=parseInt($("#form_size").val());
    for(var count=0;count<=total_forms;count++){
        var jsonArray = {};
        jsonArray["selectedId"]=selectedId;
        jsonArray["elementType"]=elementType;
        jsonArray["elementSubType"]=elementSubType;
        var form_id='seModal'+count;
        console.log(form_id);
        json_data=$('#'+form_id).serialize().split('&');
        //jsonArray.push(parent);
        
        $.each(json_data, function (key, value) {
            var item = {};
            var splittedValue = value.split('=');               
            jsonArray[splittedValue[0]]=splittedValue[1];
        });
        formArray[count]=jsonArray;
    }
    elementArray[selectedId]=formArray;
    var jsonData=JSON.stringify(elementArray);
    console.log('JSON Data');
    console.log(jsonData);
    console.log('End');
	$.ajax({
	    type: "post",
	    url: baseURL + '/mongo-workflow/mongo-create',
	    data: {'workflow_data':jsonData,'workflow_json':diagram_json},
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
//                        $("#stepno"+el+"").val(localData[el]['stepno'+el]);
//                        $("#iffail"+el+"").val(localData[el]['iffail'+el]);
//                        $("#nextprocess"+el+"").val(localData[el]['nextprocess'+el]);
//                        $("#alreadygotdata"+el+"").val(localData[el]['alreadygotdata'+el]);
//                        $("#keyword"+el+"").val(localData[el]['keyword'+el]);
//                        $("#datasource"+el+"").val(localData[el]['datasource'+el]);
//                        $("#apiurl"+el+"").val(localData[el]['apiurl'+el]);
//                        $("#apitype"+el+"").val(localData[el]['apitype'+el]);
//                        $("#accesstype"+el+"").val(localData[el]['accesstype'+el]);
//                        $("#inputtype"+el+"").val(localData[el]['inputtype'+el]);
//                        $("#inputformat"+el+"").val(localData[el]['inputformat'+el]);
//                        $("#outputtype"+el+"").val(localData[el]['outputtype'+el]);
//                        $("#expectedresponse"+el+"").val(localData[el]['expectedresponse'+el]);
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
    /* ------------------------- End   ------------------------*/
   /*if(localStorage.getItem(blockId)){
       var localData=JSON.parse(localStorage.getItem(blockId));
       console.log('Getting Data From Local Storage');
       console.log(localData);
       // Populate Data
       console.log(localData);
       if(localData.id!=''){
           $("#keywordname").val(localData.keywordname);
           $("#keyword").val(localData.keyword);
           $("#command").val(localData.command);
           $("#functionname").val(localData.functionname);
           $("#responseoutput").val(localData.responseoutput);
           $("#inputtype").val(localData.inputtype);
           $("#inputformat").val(localData.inputformat);
           $("#stepno").val(localData.stepno);
           $("#stepno").val(localData.stepno);
           $("#nextprocess").val(localData.nextprocess);
           $("#functiontoperform").val(localData.functiontoperform);
           $("#functiontogetdata").val(localData.functiontogetdata);
           $("#responseformat").val(localData.responseformat);
       }
       console.log('End Localstorage fetch data');
    }else{
       $("#seModal").trigger("reset");
        console.log('No Data Found for Current Key');
    }*/
}

function saveWorkFlow(){
	debugger;
    var final_json={};
    final_json['bpmn']=bpmnjson;
    debugger;
    console.log('BPNM JSON ');
    localstorageData=localStorage.getItem('formData');
    console.log('Local Storage Data');
    console.log(JSON.stringify(localstorageData));
    console.log(JSON.stringify(bpmnjson));
    //$('#workflow_json').val(JSON.stringify(bpmnjson));
    $('#workflow_json').val(JSON.stringify(final_json));
    $('#workflow_data').val(localstorageData);
    // For Clearing Local Storage
    //localStorage.clear();
    $('#FModal').show();
    console.log('End');
}
function clearLocalStorage(){
    localStorage.clear();
}
function allStorage() {

    var archive = {}, // Notice change here
    keys = Object.keys(localStorage),
    i = keys.length;

    while ( i-- ) {
        archive[ keys[i] ] = localStorage.getItem( keys[i] );
    }

    return archive;
}

function clone_form() {
    var i=parseInt($("#form_size").val())+1;
    new_element='<div class="panel panel-default">';
    new_element+='<form id="seModal'+i+'" action="" name="seModal'+i+'">';
    new_element+='<div class="panel-heading" role="tab" id="heading'+i+'">';
    new_element+='<h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+i+'" aria-expanded="true" aria-controls="collapse'+i+'">Event Configuration</a></h4></div>';
    new_element+='<div id="collapse'+i+'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading'+i+'"><div class="panel-body"><div class="form-group"><label>Name Of the keyword</label><input type="text" class="form-control" id="keywordname'+i+'" name="keywordname'+i+'" placeholder="Name of the Keyword"></input></div>';
    new_element+=' <div class="form-group"><label>Step No</label><input type="text" class="form-control" id="stepno'+i+'" name="stepno'+i+'" placeholder="Step No"></input></div>';
    new_element+='<div class="form-group"><label>Next Process</label><input type="text" class="form-control" id="nextprocess'+i+'" name="nextprocess'+i+'" placeholder="Next Process"></input></div>';
    new_element+='<div class="form-group"><label>Function to perform in form</label><input type="text" class="form-control" id="functiontoperform'+i+'" name="functiontoperform'+i+'" placeholder="Function to perform in form"></input></div>';
    new_element+='<div class="form-group"><label>Function to get the data</label><input type="text" class="form-control" id="functiontogetdata'+i+'" name="functiontogetdata'+i+'" placeholder="Function to get data"></input></div>';
    new_element+=' <div class="form-group"><label>Response Format</label> <input type="text" class="form-control" id="responseformat'+i+'" name="responseformat'+i+'" placeholder="Response format"></input></div>';
    new_element+='<div class="form-group"><label>Keyword</label><select id="keyword'+i+'" name="keyword'+i+'" class="form-control"><option value="">Please Select Keyword</option><option value="Precheck">Precheck</option><option value="Postcheck">Postcheck</option><option value="NSO">NSO</option></select></div>';
    new_element+='<div class="form-group"><label>Select Command</label><select id="command'+i+'" name="command'+i+'" class="form-control"><option value="">Please Select Keyword</option><option value="command-1">command-1</option><option value="command-2">command-2</option><option value="command-3">command-3</option><option value="command-4">command-4</option></select></div>';
    new_element+='<div class="form-group"><label>Function to perform</label><select id="functionname'+i+'" name="functionname'+i+'" class="form-control"><option value="">Please Select Function</option><option value="functionname-1">functionname-1</option><option value="functionname-2">functionname-2</option><option value="functionname-3">functionname-3</option><option value="functionname-4">functionname-4</option></select></div>';
    new_element+='<div class="form-group"><label>Response Output</label><input type="text" class="form-control" id="responseoutput'+i+'" name="responseoutput'+i+'" placeholder="Response Output"></input></div>';
    new_element+='<div class="form-group"><label>Input Type</label><select id="inputtype'+i+'" name="inputtype'+i+'" class="form-control"><option value="">Please Select Input Type</option><option value="inputtype-1">inputtype-1</option><option value="inputtype-2">inputtype-2</option><option value="inputtype-3">inputtype-3</option><option value="inputtype-4">inputtype-4</option></select></div>';
    new_element+='<div class="form-group"><label>Input format data</label><input type="text" class="form-control" id="inputformat'+i+'" name="inputformat'+i+'" placeholder="Input Format"></input></div>';
    new_element+='</div></div>';
    new_element+='</form></div>';

   
    $("#accordion").append(new_element);
    $("#form_size").val(i);
  }
  function drawGraph(grapOBJ,formObj){
	  debugger;
	  console.log('Start Graph OBJ');
      console.log(grapOBJ);
      console.log('End Graph OBJ');
      uploadgraphCreator(grapOBJ);
      localStorage.setItem('formData', JSON.stringify(formObj));
  }
function showFunction(element_id,form_type){
    // clearLocalStorage();
	// debugger;
	$.ajax({
		type: "post",
		url: baseURL + '/workflow/get-ajax-form',
		data: {'element_id':element_id,'form_type':form_type},
		dataType: "json",
		success: function (jsonData) {
		   $('.panel-group').empty();
		   $('.panel-group').append(jsonData.html);
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
	// By Default Hiding Fields
}

$(document).on('click',"#savestartevent",function(){
	// debugger;
    /*------------------ Start Code ------------------*/
	var json_data='';
    var formArray={};
    parent=[]
    var mainArr={}
    total_forms=parseInt($("#form_size").val());
    for(var count=0;count<=total_forms;count++){
        var jsonArray = {};
        jsonArray["selectedId"]=selectedId;
        jsonArray["elementType"]=elementType;
        jsonArray["elementSubType"]=elementSubType;
        var form_id='seModal'+count;
        console.log(form_id);
        json_data=$('#'+form_id).serialize().split('&');
        $.each(json_data, function (key, value) {
            var item = {};
            var splittedValue = value.split('=');               
            jsonArray[splittedValue[0]]=splittedValue[1];
        });
        formArray[count]=jsonArray;
    }
    elementArray[selectedId]=formArray;
    localStorage.setItem('formData', JSON.stringify(elementArray));
    status=saveMongoData();
    semodal.style.display = "none";
    alert('Data saved successfully!');   
});

$(document).on('click',"#SEClose",function(){
	semodal.style.display = "none";
});
// $(document).on('click',".kpiName",function(){
//     var kpi_name = $(this).attr('kpi_name');
//     var data = {'request': 'searchKpi','searchString': kpi_name};
//     $.ajax({
//         url: baseURL +'/dashboard/main-dashboard/bng-kpi-view',
//         type: 'POST',
//         dataType:'json',
//         data: data,
//         success: function(data) {
//             $("#bng-kpi-view").html('');
//             $("#bng-kpi-view").html(data.html);
//         }
//     });
// });