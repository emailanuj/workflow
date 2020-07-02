$(document).on('click', '#searchbpareport', function () {
	$("#bpareportdata").empty();
	searchformdata = $('#bpa-search').serializeArray();
	$.ajax({
		type: "post",
		url: baseURL + '/bpaService/bandwidth-service/index',
		data: searchformdata,
		dataType: "json",
		success: function (bpaData) {
			if (bpaData.status == "success") {
				$("#bpareportdata").append(bpaData.html);
			} else if (bpaData.status == "failed") {
                $.each(bpaData.html, function (index, value) {
                    $("#bpa-search").find('.field-bandwidthservicemodel-' + index).addClass('has-error');
                    $("#bpa-search").find('.field-bandwidthservicemodel-' + index).find('.help-block').text(value);
                })
			}
		},
		error: function (xhr, status, errorThrown) {
			alert('Something went wrong !')
			console.log('Error');
			console.log(errorThrown);
			console.log(xhr.status);
			//console.log(xhr.responseText);
		},
	});
});

$(document).on('click', '#searchbpacircuitreport', function () {
	searchformdata = $('#bpa-circuit-search').serializeArray();
	$("#bpacircuitreportdata").empty();
	$.ajax({
		type: "post",
		url: baseURL + '/bpaService/bandwidth-circuit-service/index',
		data: searchformdata,
		dataType: "json",
		success: function (bpaData) {
			if (bpaData.status == "success") {
				//alert(bpaData.html);
				$("#bpacircuitreportdata").append(bpaData.html);
			} else if (bpaData.status == "failed") {
                $.each(bpaData.html, function (index, value) {
                    $("#bpa-circuit-search").find('.field-bandwidthcircuitservicemodel-' + index).addClass('has-error');
                    $("#bpa-circuit-search").find('.field-bandwidthcircuitservicemodel-' + index).find('.help-block').text(value);
                })
			}
		},
		error: function (xhr, status, errorThrown) {
			alert('Something went wrong !')
			console.log('Error');
			console.log(errorThrown);
			console.log(xhr.status);
			//console.log(xhr.responseText);
		},
	});
});

function getCurrentFilter() {
	var durationfilterCount = $(".durationfclass").length;
	for(var du = 0; du < durationfilterCount; du++) {
		$("#bandwidthservicemodel-"+du+"-utilization").on('change',function() {
				var currentString = $(this).attr('id');	
				var currentID = currentString.match(/\d+/)[0];
				var currentUtilization = $(this).val();
				if(currentUtilization == 'current') {
					$("#bandwidthservicemodel-"+currentID+"-duration").closest('.durationvisible').css('display','none');
					$("#bandwidthservicemodel-"+currentID+"-duration_filter").closest('.durationselect').css('display','none');
				} else {
					$("#bandwidthservicemodel-"+currentID+"-duration").closest('.durationvisible').css('display','block');
					$("#bandwidthservicemodel-"+currentID+"-duration_filter").closest('.durationselect').css('display','block');
				}
		});
	}
}

function getHourDay() {
	var durationfilterCount = $(".durationfclass").length;
	for(var du = 0; du < durationfilterCount; du++) {				
		$("#bandwidthservicemodel-"+du+"-duration").on('change',function(){			
			var duration = $(this).val();
			var currentString = $(this).attr('id');	
			var currentID = currentString.match(/\d+/)[0];
			console.log(currentID);				
			if(duration == 'hour') {		
				var hours = range(1,24);
				hourHtml = '<option value>Please Select</option>';
				$.each(hours, function(key,val){
					hourHtml += '<option value='+key+'>'+val+'</option>';
				});					
				$("#bandwidthservicemodel-"+currentID+"-duration_filter").closest(".durationselect").css('display','block');
				$("#bandwidthservicemodel-"+currentID+"-duration_filter option").remove();
				$("#bandwidthservicemodel-"+currentID+"-duration_filter").append(hourHtml);	
			} else if(duration == 'day'){
				var days = range(1,60);
				dayHtml = '<option value>Please Select</option>';
				$.each(days, function(key,val){
					dayHtml += '<option value='+key+'>'+val+'</option>';
				});				
				$("#bandwidthservicemodel-"+currentID+"-duration_filter").closest(".durationselect").css('display','block');	
				$("#bandwidthservicemodel-"+currentID+"-duration_filter option").remove();
				$("#bandwidthservicemodel-"+currentID+"-duration_filter").append(dayHtml);	
			} else {
				$("#bandwidthservicemodel-"+currentID+"-duration_filter").closest(".durationselect").css('display','none');	
				$("#bandwidthservicemodel-"+currentID+"-duration_filter").append('');	
			}
		});
	}
}

function range(start, end) {
    if(start === end) return [start];
    return [start, ...range(start + 1, end)];
}