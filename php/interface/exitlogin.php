<?php
try{
    $result = ["result"=>"","status"=>false,"msg"=>""];
    if(!isset($_POST['data'])){
        throw new Exception('No get data in this register post request');
    }
    require_once "./../method/token.php";
    removeToken("usertoken");
    $result['status'] = true;
    $result['msg'] = "退出登录成功";
}
catch(Exception $e){
    $result['msg'] = $e-> getMessage();
}
finally{
    echo json_encode($result);
}
?>