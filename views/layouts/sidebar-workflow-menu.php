<?php

use mdm\admin\components\Helper;
use mdm\admin\components\MenuHelper;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\widgets\Menu;


$arrMenuLists = [
    // [
    //     'title' => 'Service Threshold',
    //     'url' => '/threshold/threshold-setting/index',
    //     'controllerName' => 'threshold-setting'
    // ]
];

?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a href="<?= Url::base(true) ?>">
                        <img alt="image" width="60%" src="<?= Url::base() . '/images/cisco-cx-logo.png' ?>" />
                    </a>
                </div>
                <div class="logo-element">
                    CISCO
                </div>
            </li>
            <li>
                <a href="<?= Url::to(['/workflow/workflow']) ?>">
                    <i class="glyphicon glyphicon-arrow-left"></i>
                    <span class="nav-label">Back to Application</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="nav-label">Designer Entity</span>
                </a>
            </li>
            <li>
                <div id="toolbox">
                    <div class="col-md-auto">
                        <div class="">
                            <input id="start-button" type="image" title="Start Event" src="<?= Url::base() . '/img/startevent.png' ?>" alt="Start Event" style="width: 30px;height: 30px">
                            <input id="start-time-button" type="image" title="Time Event" src="<?= Url::base() . '/img/timestartevent.png' ?>" alt="Time Event" style="width: 30px;height: 30px">
                            <!-- <br> -->
                            <input id="start-message-button" type="image" title="Message Start Event" src="<?= Url::base() . '/img/messagestartevent.png' ?>" alt="Message Start Event" style="width: 30px;height: 30px">
                            <input id="start-error-button" type="image" title="Error Start Event" src="<?= Url::base() . '/img/errorstartevent.png' ?>" alt="Error Start Event" style="width: 30px;height: 30px"><br>

                            <hr>
                            <input id="end-button" type="image" title="End Event" src="<?= Url::base() . '/img/black-circle.png' ?>" alt="End Event" style="width: 30px;height: 30px">
                            <input id="error-end-button" type="image" title="Error End Event" src="<?= Url::base() . '/img/errorend.png' ?>" alt="Error End Event" style="width: 30px;height: 30px">
                            <!-- <br> -->
                            <input id="terminate-end-button" type="image" title="Terminate End Event" src="<?= Url::base() . '/img/terminateend.png' ?>" alt="Terminate End Event" style="width: 30px;height: 30px">
                            <input id="cancel-end-button" type="image" title="Cancel End Event" src="<?= Url::base() . '/img/cancelend.png' ?>" alt="Cancel End Event" style="width: 30px;height: 30px"><br>

                            <hr>

                            <input id="user-task-button" type="image" title="User Task" src="<?= Url::base() . '/img/user.svg' ?>" alt="User Task" style="width: 30px;height: 30px">
                            <input id="script-task-button" type="image" title="Script Task" src="<?= Url::base() . '/img/script.svg' ?>" alt="Script Task" style="width: 30px;height: 30px">
                            <!-- <br> -->
                            <input id="mail-task-button" type="image" title="Mail Task" src="<?= Url::base() . '/img/message.svg' ?>" alt="Mail Task" style="width: 30px;height: 30px">
                            <input id="manual-task-button" type="image" title="Manual Task" src="<?= Url::base() . '/img/manual.svg' ?>" alt="Manual Task" style="width: 30px;height: 30px"><br>

                            <hr>

                            <input id="parallel-gateway-button" type="image" title="Parallel Gateway" src="<?= Url::base() . '/img/parallelgateway.png' ?>" alt="Parallel Gateway" style="width: 30px;height: 30px">
                            <input id="exclusive-gateway-button" type="image" title="Exclusive Gateway" src="<?= Url::base() . '/img/Exclusivegateway.png' ?>" alt="Exclusive Gateway" style="width: 30px;height: 30px">
                            <!-- <br> -->
                            <input id="inclusive-gateway-button" type="image" title="Inclusive Gateway" src="<?= Url::base() . '/img/inclusivedateway.png' ?>" alt="Inclusive Gateway" style="width: 30px;height: 30px">
                            <input id="event-gateway-button" type="image" title="Event Gateway" src="<?= Url::base() . '/img/Eventgateway.png' ?>" alt="Event Gateway" style="width: 30px;height: 30px"><br>

                            <hr>
                            <input id="data-store-button" type="image" title="Data Store" src="<?= Url::base() . '/img/data-store.png' ?>" alt="Data Store" style="width: 30px;height: 30px">
                            <hr>
                            
                            <input id="sub-process-button" type="image" title="Sub Process" src="<?= Url::base() . '/img/subprocess.png' ?>" alt="Sub Process" style="width: 30px;height: 30px">
                            <hr/>
                            <input type="file" id="hidden-file-upload">
                            <input id="upload-input" type="image" title="upload graph" src="<?= Url::base() . '/img/upload-icon.png' ?>">
                            <input type="image" id="download-input" title="download graph" src="<?= Url::base() . '/img/download-icon.png' ?>" alt="download graph">
                            <!-- <input type="image" id="delete-graph" title="delete graph" src="/project/web/img/trash-icon.png" alt="delete graph">  -->

                        </div>
                    </div>
                </div>
            </li>
        </ul>

    </div>
</nav>