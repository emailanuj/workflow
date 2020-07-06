<?php
use yii\helpers\Html;
?>
<table id="bpa-table" class="footable table table-stripped toggle-arrow-tiny" style="width:100%">
        <thead>
            <tr>
                <th data-toggle="true">Host Details</th>
                <th>Segment ID</th>
                <th>Segment Mapping</th>
                <th>Utlization Type</th>
                <th>Interval</th>
                <th>Class info</th>
                <th>Commissioned Bandwidth</th>
                <th>Provisioned Bandwidth</th>
                <th>Utilization Bandwidth</th>
                <th data-hide="all"></th>                
            </tr>
        </thead>
        <tbody>
            <?php 
            $TableHead = '<td style="width:100%;"><table class="footable table table-stripped toggle-arrow-tiny" style="width:100%;"><thead><tr><th>class Name</th><th>class value</th></tr></thead><tbody>';
            $TableHead2 = '<td style="width:100%;"><table class="footable table table-stripped toggle-arrow-tiny" style="width:100%;"><thead><tr><th>class Name</th><th>class value</th><th>class Timestamp</th></tr></thead><tbody>';
            $TableFoot = '</tbody></table></td>';
            if(!empty($finalUtilizationTable)) {                
                $row = '';   
                $utilizationType =  $utilizationClass =   $utilizationInterval = '';                    
                foreach($finalUtilizationTable as $utilizationTableKey => $utilizationTableVal) { 
                        $utilizationType = $finalUtilizationTable[$utilizationTableKey]['utilization_type'];
                        $utilizationClass = $finalUtilizationTable[$utilizationTableKey]['class_type'];
                        $utilizationInterval = $finalUtilizationTable[$utilizationTableKey]['interval']; 
                    foreach($utilizationTableVal as $tableKey => $tableVal) { 
                        if(in_array($tableKey, array('utilization_type','class_type','interval')))   { continue; }                                                                                       
                        $classtd = '';                        
                        if(array_key_exists('peak_bw', $tableVal)) {
                            $provisional_bandwidth  = $tableVal['peak_bw'];                                                                                 
                        } else if(array_key_exists('actual_bw', $tableVal)) {
                            $provisional_bandwidth  = $tableVal['actual_bw'];
                        } else if(array_key_exists('avg_bw', $tableVal)) {
                            $provisional_bandwidth  = $tableVal['avg_bw'];
                        } else if(array_key_exists('precentile95_bw', $tableVal)) {
                            $provisional_bandwidth  = $tableVal['precentile95_bw'];
                        } else {
                            $provisional_bandwidth = '';
                        }
                        
                        if(array_key_exists('class_peak_bw', $tableVal)) {                           
                                $classtd = $TableHead2;
                                foreach($tableVal['class_peak_bw'] as $classKey => $classVal) {                                                                   
                                    $classtd .=  '<tr><td>'.$classKey.'</td><td>'.$classVal[0]['utilization'].'</td><td>'.$classVal[1]['timestamp'].'</td></tr>';
                                }
                                $classtd .=  $TableFoot;
                        }
                        else if(array_key_exists('class_actual_bw', $tableVal)) {                            
                                $classtd = $TableHead;
                                foreach($tableVal['class_actual_bw'] as $classKey => $classVal) {                                
                                    $classtd .=  '<tr><td>'.$classKey.'</td><td>'.$classVal.'</td></tr>';
                                }
                                $classtd .= $TableFoot;
                        }
                        else if(array_key_exists('class_avg_bw', $tableVal)) {                            
                                $classtd = $TableHead;
                                foreach($tableVal['class_avg_bw'] as $classKey => $classVal) {                                
                                    $classtd .=  '<tr><td>'.$classKey.'</td><td>'.$classVal.'</td></tr>';
                                }
                                $classtd .= $TableFoot;
                        }
                        else if(array_key_exists('class_precentile95_bw', $tableVal)) {                            
                                $classtd = $TableHead;
                                foreach($tableVal['class_precentile95_bw'] as $classKey => $classVal) {                                
                                    $classtd .=  '<tr><td>'.$classKey.'</td><td>'.$classVal.'</td></tr>';
                                }
                                $classtd .= $TableFoot;
                        }  else {
                            
                        }                                                           
                        $row  .= '<tr>';
                        $row .= '<td>'.$utilizationTableKey.'</td><td>'.$tableVal['segment_id'].'</td><td>segment Mapping</td><td>'.$utilizationType.'</td><td>'.$utilizationInterval.'</td><td>'.$utilizationClass.'</td><td>'.$provisional_bandwidth.'</td><td>'.$provisional_bandwidth.'</td><td>'.$provisional_bandwidth.'</td>'.$classtd;
                        $row .= '</tr>';
                    } 
                }
                echo $row;
            } ?>
        </tbody>        
    </table>
<script>
$(document).ready(function(){
    $('#bpa-table').DataTable({ 'pagingType': 'full_numbers', })
    
});
$(document).ready(function() {

$('#bpa-table').footable();

});
</script>