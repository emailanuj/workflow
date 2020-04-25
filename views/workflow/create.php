<?php
use yii\helpers\Url;
?>
<div>    
    <!-- <div id="mySvg"></div> -->
    <div id="mySvg" style="position: absolute; border-width: 1px; overflow: hidden; width: 100%; height: 100%; border-color: rgb(255, 255, 255); border-style: solid; background-color: rgb(255, 255, 255); background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAwIDEwIEwgNDAgMTAgTSAxMCAwIEwgMTAgNDAgTSAwIDIwIEwgNDAgMjAgTSAyMCAwIEwgMjAgNDAgTSAwIDMwIEwgNDAgMzAgTSAzMCAwIEwgMzAgNDAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI2QwZDBkMCIgb3BhY2l0eT0iMC4yIiBzdHJva2Utd2lkdGg9IjEiLz48cGF0aCBkPSJNIDQwIDAgTCAwIDAgMCA0MCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZDBkMGQwIiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4='); background-position: -1px -1px;"></div>
    
    <div id="toolbox_other">
        <input type="file" id="hidden-file-upload">
        <input id="upload-input" type="image" title="upload graph" src="<?= Url::base() .'/img/upload-icon.png' ?>">
        <input type="image" id="download-input" title="download graph" src="<?= Url::base() .'/img/download-icon.png' ?>" alt="download graph">
        <!-- <input type="image" id="delete-graph" title="delete graph" src="/project/web/img/trash-icon.png" alt="delete graph">  -->
    </div>
    <textarea id="edittext" title="Press SHIFT+Enter for line feed" style="width: 120px; height: 80px; left: 608px; top: 180px; position: absolute; text-align: center; box-sizing: border-box; margin: 0px; display: none;">
        
    </textarea>

    <div id="toolbox">
     <!--  <input type="file" id="hidden-file-upload"> -->
    <!--  <span><b>Start Event</b></span><br> -->
     <input id="start-button" type="image" title="Start Event" src="<?= Url::base() .'/img/startevent.png' ?>" alt="Start Event" style="width: 30px;height: 30px">
     <input id="start-time-button" type="image" title="Time Event" src="<?= Url::base() .'/img/timestartevent.png' ?>" alt="Time Event" style="width: 30px;height: 30px"><br>
     <input id="start-message-button" type="image" title="Message Start Event" src="<?= Url::base() .'/img/messagestartevent.png' ?>" alt="Message Start Event" style="width: 30px;height: 30px">
     <input id="start-error-button" type="image" title="Error Start Event" src="<?= Url::base() .'/img/errorstartevent.png' ?>" alt="Error Start Event" style="width: 30px;height: 30px"><br>
     <hr>
    <!--  <span><b>End Event</b></span><br> -->
     <input id="end-button" type="image" title="End Event" src="<?= Url::base() .'/img/black-circle.png' ?>" alt="End Event" style="width: 30px;height: 30px">
      <input id="error-end-button" type="image" title="Error End Event" src="<?= Url::base() .'/img/errorend.png' ?>" alt="Error End Event" style="width: 30px;height: 30px"><br>
      <input id="terminate-end-button" type="image" title="Terminate End Event" src="<?= Url::base() .'/img/terminateend.png' ?>" alt="Terminate End Event" style="width: 30px;height: 30px">
      <input id="cancel-end-button" type="image" title="Cancel End Event" src="<?= Url::base() .'/img/cancelend.png' ?>" alt="Cancel End Event" style="width: 30px;height: 30px"><br>
      <hr>
     <!--  <span><b>Task</b></span><br> -->
      <input id="user-task-button" type="image" title="User Task" src="<?= Url::base() .'/img/user.svg' ?>" alt="User Task" style="width: 30px;height: 30px">
      <input id="script-task-button" type="image" title="Script Task" src="<?= Url::base() .'/img/script.svg' ?>" alt="Script Task" style="width: 30px;height: 30px"><br>
      <input id="mail-task-button" type="image" title="Mail Task" src="<?= Url::base() .'/img/message.svg' ?>" alt="Mail Task" style="width: 30px;height: 30px">
      <input id="manual-task-button" type="image" title="Manual Task" src="<?= Url::base() .'/img/manual.svg' ?>" alt="Manual Task" style="width: 30px;height: 30px"><br>
      <hr>
    
     <input id="parallel-gateway-button" type="image" title="Parallel Gateway" src="<?= Url::base() .'/img/parallelgateway.png' ?>" alt="Parallel Gateway" style="width: 30px;height: 30px">
      <input id="exclusive-gateway-button" type="image" title="Exclusive Gateway" src="<?= Url::base() .'/img/Exclusivegateway.png' ?>" alt="Exclusive Gateway" style="width: 30px;height: 30px"><br>
      <input id="inclusive-gateway-button" type="image" title="Inclusive Gateway" src="<?= Url::base() .'/img/inclusivedateway.png' ?>" alt="Inclusive Gateway" style="width: 30px;height: 30px">
      <input id="event-gateway-button" type="image" title="Event Gateway" src="<?= Url::base() .'/img/Eventgateway.png' ?>" alt="Event Gateway" style="width: 30px;height: 30px"><br>
      <hr>
  <!--     <span><b>Connections</b></span><br> -->
      <input id="arrow-button" type="image" title="Sequence Flow" src="<?= Url::base() .'/img/arrow.png' ?>" alt="Sequence Flow" style="width: 30px;height: 30px"><br>
    <hr>
    <img type="image" src="<?= Url::base() .'/img/settingsicon.png' ?>" style="width: 30px;height: 30px" onClick="saveWorkFlow()">
    </div>
    <!----------------------------------------- Testing Area ----------------------------------->
    <!-------------------------------------------- End -----------------------------------------> 

    <!-- The Modal -->
    <div id="SEModal" class="modal"> 
      <!-- Modal content -->
      <div class="modal-content" style="width:1000px">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span id="SEClose" aria-hidden="true">&times;</span></button> -->
          <center><h4>Configure Workflow</h4></center>
        </div>
        <div class="modal-body">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          
       <!------------------------------------------------- Start -------------------------------->
      
       <!-------------------------------------------------- End --------------------------------->
      </div>
      
      <div class="modal-footer">
       <input type="hidden" name="form_size" id="form_size" value="0">
       <!-- <button id="SEClose" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-default" onClick="clone_form()">Add New Step</button>
        <button type="button" class="btn btn-default" onClick="saveData()">Save</button> -->	
        
      </div>
    </div>
  </div>
</div>
<!-------- ENd  First Modal --------------------->
<!------------- Modal for Saving The Data --------->
<div id="FModal" class="modal"> 
      <!-- Modal content -->
      <div class="modal-content">
      <form id="w0" action="<?= Url::base() .'/workflow/create' ?>" method="post">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span id="GClose" aria-hidden="true">&times;</span></button> -->
          
          <center><h4>Save Workflow</h4></center>
        </div>
        <input type="hidden" name="_csrf" value="LIZdfhe_4zU73ImVV9k2Zxcd82RMq-QXOS34nRNGhuRG1wsVSPXOZna--KwRq0EAJiTLDirFhWEIY72rWCrTow==">
        <input type="hidden" name="workflow_json" id="workflow_json" value="">
        <input type="hidden" name="workflow_data" id="workflow_data" value="">
        <div class="modal-body">
          <div class="form-group">
            <label>Workflow Title</label>
            <input type="text" id="workflow-workflow_title" class="form-control" name="Workflow[workflow_title]" maxlength="100">
          </div>
          <div class="form-group">
            <label>Workflow Description</label>
            <input type="text" id="workflow-workflow_description" class="form-control" name="Workflow[workflow_description]" maxlength="200">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="FClose">Cancel</button>
          <button type="submit" class="btn btn-default" onClick="clearLocalStorage()">Save</button>
        </div>
      </div>
      </form>
    </div> 

</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
   // your code here
   drawGraph(<?php echo $model['workflow_json']?>,<?php echo $model['workflow_data']?>);
}, false);
</script>