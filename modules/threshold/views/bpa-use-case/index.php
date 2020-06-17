<?php

use yii\helpers\Html;
//use yii\helpers\BaseUrl;
use yii\helpers\ArrayHelper;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */

$this->title = 'BPA AUC 2.1 UI Reports';
$this->params['breadcrumbs'][] = $this->title;

$utilization        = array("peak" => "peak", "average" => "average", "95 precentile" => "95precentile");
$duration           = array("1 HR" => "1hr", "1 Day" => "1day", "7 Days" => "7days");
$utilizationType    = array("Class Based" => "QOSclassbased", "Combined" => "combined");
?>
<div class="bpa-usecase-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo '<pre/>'; print_r($data); ?>
    

    <?= Html::beginForm(['id' => 'bpa-search'], 'POST'); ?>
    <?= Html::dropDownList('BPA', '', $utilization)->label(false); ?>
    <?= Html::dropDownList('BPA', '', $duration)->label(false); ?>
    <?= Html::dropDownList('BPA', '', $utilizationType)->label(false); ?>
    <?= Html::text('BPA', 'Aend host')->label('A End Host'); ?>
    <?= Html::text('BPA', 'Aend IP')->label('A End IP'); ?>
    <?= Html::text('BPA', 'Zend host')->label('Z End Host'); ?>
    <?= Html::text('BPA', 'Zend IP')->label('Z End IP'); ?>
    <div class="form-group">
        <?= Html::submitButton('POST', ['class' => 'btn btn-primary']); ?>
    </div>
    <?= Html::endForm(); ?>

    <?php
    //$searchModel = new ModelSearch();
    //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>
<?php 

// DataTables::widget([
//     'dataProvider' => $data,
//     'filterModel' => $searchModel,
//     'id' => 'bpa-list',
//     'clientOptions' => [
//         "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
//         "info"=>false,
//         "responsive"=>true, 
//         "dom"=> 'lfTrtip',
//         "tableTools"=>[
//             "aButtons"=> [  
//                 [
//                 "sExtends"=> "copy",
//                 "sButtonText"=> Yii::t('app',"Copy to clipboard")
//                 ],[
//                 "sExtends"=> "csv",
//                 "sButtonText"=> Yii::t('app',"Save to CSV")
//                 ],[
//                 "sExtends"=> "xls",
//                 "oSelectorOpts"=> ["page"=> 'current']
//                 ],[
//                 "sExtends"=> "pdf",
//                 "sButtonText"=> Yii::t('app',"Save to PDF")
//                 ],[
//                 "sExtends"=> "print",
//                 "sButtonText"=> Yii::t('app',"Print")
//                 ],
//             ]
//         ]
//     ],
// ]); 

?>
    <!-- <table id="bpa-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Segment Mapping</th>
                <th>Provisioned Bandwidth</th>
                <th>Actual Bandwidth</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td>dd</td>
                <td>dd</td>
                <td>dd</td>
                <td>dd</td>
            </tr>
        </tfoot>
    </table>     -->
</div>
<script>

</script>
