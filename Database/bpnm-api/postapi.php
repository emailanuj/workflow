<?php
$params = $_POST;
$data[0] = $params;
$data[1] = 'success';
$data[2] = 200;
echo json_encode($data);
?>