<?php
$username = 'admin';
$password = 'admin';
if(!empty($_POST['username']) && !empty($_POST['password'])) {
    if($_POST['username'] == $username && $_POST['password'] == $password) {
        echo $token = '080042cad6356ad5dc0a720c18b53b8e53d4c274';       
    }
}