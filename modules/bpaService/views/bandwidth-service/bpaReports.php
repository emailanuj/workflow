<?php
use yii\helpers\Html;
?>
<table id="bpa-table" class="footable table table-stripped toggle-arrow-tiny" style="width:100%">
        <thead>
            <tr>
                <th data-toggle="true">Host mapping</th>
                <th>Segment ID</th>
                <th>Provisional Bandwidth</th>
                <th>Configured Bandwidth</th>
                <th>Commission Bandwidth</th>
                <th data-hide="all"></th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($finalUtilizationTable)) { 
                $exdata = '<td style="width:100%;"><table class="footable table table-stripped toggle-arrow-tiny" style="width:100%;">
                            <thead>
                                <th>class Name</th>
                                <th>class value</th>
                                <th>class timestamp</th>
                            </thead>
                            <tbody><tr><td>CORE_MOBILITY_DATA_OUT</td><td>1339.259</td><td>2020-05-27 21:45:04</td></tr><tr><td>CORE_MOBILITY_SIGNAL_OUT</td><td>1339.259</td><td>2020-05-27 21:45:04</td></tr><tr><td>CORE_NETWORK_OUT</td><td>1339.259</td><td>2020-05-27 21:45:04</td></tr></tbody>
                        </table></td>';  
                          
                $row = '';
                           
            foreach($finalUtilizationTable as $utilizationTableKey => $utilizationTableVal) {  
                foreach($utilizationTableVal as $tableKey => $tableVal) {              
                    $row  .= '<tr>';
                    $row .= '<td>'.$utilizationTableKey.'</td><td>'.$tableVal['segment_id'].'</td><td>'.$tableVal['configured_capacity'].'</td><td>'.$tableVal['configured_capacity'].'</td><td>'.$tableVal['configured_capacity'].'</td>'.$exdata;
                    $row .= '</tr>';
                } 
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