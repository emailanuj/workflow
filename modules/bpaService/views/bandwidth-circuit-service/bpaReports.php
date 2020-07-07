<?php
use yii\helpers\Html;
use fedemotta\datatables\DataTables;
?>
<table id="bpa-circuit-table" class="footable table table-stripped toggle-arrow-tiny" style="width:100%">
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
    </table>
<script>
$(document).ready(function(){
    $('#bpa-circuit-table').DataTable({ 'pagingType': 'full_numbers', })
});
</script>