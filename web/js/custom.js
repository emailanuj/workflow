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
  console.log(formdata);
  $.ajax({
     //this will use the default form action
     url: $('#formclone').attr('action'),
     type: 'post',
     dataType: 'json',
     data: {formdata},     
     //if ajax success
     success: function(data) {
         alert('You have successfully created the entry');
         //this will reload a pjax element if you use it.
         //$.pjax.reload({container: "#address-list"});
     }
  });
});
/* added-Dev:lavi 30-04-2020 */