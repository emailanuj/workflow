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

// var count = 1;
// $(function(){
//     $('#addfields').click(function(){
//         $("#multicircuit")
//         .append('<div class="row"><div class="col-md-3"><div class="form-group field-bandwidthcircuitservicemodel-a_end_host required"> <label class="control-label" for="bandwidthcircuitservicemodel-a_end_host">Aend Hostname</label> <input type="text" id="bandwidthcircuitservicemodel-a_end_host" class="form-control" name="BandwidthCircuitServiceModel[a_end_host][]"><div class="help-block"></div></div></div><div class="col-md-2"><div class="form-group field-bandwidthcircuitservicemodel-a_end_ip required"> <label class="control-label" for="bandwidthcircuitservicemodel-a_end_ip">Aend IP</label> <input type="text" id="bandwidthcircuitservicemodel-a_end_ip" class="form-control" name="BandwidthCircuitServiceModel[a_end_ip][]"><div class="help-block"></div></div></div><div class="col-md-3"><div class="form-group field-bandwidthcircuitservicemodel-z_end_host required"> <label class="control-label" for="bandwidthcircuitservicemodel-z_end_host">Zend Hostname</label> <input type="text" id="bandwidthcircuitservicemodel-z_end_host" class="form-control" name="BandwidthCircuitServiceModel[z_end_host][]"><div class="help-block"></div></div></div><div class="col-md-2"><div class="form-group field-bandwidthcircuitservicemodel-z_end_ip required"> <label class="control-label" for="bandwidthcircuitservicemodel-z_end_ip">Zend IP</label> <input type="text" id="bandwidthcircuitservicemodel-z_end_ip" class="form-control" name="BandwidthCircuitServiceModel[z_end_ip][]"><div class="help-block"></div></div></div><div class="col-md-2" style="margin-top:30px!important;"><a class="rmfields" style="margin-top:10px;cursor:pointer;"><i class="fa fa-minus-circle"></i></a></div></div>')        
// 		//.find("input[type='text']").val(" ")    
//     return false;
//     });
// });




var ctregex = /^(.+?)(\d+)$/i;
var multicircuitIndex = $(".multicircuit").length;

function clone(){
    $(this).parents(".multicircuit").clone()
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
        .on('click', '.addfields', clone)
        .on('click', '.rmfields', remove);
		multicircuitIndex++;
}
function remove(){
    $(this).parents(".multicircuit").remove();
}
$(".addfields").on("click", clone);
$(".rmfields").on("click", remove);








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