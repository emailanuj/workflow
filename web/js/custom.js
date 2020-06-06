/* added-Dev:lavi 30-04-2020 */

// function openform(id) {
//     document.getElementById("form-popup").style.display = "block";
//     document.getElementById("workflowclone-clone_id").value = id;
// };

// function closeForm() {
//   document.getElementById("form-popup").style.display = "none";
// }

// $(document).on('click', '#clonesubmit',function(){
//     var formdata = $('#formclone').serializeArray();  
//   $.ajax({
//      //this will use the default form action
//      url: $('#formclone').attr('action'),
//      type: 'post',
//      dataType: 'json',
//      data: {formdata},     
//      //if ajax success
//      beforeSend: function(){
//       $("#loading").show();
//      },
//      success: function(data) {         
//          $(".clone-form").css('display','none');
//          $(".form-container").append('<span class="alert alert-success" style="position:absolute;width:95%;">Worklow is clonned successfully.</span>');
//      },
//      complete: function() {
//         $("#loading").hide();
//      },
//   });
// });
/* added-Dev:lavi 30-04-2020 */


$(document).on('click',"#executeProcess",function(){	
	var workflow_id = $("#workflow_id").val();
	$.ajax({
		url: baseURL +'/workflow/workflow-execution/get-running-process/',
		data : {'workflow-id' : workflow_id, 'form-type' : 'create-clone' },
		type: 'POST',
		dataType:'json',
		beforeSend: function() {
			$(".se-pre-con").show();
		},
		success: function(data) {			
			$.each( data, function( key, value ) {
				if(key == 'datatable') {
					$("#executionTable").html(value);
				}
				//else {	executeRunningProcess(workflow_id, key, value); }
			});
			executeRunningProcessSequence(data);
			$(".se-pre-con").hide();
		}
	});	
});

function executeRunningProcessSequence(data,workflow_id) {
	delete data.datatable;
	console.log(data);
	var ajaxes = [];
	$.each( data, function( key, value ) {				
		ajaxes.push( 
			{
				diagram_id: key,				
				url      : baseURL +'/workflow/workflow-execution/execute-running-process/',
				data     : {'workflow-id' : $("#workflow_id").val(), 'diagram-id' : key, 'execution-id' : value },
				callback : function (data) { /*do work on data*/ }
			});		
	});	
	current = 0;
	function do_ajax() {
		if (current < ajaxes.length) {		
			$.ajax({
				url      : ajaxes[current].url,
				data     : ajaxes[current].data,
				type: 'POST',
				dataType:'json',
				success  : function (serverResponse) {
					console.log(serverResponse);
					if (ajaxes[current].diagram_id.indexOf('SE') > -1)
					{
						var re_diagram_id	=  ajaxes[current].diagram_id.replace("SE", "") + ' circle';
					} else if(ajaxes[current].diagram_id.indexOf('PG') > -1)
					{
						var re_diagram_id	=  ajaxes[current].diagram_id.replace("PG", "")+ ' rect';
					}									
					if(serverResponse['status'] == '3') {
						$('#'+re_diagram_id).css('stroke','red');
					} else if(serverResponse['status'] == '2') {
						$('#'+re_diagram_id).css('stroke','green');
					} else {
						$('#'+re_diagram_id).css('stroke','black');
					}
					if(serverResponse['datatable']) {
						$("#executionTable").html(serverResponse['datatable']);
					}															
					ajaxes[current].callback(serverResponse);
					// if(serverResponse['failstatus'] == 'stop') {
					// 	console.log('hi');
					// }					

				},
				complete : function () {					
					current++;					
					do_ajax();					
				}
			});
		}
	}
//run the AJAX function for the first time once `executesequence` fires
do_ajax();
}

// function executeRunningProcess(workflow_id, digram_id, execution_id){
// 	console.log(workflow_id +'  ====  '+ digram_id +'===='+ execution_id);
// 	$.ajax({
// 		url: baseURL +'/workflow-execution/execute-running-process/',
// 		data : {'workflow-id' : $("#workflow_id").val(), 'diagram-id' : digram_id, 'execution-id' : execution_id },
// 		type: 'POST',
// 		dataType:'json',
// 		success: function(data) {	
// 			var re_diagram_id	=  digram_id.replace("SE", "");		
// 			if(data['status'] == '3') {
// 				$('#'+re_diagram_id+ ' circle').css('stroke','red');
// 			} else if(data['status'] == '2') {
// 				$('#'+re_diagram_id+ ' circle').css('stroke','green');
// 			} else {
// 				$('#'+re_diagram_id+ ' circle').css('stroke','black');
// 			}
// 			if(data['datatable']) {
// 				$("#executionTable").html(data['datatable']);
// 			}			
// 		}
// 	});
// }