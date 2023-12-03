<?php //查询数据库,根据游戏名获得服务器下载地址地址
    if(isset($_POST['data'])){
     $getdata =  json_decode($_POST['data']);
        require './../link/public/mysql.php';
        require_once './../method/mysqlPreprocess.php';
        require_once './../method/checklogin.php';
        if(checklogin($getdata->userkey)){
            $sql = "SELECT baidu_link,od_link 
                    from items as a
                    left join message as b
                    on a.name = b.name 
                    where a.number = ?";
            $result = mysqlPreprocess($link,$sql,'i',$getdata->number)[0];
            if($result == null){
                $result = ['baidu_link'=>'','od_link'=>''];
            }
            echo json_encode($result);
        }
        else{
            echo json_encode(false);
        }
    }
?>