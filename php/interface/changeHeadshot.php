<?php
if(isset($_POST['data'])){
    $data = json_decode($_POST['data']);
    include "./../class/User.class.php";
    $user = new User();
    $user -> set("username",$data);
    
    $user -> setHeadshot();
    $user -> setNickname();
    
    $result = [
        'headshot'=>$user->get('headshotPath'),
        'nickname'=>$user->get('nickname')
    ];

    echo json_encode($result);
}
?>