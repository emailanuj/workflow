<?php
use yii\helpers\Url;
if(!empty($model['id'])){
    $url=Url::base() .'/workflow/update?id='.$model["id"];
}else{
    $url=Url::base() .'/workflow/create';
}
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
        <div class="back-app">
            <a href="<?= Url::to(['/workflow-template']) ?>">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> <span>Back to Application</span>
            </a>
        </div>
        <p class="title-symbol">Designer Entity</p>
        <div id="blocklist">
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
            <!-- <input id="arrow-button" type="image" title="Sequence Flow" src="<?= Url::base() .'/img/arrow.png' ?>" alt="Sequence Flow" style="width: 30px;height: 30px"><br> -->
        </div>
    </div>

    <div class="content-wrapper content-wrapper-app">
      <section class="content">
          <div>
              <div class="title-breadcrumb" style="margin:0; padding:0">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-8">
                              <div class="page-title-div">
                                  <span>
                                      <img src="<?= Url::base() .'/images/icons/title-workflow-execution-dark.png'?>">
                                      <input value="" type="text" class="input-text" placeholder="Untitled Workflow Diagram">
                                      <button class="btn btn-edit" type="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                                      <!-- <div class="input-group input-text">
                                        <input type="text" class="form-control" placeholder="Edit">
                                        <span class="input-group-btn">
                                          <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
                                        </span>
                                      </div> -->
                                  </span>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="page-action-wrapper text-right">
                                  <button class="btn btn-comman">Save Workflow</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <div class="svg-wrapper">
        <div id="mySvg"><svg width="1536" height="754"></svg></div>
      </div>
  </div>

    <div id="propwrap" class="">
      <div id="properties">
          <div id="close">
              <img src="<?= Url::base() .'/images/pop-close.png'?>">
          </div>
          <p id="title-properties">Set Field Parameters</p>
          <div id="proplist">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-group search">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Input Label 01</label>
                      <input type="text" name="" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Input Label 02</label>
                      <input type="text" name="" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Input Label 03</label>
                      <input type="text" name="" class="form-control">
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Select 01</label>
                    <select class="form-control" id="">
                      <option value="">Select</option>
                    </select>
                  </div>
                </div>                
                <div class="col-md-7">
                  <div class="form-group">
                    <label>Select 02</label>
                    <select class="form-control" id="">
                      <option value="">Select</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="radcheckinline">
                      <div class="checkbox">
                        <input id="checkOpt1" class="checkbox-custom" name="checkOpt" type="checkbox">
                        <label for="checkOpt1" class="checkbox-custom-label">Checkbox 1</label>
                      </div>
                      <div class="checkbox">
                        <input id="checkOpt2" class="checkbox-custom" name="checkOpt" type="checkbox">
                        <label for="checkOpt2" class="checkbox-custom-label">Checkbox 2</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Textarea</label>
                    <textarea class="form-control" rows="3" placeholder="Textarea"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="radcheckinline">
                    <div class="radio">
                      <input id="radioOpt1" class="radio-custom" name="radio0" value="" type="radio">
                      <label for="radioOpt1" class="radio-custom-label">Radio 1</label>
                    </div>
                    <div class="radio">
                      <input id="radioOpt2" class="radio-custom" name="radio0" value="" type="radio">
                      <label for="radioOpt2" class="radio-custom-label">Radio 2</label>
                    </div>
                    <div class="radio">
                      <input id="radioOpt3" class="radio-custom" name="radio0" value="" type="radio">
                      <label for="radioOpt3" class="radio-custom-label">Radio 3</label>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row margin-top-10">
                <div class="col-md-12">
                  <button id="" class="btn btn-primary">Button 1</button>
                  <button id="" class="btn btn-info">Button 2</button>                
                  <button id="" class="btn btn-default">Button 3</button>
                </div>
              </div>
              <div class="row margin-top-10">
                <div class="col-md-12">                  
                  <button id="" class="btn btn-update">Button 4</button>
                  <button id="" class="btn btn-comman">Button 5</button>
                  <button id="" class="btn btn-comman" disabled="disabled">Button 6</button>
                </div>
              </div>
          </div>
      </div>
  </div>
  </div>

    <!----------------------------------------- Testing Area ----------------------------------->
    <!-------------------------------------------- End -----------------------------------------> 

    <!-- The Modal -->
    <div id="SEModal" class="modal"> 
        <div class="modal-content" style="width:1000px">
            <div class="modal-header">
                <center><h4>Configure Workflow</h4></center>
            </div>
            <div class="modal-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"></div>
                <div class="modal-footer">
                    <input type="hidden" name="form_size" id="form_size" value="0">\
                </div>
            </div>
        </div>
    </div>
<!-------- ENd  First Modal --------------------->
<!------------- Modal for Saving The Data --------->
<div id="FModal" class="modal"> 
      <!-- Modal content -->
      <div class="modal-content">
      <form id="w0" action="<?= $url ?>" method="post">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span id="GClose" aria-hidden="true">&times;</span></button> -->
          
          <center><h4>Save Workflow</h4></center>
        </div>
        <input type="hidden" name="WorkflowStartEventModel[_csrf]" value="LIZdfhe_4zU73ImVV9k2Zxcd82RMq-QXOS34nRNGhuRG1wsVSPXOZna--KwRq0EAJiTLDirFhWEIY72rWCrTow==">
        <input type="hidden" name="WorkflowStartEventModel[workflow_json]" id="workflow_json" value="">
        <input type="hidden" name="WorkflowStartEventModel[workflow_data]" id="workflow_data" value="">
        <?php if(isset($template_id)){?>
        	<input type="hidden" name="Workflow[workflow_template_id]" value="<?php echo $template_id;?>">
        <?php } ?>
        <div class="modal-body">
          <div class="form-group">
            <label>Workflow Title</label>
            <input type="text" id="workflow-workflow_title" class="form-control" name="Workflow[workflow_title]" maxlength="100" value="<?php echo $model['workflow_title'];?>">
          </div>
          <div class="form-group">
            <label>Workflow Description</label>
            <input type="text" id="workflow-workflow_description" class="form-control" name="Workflow[workflow_description]" maxlength="200" value="<?php echo $model['workflow_description'];?>">
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