<?php


class User
{
    private $username;
    private $password;
    private $checkPassword;
    private $nickname;
    private $regtime;
    private $permissions;
    private $headshotPath;
    private $headshotData;
    private $introduce;
    private $usernumber;
    private $usertoken;
    private $useremail;
    private $userkey;

    public function set($name, $value)
    {
        if (empty($value)) {
            $this->$name = null;
            return;
        }

        if ($name == "headshotData") {
            $value = str_replace(" ", "+", $value);
        }
        $this->$name = $value;
    }

    public function get($name)
    {
        return $this->$name;
    }


    /* 用户登录 */
    public function login($userip, $useragent)
    {
        require "./../link/public/mysql.php";
        require_once "./../method/mysqlPreprocess.php";
        require_once "./../method/token.php";
        //判断用户名和密码是否匹配
        try {
            $result = false;
            $this->encryptpassword();
            $sql = "SELECT username 
                    from users 
                    where (username = ? and password = ?) or (useremail = ? and password = ?);";
            $row = mysqlPreprocess($link, $sql, "ssss", $this->username, $this->password, $this->username, $this->password);
            if (empty($row)) {
                throw new Exception('用户名或密码错误');
            }
            if (!($this->updatatoken($userip, $useragent))) {
                throw new Exception('更新用户token失败');
            }

            $result = $this->get('userkey');
            $link->commit();
        } finally {
            return $result;
        }
    }


    public function encryptpassword()
    {
        require_once "./../method/encrypt.php";
        $this->password = encrypt($this->password, $this->username);
        if (!empty($this->checkPassword)) {
            $this->checkPassword = encrypt($this->checkPassword, $this->username);
        }
    }


    /* 用户注册 */
    public function register()
    {
        try {
            require "./../link/public/mysql.php";
            require_once "./../method/checkString.php";
            require_once "./../method/base64Img.php";
            require_once "./../method/mysqlPreprocess.php";
            $result = ["result" => "", "status" => false, "msg" => ""];
            if (empty($this->username)) {
                throw new Exception('输入用户名为空');
            }
            //获取密码
            if (empty($this->password)) {
                throw new Exception('输入密码为空');
            }
            //判断用户名和密码是否符合长度
            if (!checkLength($this->username, 4, 16) || !checkLength($this->password, 6, 18)) {
                throw new Exception('用户名或密码长度不符合要求');
            }
            //用户名和密码是否含有非法字符
            $ReUsername = "/^[a-zA-Z0-9_]/";
            if (!checkLegitimate($this->username, $ReUsername)) {
                throw new Exception('用户名中包含非法字符');
            }
            $RePassword = "/^[a-zA-Z0-9.@$!%*#_~?&^]/";
            if (!checkLegitimate($this->password, $RePassword)) {
                throw new Exception('密码中包含非法字符');
            }
            //检查昵称长度,字符是否合法
            $ReNickname = "/^[a-zA-Z0-9_.@$!%*#_~?&^\x7f-\xff]/";
            if (!checkLength($this->nickname, 2, 10) || !checkLegitimate($this->nickname, $ReNickname)) {
                throw new Exception('请检查昵称长度,或含有非法字符');
            }

            //检查邮箱输入
            $Reemail = '/^[a-zA-Z0-9]+([-_.][a-zA-Z0-9]+)*@([a-zA-Z0-9]+[-.])+([a-z]{2,5})$/ims';
            if (!checkLegitimate($this->useremail, $Reemail)) {
                throw new Exception('邮箱格式不正确');
            }
            $ReUsername = $RePassword = $ReNickname = $Reemail = null;
            //确认密码 
            if (empty($this->checkPassword)) {
                throw new Exception('请输入确认密码');
            }
            //判断两次输入密码
            if ($this->password !== $this->checkPassword) {
                throw new Exception('两次输入的密码不一致');
            }
            $this->encryptpassword();
            //检查用户名
            $row = mysqlPreprocess($link, "select username from users where (username= ?)", 's', $this->username);
            //判断用户名是否存在
            if (!empty($row)) {
                throw new Exception('用户名或邮箱已存在');
            }
            //获取图片数据
            $headshotdata = empty($this->headshotData);
            if (!$headshotdata) {
                //提取后缀名
                $type_name = getimgsuffix($this->headshotData);
                if (empty($type_name) || !preg_match('/^(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$/', $type_name)) {
                    throw new Exception('图片格式不正确');
                }
                //分割字符串,取basesrc后面的内容解码
                $file_head = explode(',', $this->headshotData);
                //base64解码
                $data = base64_decode($file_head[1]);
                //设置文件的保存路径   
                $this->headshotPath = 'images/head_img/' . iconv('UTF-8', 'gbk', basename('head_' . (md5($this->username)) . '.' . $type_name)); //拼接存储地址和名称
            } else {
                $this->headshotPath = 'images/head_img/head_normal.png';
            }

            //获取当前时间
            $this->regtime = date('Y-m-d');
            $sql = "INSERT into users 
                    (username,password,nickname,regtime,headshot,useremail)
                    values(?,?,?,?,?,?)";
            $sqlresult = mysqlPreprocess($link, $sql, 'ssssss', $this->username, $this->password, $this->nickname, $this->regtime, $this->headshotPath, $this->useremail); //储存信息至数据库
            $filePutCheck = true;
            if (!$headshotdata) {
                $filePutCheck = file_put_contents("./../../{$this->headshotPath}", $data); //将用户上传的文件保存到本地目录中
            }
            if (!$sqlresult || !$filePutCheck) {
                throw new Exception('未知错误', 1);
            }
            if (!($link->commit())) {
                throw new Exception('提交失败', 1);
            }
            $result["status"] = true;
            $result["msg"] = '注册成功,请重新登录';
        } catch (Exception $error) {
            $result["msg"] = $error->getMessage();
            if ($error->getCode() == 1) {
                $link->rollback();
                if (!$headshotdata) {
                    unlink("./../../{$this->headshotPath}");
                }
            }
        } finally {
            $link->close();
            return $result;
        }
    }


    public function setHeadshot()
    {
        require_once "./../method/mysqlPreprocess.php";
        require "./../link/public/mysql.php";
        $result = mysqlPreprocess($link, "SELECT headshot from users where (username = ?)", 's', $this->username);
        $link->close();
        if (empty($result)) {
            $this->headshotPath = 'images/head_img/head_normal.png';
        } else {
            $this->headshotPath = $result[0]['headshot'];
        }
    }


    public function setNickname()
    {
        require_once "./../method/mysqlPreprocess.php";
        require "./../link/public/mysql.php";
        $result = mysqlPreprocess($link, "SELECT nickname from users where (username = ?)", 's', $this->username);
        $link->close();
        if (empty($result)) {
            $this->nickname = "昵称";
        } else {
            $this->nickname = $result[0]['nickname'];
        }
    }


    public function getTokenData()
    {
        require_once "./../method/mysqlPreprocess.php";
        require "./../link/public/mysql.php";
        $sql = "SELECT nickname,headshot,regtime,permissions,signtime,username,introduce,nekoprice
                from users where usertoken = ?";
        $result = mysqlPreprocess($link, $sql, 's', $this->usertoken);
        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function getusernumber($userkey): int|bool
    {
        require_once "./../method/mysqlPreprocess.php";
        require "./../link/public/mysql.php";
        $this->encryptuserkey($userkey);
        $sql = "SELECT usernumber from users where usertoken = ?";
        $result = mysqlPreprocess($link, $sql, 's', $this->usertoken);
        if (empty($result)) {
            return false;
        }
        $number = $result[0]['usernumber'];
        $this->usernumber = $number;
        return $number;
    }

    //设置用户token
    public function updatatoken($userip, $useragent): bool
    {
        require "./../link/public/mysql.php";
        require_once "./../method/mysqlPreprocess.php";
        $this->userkey = md5(uniqid(microtime(true), true));
        setToken('usertoken', encrypt($this->userkey, $userip . $useragent));
        $sql = "UPDATE users 
                set usertoken = ? 
                where username = ?";
        $updatetoken = mysqlPreprocess($link, $sql, 'ss', getToken('usertoken'), $this->username);
        if ($updatetoken) {
            $link->commit();
            return true;
        } else {
            return false;
        }
    }



    //更新用户签到时间
    public function checksignin(): bool
    {
        require "./../link/public/mysql.php";
        require_once "./../method/mysqlPreprocess.php";
        try {
            $result = false;
            $sql = "SELECT signtime 
                    from users 
                    where usertoken = ?";
            $result = mysqlPreprocess($link, $sql, 's', $this->usertoken);
            if (!$result) {
                throw new Exception("查询用户数据失败");
            }
            $signflag = floor((strtotime("now") - strtotime($result[0]['signtime'])) / 86400);
            $signflag = $signflag > 0 ? true : false;
            if (!$signflag) {
                throw new Exception("已经签到过了");
            }
            $sql = "UPDATE users 
                    set signtime = ? 
                    where usertoken = ?";
            $updatetoken = mysqlPreprocess($link, $sql, 'ss', date('Y-m-d'), $this->usertoken);
            if ($updatetoken) {
                $link->commit();
                $result = true;
            } else {
                throw new Exception("数据更新失败");
            }
        } catch (Exception $e) {
            $result = false;
        } finally {
            return $result;
        }
    }
    //增加用户黑猫币
    public function addprice()
    {
        require "./../link/public/mysql.php";
        require_once "./../method/mysqlPreprocess.php";
        $randprice =  rand(1, 2);
        $sql = "UPDATE users 
                set nekoprice = nekoprice + ? 
                where usertoken = ?";
        $updatetoken = mysqlPreprocess($link, $sql, 'is', $randprice, $this->usertoken);
        if ($updatetoken) {
            $link->commit();
            return true;
        } else {
            return false;
        }
    }

    //更新用户简介信息
    public function updateNicknameIntroudce()
    {
        require "./../link/public/mysql.php";
        require_once "./../method/mysqlPreprocess.php";
        $this->encryptuserkey($this->userkey);
        $sql = "UPDATE users
                set nickname = ?,introduce = ?
                where usertoken = ?";
        $result = mysqlPreprocess($link, $sql, 'sss', $this->nickname, $this->introduce, $this->usertoken);
        if ($result) {
            $link->commit();
            return true;
        } else {
            return false;
        }
    }

    //获取用户key,ip,agent,将key转换成token
    private function encryptuserkey($userkey)
    {
        require_once './../method/encrypt.php';
        require_once './../method/getuserip.php';
        $token = getUserIP() . $_SERVER['HTTP_USER_AGENT'];
        $usertoken = encrypt($userkey, $token);
        $this->set('usertoken', $usertoken);
        return $usertoken;
    }

    public function usercollection()
    {
        require "./../link/public/mysql.php";
        require_once "./../method/mysqlPreprocess.php";
        try {
            $data = [];
            $sql = "SELECT collectionid,nickname,itemnumber,itemname,itemcover,collectiontime
                from view_collection 
                where usernumber = ?
                order by collectionid desc"; //查询语句
            $data = mysqlPreprocess($link, $sql, 's', $this->usernumber);
        } finally {
            return $data;
        }
    }

    public function deleteCollection($collectionid)
    {
        require "./../link/public/mysql.php";
        require_once "./../method/mysqlPreprocess.php";
        try {
            $sql = "DELETE from collection where usernumber = ? and collectionid = ?";
            $result = mysqlPreprocess($link, $sql, 'ii', $this->usernumber, $collectionid);
            if (!$result) {
                throw new Exception('delete collection fail');
            }
            $link->commit();
            return true;
        } catch (Exception $e) {
            $link->rollback();
            return false;
        }
    }

    public function deleteComment($commentid)
    {
        require "./../link/public/mysql.php";
        require_once "./../method/mysqlPreprocess.php";
        try {
            $sql = "DELETE from comments where usernumber = ? and commentid = ?";
            $result = mysqlPreprocess($link, $sql, 'ii', $this->usernumber, $commentid);
            if (!$result) {
                throw new Exception('delete comment fail');
            }
            $link->commit();
            return true;
        } catch (Exception $e) {
            $link->rollback();
            return false;
        }
    }

    public function usercontribute()
    {
        require "./../link/public/mysql.php";
        require_once "./../method/mysqlPreprocess.php";
        try {
            $data = [];
            $sql = "SELECT itemnumber,name as itemname,cover as itemcover,collection,comments,praise,hits
                from view_items 
                where authornumber = ?
                order by itemnumber desc"; //查询语句
            $data = mysqlPreprocess($link, $sql, 's', $this->usernumber);
        } finally {
            return $data;
        }
    }

    public function usercomment()
    {
        require "./../link/public/mysql.php";
        require_once "./../method/mysqlPreprocess.php";
        try {
            $data = [];
            $sql = "SELECT content,itemnumber,itemname,commenttime,commentid
                from view_comments 
                where usernumber = ?
                order by commentid desc"; //查询语句
            $data = mysqlPreprocess($link, $sql, 's', $this->usernumber);
        } finally {
            return $data;
        }
    }

    public function updateheadshot()
    {
        require_once "./../method/base64Img.php";
        require "./../link/public/mysql.php";
        require_once "./../method/mysqlPreprocess.php";
        try {
            $updataflag = false;
            $sql = "SELECT username,headshot from users where usernumber = ?";
            $result = mysqlPreprocess($link, $sql, 's', $this->usernumber)[0];
            if (empty($result)) {
                throw new Exception('用户不存在');
            }
            $this->username = $result['username'];
            if ($result['headshot'] !== 'images/head_img/head_normal.png') {
                $this->headshotPath = $result['headshot'];
            } else {
                $type_name = getimgsuffix($this->headshotData);
                if (empty($type_name) || !preg_match('/^(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$/', $type_name)) {
                    throw new Exception('图片格式不正确');
                }
                $this->headshotPath = 'images/head_img/' . iconv('UTF-8', 'gbk', basename('head_' . (md5($this->username)) . '.' . $type_name));
                $updataflag = true;
            }
            $file_head = explode(',', $this->headshotData);
            $data = base64_decode($file_head[1]);
            $filePutCheck = file_put_contents("./../../{$this->headshotPath}", $data);
            if (!$filePutCheck) {
                throw new Exception('文件写入失败');
            }
            if ($updataflag) {
                $sql = "UPDATE users 
                        set headshot = ? 
                        where usernumber = ?";
                $checkupdate = mysqlPreprocess($link, $sql, 'si', $this->headshotPath, $this->usernumber);
                if (!$checkupdate) {
                    throw new Exception('更新失败');
                }
            }
            $link->commit();
            return true;
        } catch (Exception $e) {
            if ($updataflag) {
                unlink("./../../{$this->headshotPath}");
            }
            $link->rollback();
            return false;
        }
    }
}
