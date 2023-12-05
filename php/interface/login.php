<?php
try{
    $result =  ["result"=>"","status"=>false,"msg"=>""];
    if (!isset($_POST['data'])) {
        throw new Exception('No get data in this login post request');
    }
    include '../class/User.class.php';
        $data = json_decode($_POST['data']); 
        $user = new User();
        $user ->set('username',$data->username);
        $user ->set('password',$data->password);
        $data = null;
        if($result['result'] = $user ->login()){
            $result['result'] = getToken('usertoken');
        }
        else{
            throw new Exception('登录失败');
        }
        $result['status'] = true;
        $result['msg'] = '登陆成功';
}
catch(Exception $e){
    $result['msg'] = $e -> getMessage();
}
finally{
    echo json_encode($result);
}       

?>