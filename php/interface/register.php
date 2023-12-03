<?php
try{
    $result = ["result"=>"","status"=>false,"msg"=>""];
    if(!isset($_POST['data'])){
        throw new Exception('No get data in this register post request');
    }
    $data = json_decode($_POST['data']);
    if(empty($data->username)){
        throw new Exception('username is null');
    }
    if(empty($data->password)){
        throw new Exception('password is null');
    }
    if(empty($data->checkPassword)){
        throw new Exception('checkPassword is null');
    }
    if(empty($data->nickname)){
        throw new Exception('nickname is null');
    }
    if(empty($data->useremail)){
        throw new Exception('useremail is null');
    }
    if(empty($data->mailtoken)){
        throw new Exception('mailtoken is null');
    }
    if(empty($data->headshot)){
        $hedshotData = null;
    }
    else{
        $hedshotData = $data->headshot;
    }

    // 检查token
    require_once './../method/token.php';
    if(!validToken('signemail',$data->useremail)||!validToken('emailtoken',$data->mailtoken)){
        throw new Exception('邮箱和验证码不匹配');
    }
    require_once './../class/User.class.php';
    $user = new User();
    $user ->set('username',$data->username);
    $user ->set('password',$data->password);
    $user ->set('checkPassword',$data->checkPassword);
    $user ->set('nickname',$data->nickname);
    $user ->set('headshotData',$hedshotData);
    $user ->set('useremail',$data->useremail);
    $data = null;

    $result = $user ->register();
    
}
catch(Exception $e){
    $result['msg'] = $e->getMessage();
}
finally{
    echo json_encode($result);
}
?>