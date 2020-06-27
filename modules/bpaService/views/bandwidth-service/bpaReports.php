<?php
use yii\helpers\Html;
//use yii\helpers\BaseUrl;
//use yii\helpers\ArrayHelper;
use fedemotta\datatables\DataTables;

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
<table id="bpa-table" class="footable table table-stripped toggle-arrow-tiny" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th data-toggle="true">Segment Mapping</th>
                <th data-hide="all">Provisioned Bandwidth</th>
                <th data-hide="all">Actual Bandwidth</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($bpaReports)) {
                $row = '';
                $bpaReports = json_decode($bpaReports,true);               
                foreach($bpaReports as $reportKey => $reportValue) {
                $row  .= '<tr>';
                $row .= '<td>'.$reportValue['id'].'</td><td>'.$reportValue['segment_mapping'].'</td><td>'.$reportValue['provisioned_bandwidth'].'</td><td>'.$reportValue['actual_bandwidth'].'</td>';
                $row .= '</tr>';
                } 
                echo $row;
            } ?>
        </tbody>
        <!-- <tfoot>
            <tr>
            <th>Id</th>
                <th>Segment Mapping</th>
                <th>Provisioned Bandwidth</th>
                <th>Actual Bandwidth</th>
            </tr>
        </tfoot> -->
    </table>
<script>
$(document).ready(function(){
    $('#bpa-table').DataTable({ 'pagingType': 'full_numbers', })
});
</script>