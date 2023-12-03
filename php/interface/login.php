<?php
    if (isset($_POST['data'])) {
        include '../class/User.class.php';
        $data = json_decode($_POST['data']); 
        $user = new User();
        $user ->set('username',$data->username);
        $user ->set('password',$data->password);
        $data = null;
        $result = $user ->login();
        $user = null;
        echo json_encode($result);
    }
    else{
        die('No get data in this login post request');
    }
?>