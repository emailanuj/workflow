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
          <form id="seModal0" action="" name="seModal0">
          <div class="panel panel-default" id="formgroup">
              <div class="panel-heading" role="tab" id="heading0">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" aria-controls="collapse0">
                    Event Configuration
                  </a>
                </h4>
              </div>
              <div id="collapse0" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading0">
                <div class="panel-body">
                  <div class="form-group">
                    <label>Step No</label>
                    <input type="text" class="form-control" id="stepno0" name="stepno0" placeholder="Step No"></input>
                  </div>
                  <div class="form-group">
                    <label>If Fail</label>
                    <select id="iffail0" name="iffail0" class="form-control">
                      <option value="">Please Select</option>
                      <option value="stop">Stop</option>
                      <option value="continue">Continue</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Next Process</label>
                    <input type="text" class="form-control" id="nextprocess0" name="nextprocess0" placeholder="Next Process"></input>
                  </div>
                  <div class="form-group">
                    <label>Keyword</label>
                    <select id="keyword0" name="keyword0" class="form-control">
                      <option value="">Please Select Keyword</option>
                      <option value="api">API</option>
                      <option value="nso">NSO</option>
                      <option value="commandexecution">Command Execution</option>
                      <option value="configpush">Config Push</option>
                    </select>
                  </div>
                   <div class="form-group api">
                    <label>API URL</label>
                    <input type="text" class="form-control" id="apiurl0" name="apiurl0" placeholder="API URL"></input>
                  </div>
                  <div class="form-group api">
                    <label>API Method</label>
                    <select id="apimethod0" name="apimethod0" class="form-control">
                      <option value="">Please Select API Method</option>
                      <option value="gettype">Get</option>
                      <option value="posttype">POST</option>
                    </select>
                  </div>
                  <div class="form-group api">
                    <label>API Type</label>
                    <select id="apitype0" name="apitype0" class="form-control">
                      <option value="">Please Select API Type</option>
                      <option value="rest">Rest</option>
                      <option value="soap">SOAP</option>
                    </select>
                  </div>
                  <div class="form-group api">
                    <label>API Headers</label>
                    <input type="text" class="form-control" id="apiheaders0" name="apiheaders0" placeholder="API Headers"></input>
                  </div>
                 <!--   <div class="form-group">
                    <label>Data Source</label>
                    <select id="datasource0" name="datasource0" class="form-control">
                      <option value="">Please Select Data Source</option>
                      <option value="functionname">Function Name</option>
                      <option value="formdata">Form Data</option>
                      <option value="dataatbegnning">Date at Beginning</option>
                      <option value="frompeviousprocess">From previous process</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Function To get Data</label>
                    <select id="functiongetdata0" name="functiongetdata0" class="form-control">
                      <option value="">Please Select Function</option>
                      <option value="function_1">getDataForTopology()</option>
                      <option value="function_1">getDataForTelnet()</option>
                    </select>
                  </div> -->
                  <div class="form-group api">
                    <label>Function To Execute</label>
                    <select id="functiontoexecute0" name="functiontoexecute0" class="form-control">
                      <option value="">Please Select Function</option>
                      <option value="execute_api">execute_curl_json()</option>
                      <option value="execute_api">fil_get_contents()</option>
                      <option value="execute_api">execute_curl_xml()</option>
                    </select>
                  </div>
                  <div class="form-group api">
                    <label>Authentication Type</label>
                    <select id="authenticationtype0" name="authenticationtype0" class="form-control">
                      <option value="">Please Select Access Type</option>
                      <option value="login">Login</option>
                      <option value="tokenbased">Token Based</option>
                      <option value="tokenbased">Both</option>
                    </select>
                  </div>
                  <div class="form-group api">
                    <label>Token From</label>
                    <select id="tokenfrom0" name="tokenfrom0" class="form-control">
                      <option value="">Please Select Token Source</option>
                      <option value="prevresponse">Previous Response</option>
                      <option value="tokenurl">Token URL</option>
                    </select>
                  </div>
                  <div class="form-group api">
                    <label>Token URL</label>
                    <input type="text" class="form-control" id="tokenurl0" name="tokenurl0" placeholder="Token URL"></input>
                  </div>
                   <div class="form-group api">
                    <label>Username</label>
                    <input type="text" class="form-control" id="apiusername0" name="apiusername0" placeholder="API Username"></input>
                  </div>
                  <div class="form-group api">
                    <label>API Password</label>
                    <input type="text" class="form-control" id="apipassword0" name="apipassword0" placeholder="API Password"></input>
                  </div>
              </div>
            </div>
            </div>
            </form>
       <!------------------------------------------------- End -------------------------------->
       <!----- Testing Data -------------->
       <input type="hidden" name="form_size" id="form_size" value="0">
       <!----------- End ----------------->
      </div>
      
      <div class="modal-footer">
        <button id="SEClose" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-default" onClick="clone_form()">Add New Step</button>
        <button type="button" class="btn btn-default" onClick="saveData()">Save</button>
        
      </div>
    </div>
  </div>
</div>
<!-------- ENd  First Modal --------------------->
<!------------- Modal for Saving The Data --------->
<div id="FModal" class="modal"> 
      <!-- Modal content -->
      <div class="modal-content">
      <form id="w0" action="/project/web/workflow/create" method="post">
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