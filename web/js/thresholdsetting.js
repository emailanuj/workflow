$(function(){
    $(".bpafields").css('display','none');
    var thresholdName = $("#kpiname").val();
    if(thresholdName == 'BPA') {
        $(".bpafields").css('display','block');
    } else {
        $(".bpafields").css('display','none');
    }
    $("#kpiname").on('change', function(){
        let thresholdName = $(this).val();
        if(thresholdName == 'BPA') {
            $(".bpafields").css('display','block');
        } else {
            $(".bpafields").css('display','none');
        }
    });
});