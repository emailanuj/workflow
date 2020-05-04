/* added-Dev:lavi 30-04-2020 */

function openform(id) {
    document.getElementById("form-popup").style.display = "block";
    document.getElementById("workflowclone-clone_id").value = id;
};

function closeForm() {
  document.getElementById("form-popup").style.display = "none";
}

$(document).on('click', '#clonesubmit',function(){
    var formdata = $('#formclone').serializeArray();  
  $.ajax({
     //this will use the default form action
     url: $('#formclone').attr('action'),
     type: 'post',
     dataType: 'json',
     data: {formdata},     
     //if ajax success
     beforeSend: function(){
      $("#loading").show();
     },
     success: function(data) {         
         $(".clone-form").css('display','none');
         $(".form-container").append('<span class="alert alert-success" style="position:absolute;width:95%;">Worklow is clonned successfully.</span>');
     },
     complete: function() {
        $("#loading").hide();
     },
  });
});
/* added-Dev:lavi 30-04-2020 */