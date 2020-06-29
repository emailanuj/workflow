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






var ctregex = /^(.+?)(\d+)$/i;
var multicircuitIndex = $(".multicircuit").length;
$("#multicircuit0 .rmfields").hide();
function clone(){
	console.log(multicircuitIndex);
    $(this).parents(".multicircuit").clone(true)
        .appendTo(".circuitgroup")
        .attr("id", "multicircuit" +  multicircuitIndex)
        .find("*")
        .each(function() {
            var id = this.id || "";
            var match = id.match(ctregex) || [];
            if (match.length == 3) {
                this.id = match[1] + (multicircuitIndex);
            }
		})
        // .on('click', '.addfields', clone)
		.on('click', '.rmfields', remove);
		if(multicircuitIndex > '0') {
			$("#multicircuit"+ multicircuitIndex + ' .addfields').hide();
			$("#multicircuit"+ multicircuitIndex + ' .rmfields').show();
		}
		$("#multicircuit0 .addfields").show();


		$("#multicircuit"+ multicircuitIndex).find("[name*=BandwidthCircuitServiceModel]").each(function() {			
            var id = $(this).attr('id');
            var splittedStr = id.split("-");
			var modelName = splittedStr[0]; var columnName = splittedStr[1]; var index = multicircuitIndex;			
            var newId = modelName + "-" + columnName + index;
            //update the id 
            id = id.replace(id,newId);
            $(this).attr('id', id);            
            $(this).val('');
        });
		multicircuitIndex++;	
}
function remove(){
    $(this).parents(".multicircuit").remove();
}
$(".addfields").on("click", clone);
$(".rmfields").on("click", remove);

$(function(){
$(".multicircuit input[name*=BandwidthCircuitServiceModel]").blur(function(){
	var cicuitId = $(this).attr('id');
	var circuitValue = $("#"+cicuitId).val();
	if(circuitValue == '') {		
		$("#"+cicuitId).parent().addClass("has-error");
		$("#"+cicuitId).next(".help-block").text("Field Value is required");		
		$("#"+cicuitId).next(".help-block").css("display","block");
		return false;
	} else {
		$("#"+cicuitId).parent().removeClass("has-error");
		$("#"+cicuitId).next(".help-block").css("display","none");
	}
});

$("#searchbpacircuitreport").on('click', function(){
	$(".multicircuit input[name*=BandwidthCircuitServiceModel]").each(function(){
		var cicuitId = $(this).attr('id');
		var circuitValue = $("#"+cicuitId).val();		
		if(circuitValue == '') {			
			$("#"+cicuitId).parent().addClass("has-error");
			$("#"+cicuitId).next(".help-block").text("Field Value is required");
			$("#"+cicuitId).next(".help-block").css("display","block");
			return false;
		} else {
			$("#"+cicuitId).parent().removeClass("has-error");
			$("#"+cicuitId).next(".help-block").css("display","none");
		}
	});
});

function range(start, end) {
    if(start === end) return [start];
    return [start, ...range(start + 1, end)];
}

$(".durationfilterselector").css('display','none');
$("#bandwidthservicemodel-duration").on('change',function(){
	var duration = $(this).val();
	if(duration == 'hour') {		
		var hours = range(1,24);
		hourHtml = '<option value>Please Select</option>';
		$.each(hours, function(key,val){
			hourHtml += '<option value='+key+'>'+val+'</option>';
		});		
		$(".durationfilterselector").css('display','block');
		$("#bandwidthservicemodel-duration_filter option").remove();
		$("#bandwidthservicemodel-duration_filter").append(hourHtml);	
	} else if(duration == 'day'){
		var days = range(1,60);
		dayHtml = '<option value>Please Select</option>';
		$.each(days, function(key,val){
			dayHtml += '<option value='+key+'>'+val+'</option>';
		});
		$(".durationfilterselector").css('display','block');	
		$("#bandwidthservicemodel-duration_filter option").remove();
		$("#bandwidthservicemodel-duration_filter").append(dayHtml);	
	} else {
		$(".durationfilterselector").css('display','none');	
		$("#bandwidthservicemodel-duration_filter").append('');	
	}
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