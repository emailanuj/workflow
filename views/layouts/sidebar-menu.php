<?php

use yii\helpers\Url;

$arrMenuLists = [
    [
        'title' => 'Service Threshold',
        'url' => '/threshold/threshold-setting/index',
        'controllerName' => 'threshold-setting'
    ],
    [
        'title' => 'Keywords',
        'url' => '/workflow/tbl-keywords',
        'controllerName' => 'tbl-keywords'
    ],
    [
        'title' => 'Commands',
        'url' => '/workflow/tbl-commands',
        'controllerName' => 'tbl-commands'
    ],
    [
        'title' => 'Workflow',
        'url' => '/workflow/workflow',
        'controllerName' => 'workflow'
    ],
    [
        'title' => 'Workflow Execution Reports',
        'url' => '/workflow/workflow-execution-reports',
        'controllerName' => 'workflow-execution-reports'
    ],
    [
        'title' => 'Bandwidth Service',
        'url' => '/bpaService/bandwidth-service',
        'controllerName' => 'bandwidth-service'
    ],
    [
        'title' => 'Segment Wise Utilization',
        'url' => '/bpaService/bandwidth-circuit-service',
        'controllerName' => 'bandwidth-circuit-service'
    ]
];

?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" width="60%" src="<?= Url::base() . '/images/cisco-cx-logo.png' ?>" />

                </div>
                <div class="logo-element">
                    CISCO
                </div>
            </li>
            <?php
            $sideIcons = array("fa-tachometer","fa-lightbulb-o","fa-terminal","fa-sitemap","fa-file","fa-cube","fa-cubes");
            foreach ($arrMenuLists as $strKey => $arrLists) {                
                $strIsActive = '';
                if(Yii::$app->controller->id == $arrLists['controllerName']){
                    $strIsActive = 'active';
                }
            ?>
                <li class="<?= $strIsActive ?>">
                    <a href="<?= Url::to([$arrLists['url']]) ?>">
                        <i class="fa <?php echo $sideIcons[$strKey]; ?>"></i>
                        <span class="nav-label"><?= $arrLists['title'] ?></span>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>

    </div>
</nav>