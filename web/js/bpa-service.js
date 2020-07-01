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


function range(start, end) {
    if(start === end) return [start];
    return [start, ...range(start + 1, end)];
}

function getDayHours() {
	var durationfilterCount = $(".durationfclass").length;
	console.log(durationfilterCount);
	for(var du = 0; du < durationfilterCount; du++) {		
		$("#bandwidthservicemodel-"+du+"-duration").on('change',function(){			
			var duration = $(this).val();			
			if(duration == 'hour') {		
				var hours = range(1,24);
				hourHtml = '<option value>Please Select</option>';
				$.each(hours, function(key,val){
					hourHtml += '<option value='+key+'>'+val+'</option>';
				});	
				console.log(hourHtml);	
				$(".durationfilterselector").css('display','block');
				$("#bandwidthservicemodel-"+du+"-duration_filter option").remove();
				$("#bandwidthservicemodel-"+du+"-duration_filter").append(hourHtml);	
			} else if(duration == 'day'){
				var days = range(1,60);
				dayHtml = '<option value>Please Select</option>';
				$.each(days, function(key,val){
					dayHtml += '<option value='+key+'>'+val+'</option>';
				});
				console.log(dayHtml);
				$(".durationfilterselector").css('display','block');	
				$("#bandwidthservicemodel-"+du+"-duration_filter option").remove();
				$("#bandwidthservicemodel-duration_filter").append(dayHtml);	
			} else {
				$(".durationfilterselector").css('display','none');	
				$("#bandwidthservicemodel-"+du+"-duration_filter").append('');	
			}
		});
	}
	
}

$(function(){
$(".durationfilterselector").css('display','none');


});