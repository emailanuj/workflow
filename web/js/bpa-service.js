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

var count = 1;
$(function(){
    $('#addfields').click(function(){
        $("#multicircuit")
        .clone()
        .appendTo($("#multicircuit"))
		.find("input[type='text']").val(" ")
    
    return false;
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
				alert(bpaData.html);
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