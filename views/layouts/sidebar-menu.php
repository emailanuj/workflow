<?php
use yii\helpers\Url;
?>
<ul class="sidebar-menu" data-widget="tree">
    <li>
        <a href="<?= Url::to(['/threshold/service-threshold/index']) ?>">
            <i class="fa fa-circle-o"></i>  
            <span>
                <span class="nav-icon">
                    <img src="<?= Url::base() .'/images/icons/workflow-execution.png' ?>" />
                </span> Service Threshold
              </span>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['/workflow/tbl-keywords']) ?>">
            <i class="fa fa-circle-o"></i>  
            <span>
                <span class="nav-icon">
                    <img src="<?= Url::base() .'/images/icons/workflow-template.png' ?>" />
                </span> 
                Keywords
            </span>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['/workflow/tbl-commands']) ?>">
            <i class="fa fa-circle-o"></i>  
            <span>
                <span class="nav-icon">
                    <img src="<?= Url::base() .'/images/icons/workflow-template.png' ?>" />
                </span> 
                Commands
            </span>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['/workflow/workflow']) ?>">
            <i class="fa fa-circle-o"></i>  
            <span>
                <span class="nav-icon">
                    <img src="<?= Url::base() .'/images/icons/workflow-template.png' ?>" />
                </span> 
                Workflow
            </span>
        </a>
    </li>
     <li>
        <a href="<?= Url::to(['/workflow/workflow-execution-reports']) ?>">
            <i class="fa fa-circle-o"></i>  
            <span>
                <span class="nav-icon">
                    <img src="<?= Url::base() .'/images/icons/workflow-template.png' ?>" />
                </span> 
                Workflow Execution Reports
            </span>
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['/bpaService/bandwidth-service']) ?>">
            <i class="fa fa-circle-o"></i>  
            <span>
                <span class="nav-icon">
                    <img src="<?= Url::base() .'/images/icons/workflow-template.png' ?>" />
                </span> 
                Bandwidth Service
            </span>
        </a>
    </li>
    
    <li class="active">
        <a href="<?= Url::to(['/bpaService/bandwidth-circuit-service']) ?>">
            <i class="fa fa-circle-o"></i>  
            <span>
                <span class="nav-icon">
                    <img src="<?= Url::base() .'/images/icons/workflow-template.png' ?>" />
                </span> Segment Wise Utilization
              </span>
        </a>
    </li>
    <!--
    <li class="treeview">
        <a href="<?= Url::to(['/']) ?>;">
            <i class="fa fa-circle-o"></i>  
            <span>
                <span class="nav-icon">
                    <img src="<?= Url::base() .'/images/icons/settings.png' ?>" />
                </span> Menu 03
            </span> 
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class='treeview-menu'>
            <li>
                <a href="<?= Url::to(['/']) ?>"><i class="fa fa-fa fa-circle-o"></i>  <span>Submenu 01</span></a>
            </li>
            <li>
                <a href="<?= Url::to(['/']) ?>"><i class="fa fa-fa fa-circle-o"></i>  <span>Submenu 02</span></a>
            </li>
            <li>
                <a href="<?= Url::to(['/']) ?>"><i class="fa fa-fa fa-circle-o"></i>  <span>Submenu 03</span></a>
            </li>
        </ul>
    </li> -->

</ul>