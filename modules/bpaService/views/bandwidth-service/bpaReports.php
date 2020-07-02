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
                <th data-toggle="true">Id</th>
                <th>Segment Mapping</th>
                <th>Provisional Bandwidth</th>
                <th>Actual Bandwidth</th>
                <th>Commission Bandwidth</th>
                <th data-hide="all"></th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($bpaReports)) { 
                $exdata = '<td><table class="footable table table-stripped toggle-arrow-tiny">
                            <thead>
                                <th>class Name</th>
                                <th>class value</th>
                                <th>class timestamp</th>
                            </thead>
                            <tbody><tr><td>CORE_MOBILITY_DATA_OUT</td><td>1339.259</td><td>2020-05-27 21:45:04</td></tr><tr><td>CORE_MOBILITY_SIGNAL_OUT</td><td>1339.259</td><td>2020-05-27 21:45:04</td></tr><tr><td>CORE_NETWORK_OUT</td><td>1339.259</td><td>2020-05-27 21:45:04</td></tr></tbody>
                        </table></td>';  
                          
                $row = '';
                $bpaReports = json_decode($bpaReports,true);   
                //echo '<pre/>'; print_r($bpaReports); exit;            
                foreach($bpaReports as $reportKey => $reportValue) {                
                $row  .= '<tr>';
                $row .= '<td>'.$reportValue['id'].'</td><td>'.$reportValue['segment_mapping'].'</td><td>'.$reportValue['provisional_bandwidth'].'</td><td>'.$reportValue['actual_bandwidth'].'</td><td>'.$reportValue['commision_bandwidth'].'</td>'.$exdata;
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
$(document).ready(function() {

$('#bpa-table').footable();

});
</script>