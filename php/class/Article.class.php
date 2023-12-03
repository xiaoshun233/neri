<?php

class Article{
    private $name;
    private $cover;
    private $coverpath;
    private $author;
    private $type;
    private $number;
    private $hits;
    private $introduce;
    private $downloadLinkOD;
    private $downloadLinkBaidu;
    private $externalLinks;
    private $screenshot;
    private $typeEn;

    public function setvar($name,$value){
        $this->$name = $value;
    }
    public function getvar($name){
        return $this->$name;
    }

    public function setAll($name="",$cover="",$author="",$type="",$introduce="",$downloadLinkBaidu="",$downloadLinkOD="",$externalLinks="",$screenshot=""){
        $this-> name = $name;
        $this-> cover = $cover;
        $this-> author = $author;
        $this-> type = $type;
        $this-> introduce = $introduce;
        $this-> downloadLinkBaidu = $downloadLinkBaidu;
        $this-> downloadLinkOD = $downloadLinkOD;
        $this-> externalLinks = $externalLinks;
        $this-> screenshot = $screenshot;
        switch ($this->type){
            case '小说':$this->typeEn='novel';break;
            case '漫画':$this->typeEn='comic';break;
            case '动画':$this->typeEn='anime';break;
            case '游戏':$this->typeEn='game';break;
            default:$this->typeEn="";
        }
    }
    public function getAll()
    {
        return $this;
    }
    

    //投稿文章
    public function Contributearticles(){
        include './../link/public/mysql.php';
        include_once './../method/mysqlPreprocess.php';
        // 提交基础信息
        $row = mysqlPreprocess($link,"SELECT count(*) as count from items",false);
        $this ->number = $row[0]['count'];
        $regbase64 = '/[:;,]/';//分割base64图片
        $cover = preg_split($regbase64,$this->cover);
        $coverType = str_replace('image/','',$cover[1]);
        $this -> coverpath = 'images/'.$this->typeEn.'_img/'.iconv('UTF-8','gbk',basename($this->typeEn.'_'.(md5($this->name)).'.'.$coverType));//储存位置和命名
        $sql = "INSERT into items (name,cover,author,type,number) values (?,?,?,?,?)";
        $row = mysqlPreprocess($link,$sql,'sssss',$this->name,$this->coverpath,$this->author,$this->type,$this->number);
        if(!$row){
            $link -> rollback();
            return ["result"=>"$link->error","status"=>false,"msg"=>"基础信息上传错误"];
        }
        $cover[3] = str_replace(' ','+',$cover[3]);
        $coverBase64 = base64_decode($cover[3]);
        $filerow = file_put_contents("../{$coverpath}", $coverBase64);
        if(!$filerow){
            $link -> rollback();
            return ["result"=>"","status"=>false,"msg"=>"图片上传错误"];
        }

        //提交内容信息
        $externalLinksarr = array();
        for ($i=0; $i <count($this->externalLinks) ; $i++) { 
            array_push($externalLinksarr,$this->externalLinks[$i]->outlink_name,$this->externalLinks[$i]->outlink_link);
        }
        $this->externalLinks = implode(",",$externalLinksarr);
        $sql = "INSERT into message (name,introduce,baidu_link,od_link,inbound_link) values(?,?,?,?,?)";
        $row = mysqlPreprocess($link,$sql,'sssss',$this->name,$this->introduce,$this->downloadLinkBaidu,$this->downloadLinkOD,$this->externalLinks);
        if(!$row){
            $link -> rollback();
            $this->deletefile($coverpath);
            return ["result"=>"$link->error","status"=>false,"msg"=>"内容上传错误"];
        }

        //提交截图
        
        for($i=0;$i<count($this->screenshot);$i++){
            $arr = preg_split($regbase64,$this->screenshot[$i]);
            $arr[3] = str_replace(' ','+',$arr[3]);
            $Base64content=base64_decode($arr[3]);//base64解码
            $content = $link -> escape_string($Base64content);//转数据库字符串
            $sql = "INSERT into screenshot (content,content_type,name) values (?,?,?)";
            $row = mysqlPreprocess($link,$sql,'bss',$content,$arr[1],$this->name);
            if(!$row){
                $link -> rollback();
                $this->deletefile($coverpath);
                return ["result"=>"$link->error","status"=>false,"msg"=>"截图上传错误"];
            }
        }

        //提交事务
        $link -> commit();
        return ["result"=>"","status"=>true,"msg"=>"上传成功"];
    }

    private function deletefile($path){
        $result = unlink($path);
        return $result;
    }

}
?>