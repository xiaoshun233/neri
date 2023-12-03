<?php
require_once '../method/token.php';
require_once '../class/User.class.php';
require_once '../method/checklogin.php';
$result =  ["result"=>"","status"=>false,"msg"=>""];
try{
    if(!isset($_POST['data'])){
        throw new Exception('No get data in this login post request');
    }
    $userkey = json_decode($_POST['data']); 
    $userstate = checklogin($userkey);
    if(!$userstate){
        throw new Exception('No logining');
    }
    $user = new User();
    $user -> set('usertoken',getToken('usertoken'));
    $data = $user -> getTokenData();
    $user = null;
    if($data){
        $result['result'] = $data;
        $result['status'] = true;
        $result['msg'] = '获取成功';
    }

}
catch(Exception $e){
    $result['msg'] = $e->getMessage();
}
finally{
    echo json_encode($result);
}
?>