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
	// $(".se-pre-con").fadeIn("slow");
	var workflow_id = $("#workflow_id").val();
	$.ajax({
		url: baseURL +'/workflow-execution/get-running-process/',
		data : {'workflow-id' : workflow_id, 'form-type' : 'create-clone' },
		type: 'POST',
		dataType:'json',
		success: function(data) {
			//console.log(data); exit;
			$.each( data, function( key, value ) {
				if(key == 'datatable') {
					$("#executionTable").html(value);
				}
				else {	executeRunningProcess(workflow_id, key, value); }
        	});

		}
	});
	// $(".se-pre-con").fadeOut("slow");
});

function executeRunningProcess(workflow_id, digram_id, execution_id){
	console.log(workflow_id +'  ====  '+ digram_id +'===='+ execution_id);
	$.ajax({
		url: baseURL +'/workflow-execution/execute-running-process/',
		data : {'workflow-id' : $("#workflow_id").val(), 'diagram-id' : digram_id, 'execution-id' : execution_id },
		type: 'POST',
		dataType:'json',
		success: function(data) {	
			var re_diagram_id	=  digram_id.replace("SE", "");		
			if(data['status'] == '3') {
				$('#'+re_diagram_id+ ' circle').css('stroke','red');
			} else if(data['status'] == '2') {
				$('#'+re_diagram_id+ ' circle').css('stroke','green');
			} else {
				$('#'+re_diagram_id+ ' circle').css('stroke','black');
			}
			if(data['datatable']) {
				$("#executionTable").html(data['datatable']);
			}			
		}
	});
}