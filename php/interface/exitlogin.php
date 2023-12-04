<?php
try{
    $result = ["result"=>"","status"=>false,"msg"=>""];
    if(!isset($_POST['data'])){
        throw new Exception('No get data in this register post request');
    }
}
catch(Exception $e){
    $result['msg'] = $e-> getMessage();
}
finally{
    echo json_encode($result);
}
?>