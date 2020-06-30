$(".se-pre-con").fadeOut("slow");

/** save each entity form */
$(document).on('click', "#savestartevent", function () {
	var diagram_json 		= {};
	var entityFormSavedData = {};
	var workflowId 			= $("#workflow_id").val();
	diagram_json['bpmn'] 	= bpmnjson;
	diagram_json 			= JSON.stringify(diagram_json);	
	entityFormSavedData 	= sessionStorage.getItem(workflowId);	
	$('#form_json_data').val(diagram_json);
	$('#saved_form_data').val(entityFormSavedData);
	formdata = $('#seModal0').serializeArray();

	$.ajax({
		type: "post",
		url: baseURL + '/workflow/workflow/get-ajax-form',
		data: formdata,
		dataType: "json",
		success: function (jsonData) {			
			if (jsonData.status == "success") {
				console.log(jsonData.json_data);
				sessionStorage.setItem(jsonData.id, jsonData.json_data);
				sessionStorage.setItem('form_json'+workflowId, diagram_json);
				$('.workflow_form').empty();
				alert('Data saved successfully !');
			} else if (jsonData.status == "error") {
				$.each(jsonData.error, function (key, value) {
					$(".field-workflowdatamodel-" + key + " .help-block").addClass('errordiv');
					$(".field-workflowdatamodel-" + key + " .help-block").text(value);
				});
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
/** save each entity form */

/** Entity form Controls */
$(document).on('click', "#SEClose", function () {
	$('.workflow_form').empty();
});

$(document).on('click', "#close", function () {
	$('.workflow_form').empty();
});
/** Entity form Controls */

/** workflow first time creation popup */
$(document).on('click', "#saveWorkflowModal", function () {
	// 	window.workflowmodal = document.getElementById('workflowmodal');
	// 	workflowmodal.style.display = "block";
	clearSessionStorage();
	$.ajax({
		url: baseURL + '/workflow/workflow/create-workflow/',
		type: 'POST',
		success: function (data) {
			$('#modal').modal('show');
			$('#modal').find('#modalContent').html('');
			$('#modal').find('#modalHeader').html('Create Workflow');
			$('#modal').find('#modalContent').html(data);
			$('#modal').find('.save-ajax-btn').attr('id', 'save-workflow-data');
		}
	});
});
/** workflow first time creation popup */

/** workflow first time creation save */
$(document).on('click', "#save-workflow-data", function () {
	$.ajax({
		url: baseURL + '/workflow/workflow/create-workflow/',
		type: 'POST',
		dataType: 'json',
		data: $('#workflow_save').serializeArray(),
		success: function (data) {
			$.each(data, function (index, value) {
				$("#workflow_save").find('.field-workflow-' + index).addClass('has-error');
				$("#workflow_save").find('.field-workflow-' + index).find('.help-block').text(value);
			})
		}
	});
});
/** workflow first time creation save */

/** workflow clone model popup*/
$(document).on('click', "#createWorkflowClone", function () {
	$.ajax({
		url: baseURL + '/workflow/workflow/create-workflow-clone/',
		data: { 'workflow-id': $(this).attr('actual-id'), 'form-type': 'create-clone' },
		type: 'POST',
		success: function (data) {
			$('#modal').modal('show');
			$('#modal').find('#modalContent').html('');
			$('#modal').find('#modalHeader').html('Clone Workflow');
			$('#modal').find('#modalContent').html(data);
			$('#modal').find('.save-ajax-btn').attr('id', 'clone-workflow-data');
		}
	});
});
/** workflow clone model popup*/

/** workflow clone save */
$(document).on('click', "#clone-workflow-data", function () {
	$.ajax({
		url: baseURL + '/workflow/workflow/create-workflow-clone/',
		type: 'POST',
		dataType: 'json',
		data: $('#formclone').serializeArray(),
		success: function (data) {
			$.each(data, function (index, value) {
				$("#formclone").find('.field-workflowclone-' + index).addClass('has-error');
				$("#formclone").find('.field-workflowclone-' + index).find('.help-block').text(value);
			})
		}
	});
});
/** workflow clone save */

/** workflow cancel entity form */
$(document).on('click', "#cancelstartevent", function () {
	window.workflowmodal = document.getElementById('workflowmodal');
	workflowmodal.style.display = "none";
});
/** workflow cancel entity form */

/** workflow on each entity setting buton sideopen entity form */
function showFunction(element_id, form_type) {
	//clearSessionStorage();
	var workflow_id = $('#workflow_id').val();
	// debugger;
	$.ajax({
		type: "post",
		url: baseURL + '/workflow/workflow/get-ajax-form',
		data: { 'element_id': element_id, 'form_type': form_type, 'workflow_id': workflow_id },
		dataType: "json",
		success: function (jsonData) {
			$('.workflow_form').empty();
			$('.workflow_form').append(jsonData.html);
			populateData(element_id, workflow_id);
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
/** workflow on each entity setting buton sideopen entity form */

/** workflow data of each entity form from local session*/
function populateData(blockId, workflow_id) {
	if (sessionStorage.getItem(workflow_id)) {
		var localJSONData = JSON.parse(sessionStorage.getItem(workflow_id));
		var localData = localJSONData[blockId];
		console.log(localData);
		if (localData) {
			if (localData['keywords'] == 'API') {
				$('.api_cls').css("display", "block");
				$('.ds_cls').css("display", "none");
				$('.formdata_cls').css("display", "none");
			} else {
				$('.api_cls').css("display", "none");
				$('.ds_cls').css("display", "block");
			}
			if (localData['data_source'] == 'function_name') {
				$('.func_cls').css("display", "block");
				$('.formdata_cls').css("display", "none");
			} else {
				$('.func_cls').css("display", "none");
			}
			if (localData['data_source'] == 'form_data') {
				$('.func_cls').css("display", "none");
				$('.formdata_cls').css("display", "block");
			} else {
				$('.formdata_cls').css("display", "none");
			}
			if (localData['api_method'] == 'post') {
				$('.api_post_field').css("display", "block");
			} else {
				$('.api_post_field').css("display", "none");
			}
			$.each(localJSONData[blockId], function (key, value) {
				$('#workflowdatamodel-' + key).val(value);
			});

		}
		else {
			$("#seModal0").trigger("reset");
			console.log('No Data Found for Current Key');
		}
	}
}
/** workflow data of each entity form from local session*/

/** Each entity form Dropdown filters */
$(document).on('change', "#workflowdatamodel-keywords", function () {
	selected_value = this.value;
	if (selected_value == 'API') {
		$('.api_cls').css("display", "block");
		$('.ds_cls').css("display", "none");
		$('.formdata_cls').css("display", "none");
	} else {
		$('.api_cls').css("display", "none");
		$('.ds_cls').css("display", "block");
	}
});
$(document).on('change', "#workflowdatamodel-api_method", function () {
	selected_value = this.value;
	if (selected_value == 'post') {
		$('.api_post_field').css("display", "block");
	} else {
		$('.api_post_field').css("display", "none");
	}
});
$(document).on('change', "#workflowdatamodel-data_source", function () {
	selected_value = this.value;
	if (selected_value == 'function_name') {
		$('.func_cls').css("display", "block");
		$('.formdata_cls').css("display", "none");
	} else {
		$('.func_cls').css("display", "none");
	}
	if (selected_value == 'form_data') {
		$('.func_cls').css("display", "none");
		$('.formdata_cls').css("display", "block");
	} else {
		$('.formdata_cls').css("display", "none");
	}
});
/** Each entity form Dropdown filters */

/** workflow form final data save */
function completeWorkflow() {
	//console.log('workflow complete');
	w_id = $('#workflow_id').val();
	var bpmnjsondb = [];
	for (bj = 0; bj < bpmnjson.length; bj++) {
		if (bpmnjson[bj].id == 0) {
			delete bpmnjson[bj];
		} else {
			bpmnjsondb.push(bpmnjson[bj]);
		}
	}
	var diagram_json = {};
	diagram_json['bpmn'] = bpmnjsondb;
	diagram_json = JSON.stringify(diagram_json);
	console.log(diagram_json);
	$('#form_json_data').val(diagram_json);
	sessionStorage.setItem('form_json'+w_id, diagram_json);
	workflow_data = sessionStorage.getItem(w_id);
	workflow_json = sessionStorage.getItem('form_json'+w_id);
	workflow_title = $("#workflow_title").val();
	$('#workflow_json').val(workflow_json);
	$('#workflow_data').val(workflow_data);
	$('#w_id').val(w_id);	
	$.ajax({
		type: "post",
		url: baseURL + '/workflow/workflow/save-workflow',
		data: { 'w_id': w_id, 'workflow_title': workflow_title, 'workflow_json': workflow_json, 'workflow_data': workflow_data },
		dataType: "json",
		success: function (jsonData) {
			clearSessionStorage();			
			if(jsonData == "success") {
				window.location = baseURL + '/workflow/workflow/index';
			}
		},
		error: function (xhr, status, errorThrown) {
			console.log('Error');
			console.log(errorThrown);
			console.log(xhr.status);
			console.log(xhr.responseText);
		},
	});

}
/** workflow form final data save */

/** clean up storage */
function clearSessionStorage() {
	sessionStorage.clear();
}
/** clean up storage */

/** graph draw for create update pages */
function drawGraph(grapOBJ, formObj, workflow_id) {
	uploadgraphCreator(grapOBJ);
	sessionStorage.setItem(workflow_id, JSON.stringify(formObj));
	sessionStorage.setItem('form_json'+workflow_id, JSON.stringify(grapOBJ));
}
/** graph draw for create update pages */