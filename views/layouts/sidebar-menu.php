<?php
use yii\helpers\Url;
?>
<ul class="sidebar-menu" data-widget="tree">
    <li>
        <a href="<?= Url::to(['/tbl-keywords']) ?>">
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
        <a href="<?= Url::to(['/tbl-commands']) ?>">
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
            <a href="<?= Url::to(['/workflow']) ?>">
                <i class="fa fa-circle-o"></i>  
                <span>
                    <span class="nav-icon">
                        <img src="<?= Url::base() .'/images/icons/workflow-template.png' ?>" />
                    </span> 
                    Workflow
                </span>
            </a>
        </li>
    <!-- <li class="active">
        <a href="<?= Url::to(['/']) ?>">
            <i class="fa fa-circle-o"></i>  
            <span>
                <span class="nav-icon">
                    <img src="<?= Url::base() .'/images/icons/workflow-execution.png' ?>" />
                </span> Workflow Execution
              </span>
        </a>
    </li>

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