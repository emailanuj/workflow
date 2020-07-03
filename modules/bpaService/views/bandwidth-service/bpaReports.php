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
            $TableHead = '<td style="width:100%;"><table class="footable table table-stripped toggle-arrow-tiny" style="width:100%;"><thead><tr><th>class Name</th><th>class value</th></tr></thead><tbody>';
            $TableHead2 = '<td style="width:100%;"><table class="footable table table-stripped toggle-arrow-tiny" style="width:100%;"><thead><tr><th>class Name</th><th>class value</th><th>class Timestamp</th></tr></thead><tbody>';
            $TableFoot = '</tbody></table></td>';
            if(!empty($finalUtilizationTable)) {
                $row = '';                           
                foreach($finalUtilizationTable as $utilizationTableKey => $utilizationTableVal) {  
                    foreach($utilizationTableVal as $tableKey => $tableVal) {                         
                        $classtd = '';
                        (array_key_exists('configured_capacity',$tableVal)) ? $configured_capacity = $tableVal['configured_capacity'] : $configured_capacity = '';
                        (array_key_exists('peak_bw', $tableVal)) ? $provisional_bandwidth  = $tableVal['peak_bw']: $provisional_bandwidth = '' ; 
                        (array_key_exists('actual_bw', $tableVal)) ? $provisional_bandwidth  = $tableVal['actual_bw']: $provisional_bandwidth = '' ; 
                        (array_key_exists('avg_bw', $tableVal)) ? $provisional_bandwidth  = $tableVal['avg_bw']: $provisional_bandwidth = '' ; 
                        (array_key_exists('precentile95_bw', $tableVal)) ? $provisional_bandwidth  = $tableVal['precentile95_bw']: $provisional_bandwidth = '' ; 
                        (array_key_exists('class_peak_bw', $tableVal)) ? $peakClassVal = $tableVal['class_peak_bw'] : $peakClassVal = '';
                        (array_key_exists('class_actual_bw', $tableVal)) ? $actualClassVal = $tableVal['class_actual_bw'] : $actualClassVal = '';
                        (array_key_exists('class_avg_bw', $tableVal)) ? $avgClassVal = $tableVal['class_avg_bw'] : $avgClassVal = '';
                        (array_key_exists('class_precentile95_bw', $tableVal)) ? $precentClassVal = $tableVal['class_precentile95_bw'] : $precentClassVal = '';
                        if($peakClassVal !== '') {                           
                                $classtd = $TableHead2;
                                foreach($peakClassVal as $classKey => $classVal) {                                                                   
                                    $classtd .=  '<tr><td>'.$classKey.'</td><td>'.$classVal[0]['utilization'].'</td><td>'.$classVal[1]['timestamp'].'</td></tr>';
                                }
                                $classtd .=  $TableFoot;
                        }
                        if($actualClassVal !== '') {                            
                                $classtd = $TableHead;
                                foreach($actualClassVal as $classKey => $classVal) {                                
                                    $classtd .=  '<tr><td>'.$classKey.'</td><td>'.$classVal.'</td></tr>';
                                }
                                $classtd .= $TableFoot;
                        }
                        if($avgClassVal !== '') {                            
                                $classtd = $TableHead;
                                foreach($avgClassVal as $classKey => $classVal) {                                
                                    $classtd .=  '<tr><td>'.$classKey.'</td><td>'.$classVal.'</td></tr>';
                                }
                                $classtd .= $TableFoot;
                        }
                        if($precentClassVal !== '') {                            
                                $classtd = $TableHead;
                                foreach($precentClassVal as $classKey => $classVal) {                                
                                    $classtd .=  '<tr><td>'.$classKey.'</td><td>'.$classVal.'</td></tr>';
                                }
                                $classtd .= $TableFoot;
                        }                                                             
                        $row  .= '<tr>';
                        $row .= '<td>'.$utilizationTableKey.'</td><td>'.$tableVal['segment_id'].'</td><td>'.$provisional_bandwidth.'</td><td>'.$configured_capacity.'</td><td>'.$configured_capacity.'</td>'.$classtd;
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