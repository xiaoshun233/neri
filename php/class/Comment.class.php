<?php
    class Comment{
        private $publisher;
        private $content;
        private $releaseTime;
        private $publishType;


        public function set($name,$value)
        {
            $this -> $name = $value;
        }
        public function get($name)
        {
            return $this->$name;
        }



        public function publish(){
         try{
            $result = ["result"=>"","status"=>false,"msg"=>""];
            include "./../method/checkString.php";
            if (empty($_SESSION['username'])){
                throw new Exception('请先登录');
            }

            $this->set('publisher',$_SESSION['username']);

            if (checkLength($this->$content,0,50)) {
                throw new Exception('内容长度限制在0-50个字符长度');
            }
            include "./../link/public/mysql.php";
         }catch(Exception $error){
            $result['msg'] = $error -> getMessage();
            
         }finally{
            
            return $result;
         }
        }
    }
?>