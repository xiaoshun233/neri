<?php

class Article
{
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

    public function setvar($name, $value)
    {
        $this->$name = $value;
    }
    public function getvar($name)
    {
        return $this->$name;
    }

    public function setAll($name = "", $cover = "", $author = "", $type = "", $introduce = "", $downloadLinkBaidu = "", $downloadLinkOD = "", $externalLinks = "", $screenshot = "")
    {
        $this->name = $name;
        $this->cover = $cover;
        $this->author = $author;
        $this->type = $type;
        $this->introduce = $introduce;
        $this->downloadLinkBaidu = $downloadLinkBaidu;
        $this->downloadLinkOD = $downloadLinkOD;
        $this->externalLinks = $externalLinks;
        $this->screenshot = $screenshot;
    }
    public function getAll()
    {
        return $this;
    }


    //投稿文章
    public function Contributearticles()
    {
        require './../link/public/mysql.php';
        require_once './../method/mysqlPreprocess.php';
        // 提交基础信息
        $regbase64 = '/[:;,]/'; //分割base64图片
        $cover = preg_split($regbase64, $this->cover);
        $coverType = str_replace('image/', '', $cover[1]);
        $this->coverpath = 'images/' . $this->type . '_img/' . iconv('UTF-8', 'gbk', basename($this->type . '_' . (md5($this->name)) . '.' . $coverType)); //储存位置和命名
        $sql = "INSERT into items (name,cover,author,type) values (?,?,?,?)";
        $row = mysqlPreprocess($link, $sql, 'ssss', $this->name, $this->coverpath, $this->author, $this->type);
        if (!$row) {
            $link->rollback();
            return false;
        }
        $cover[3] = str_replace(' ', '+', $cover[3]);
        $coverBase64 = base64_decode($cover[3]);
        $filerow = file_put_contents("../../{$this->coverpath}", $coverBase64);
        if (!$filerow) {
            $link->rollback();
            return false;
        }

        //提交内容信息
        $externalLinksarr = array();
        for ($i = 0; $i < count($this->externalLinks); $i++) {
            array_push($externalLinksarr, $this->externalLinks[$i]->outlink_name, $this->externalLinks[$i]->outlink_link);
        }
        $this->externalLinks = implode(",", $externalLinksarr);
        $sql = "INSERT into message (name,introduce,baidu_link,od_link,inbound_link) values(?,?,?,?,?)";
        $row = mysqlPreprocess($link, $sql, 'sssss', $this->name, $this->introduce, $this->downloadLinkBaidu, $this->downloadLinkOD, $this->externalLinks);
        if (!$row) {
            $link->rollback();
            $this->deletefile($this->coverpath);
            return false;
        }

        //提交截图
        require_once './../method/base64toblob.php';
        for ($i = 0; $i < count($this->screenshot); $i++) {
            $content = base64_to_blob($this->screenshot[$i]);
            $sql = "INSERT into screenshot (content,contenttype,name) values (?,?,?)";
            $row = mysqlPreprocess($link, $sql, 'sss', $content['blob'], $content['type'], $this->name);
            if (!$row) {
                $link->rollback();
                $this->deletefile($coverpath);
                return false;
            }
        }

        //提交事务
        $link->commit();
        return true;
    }

    private function deletefile($path)
    {
        $result = unlink("../../$path");
        return $result;
    }

    // 提高点击数
    public function addhits()
    {
        require_once './../link/public/mysql.php';
        require_once './../method/mysqlPreprocess.php';
        try {
            $sql = "UPDATE items set hits = hits+1 where number = ?";
            $result = mysqlPreprocess($link, $sql, 'i', $this->getvar('number'));
            if ($result) {
                $link->commit();
            }
        } finally {
            return $result;
        }
    }

    // 提高点赞数
    public function addpraise()
    {
        require_once './../link/public/mysql.php';
        require_once './../method/mysqlPreprocess.php';
        try {
            $sql = "UPDATE items set praise = praise+1 where number = ?";
            $result = mysqlPreprocess($link, $sql, 'i', $this->getvar('number'));
            if ($result) {
                $link->commit();
            }
        } finally {
            return $result;
        }
    }

    public function addCollection($userkey)
    {
        require_once './../link/public/mysql.php';
        require_once './../method/mysqlPreprocess.php';
        require_once './../class/User.class.php';
        try {
            $user = new User();
            $usernumber = $user->getusernumber($userkey);
            $sql = "SELECT collectionid from collection where usernumber = ? and itemnumber = ?";
            $result = mysqlPreprocess($link, $sql, 'ii', $usernumber, $this->getvar('number'));
            if (count($result) > 0) {
                throw new Exception('已收藏');
            }
            $sql = "INSERT into collection (usernumber,itemnumber,collectiontime) values (?,?,?)";
            $result = mysqlPreprocess($link, $sql, 'iis', $usernumber, $this->getvar('number'), date("Y-m-d"));
            if ($result) {
                $link->commit();
                $result = true;
            } else {
                throw new Exception('收藏失败');
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        } finally {
            return $result;
        }
    }

    public function pulishcomment($userkey, $content)
    {
        require './../link/public/mysql.php';
        require_once './../method/mysqlPreprocess.php';
        require_once './../class/User.class.php';
        try {
            $user = new User();
            $usernumber = $user->getusernumber($userkey);
            if (!$usernumber) {
                throw new Exception('查询用户失败');
            }
            if (!($this->checkitemnumber())) {
                throw new Exception('查询文章失败,文章不存在');
            }
            $sql = "INSERT into comments (usernumber,itemnumber,commenttime,content) values (?,?,?,?)";
            $result = mysqlPreprocess($link, $sql, 'iiss', $usernumber, $this->getvar('number'), date("Y-m-d"), $content);
            if ($result) {
                $link->commit();
                $result = true;
            } else {
                throw new Exception('评论失败');
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        } finally {
            return $result;
        }
    }

    private function checkitemnumber(): bool
    {
        require './../link/public/mysql.php';
        require_once './../method/mysqlPreprocess.php';
        $sql = "SELECT count(number) as count from items where number = ?";
        $result = mysqlPreprocess($link, $sql, 'i', $this->number);
        if (empty($result)) {
            return false;
        } else {
            return true;
        }
    }
}
