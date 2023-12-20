<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "./php/link/public/session.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>欢迎！ ねりの小窝</title>
    <link rel="icon" href="images/title_ico/title_1.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css" type="text/css">
    <!-- 引入jq库 -->
    <?php require "./php/link/public/jquery.php"; ?>
    <!-- 引入bootstrap -->
    <?php require "./php/link/public/bootstrap.php"; ?>
    <!-- 引入php连接数据库 -->
    <?php require "./php/link/public/mysql.php"; ?>
</head>

<body>
    <!--登录背景图-->
    <a href="javascript:void(0);" class="background-on">
        <img src="./images/background/login.png" class="login_bg">
        <div class="time_hm"></div>
        <div class="time_mdw"></div>
    </a>
    <!--登录部分-->
    <div class="login">
        <div class="item_all">
            <img src="images/head_img/head_normal.png" class="login_head" id="login-head">
            <form action="login.php" method="POST" autocomplete="off">
                <p class="name" id="nickname">昵称</p>
                <input placeholder="请输入用户名..." type="text" id="username" class="username">
                <div class="login_password">
                    <input name="password" type="password" placeholder="请输入密码.." id="password">
                    <input type="button" class="login_password_enter" value="→" id="login">
                </div>
            </form>
            <div class="modify">
                <div class="login-tip"></div>
                <div><a href="index.php">游客登入</a><a href="javascript:;" id="sign">注册</a></div>
            </div>
        </div>
    </div>
    <!--输入框部分-->
    <div class="login_input">
        <div>
            <p class="prompt">注册用户名:</p>
            <input type="text" class="login_textarea" title="用户名为为4-16个英文,数字,下划线">
            <p class="prompt_1">昵称:</p>
            <input type="text" class="login_textarea_3" title="昵称长度为4-10个英文,数字,汉字">
            <p class="prompt_1">上传头像:</p>
            <input type="file" id="select-box" style="display: none;" id="file_head" accept="image/*">
            <label class="login_textarea">
                <div class="login-button"><span class="btn-box">上传</span></div>
                <span id="view">点击左侧上传头像</span>
            </label>
            <div class="enroll_password">
                <p class="prompt_1" maxlength="22">注册密码:</p>
                <input type="password" class="login_textarea_1" title="密码长度为6-18个英文,数字,@等特殊字符">
                <p class="prompt_2" maxlength="22">确认密码:</p>
                <input type="password" class="login_textarea_2">
            </div>
            <div class="enroll_mail">
                <p class="prompt_1">注册邮箱:</p>
                <input type="text" class="login-mail">
                <p class="prompt_2">邮箱验证码:</p>
                <div class="mail-token">
                    <input type="text" class="login-mailtoken">
                    <div class="login-button"><span class="btn-mail">获取邮箱验证码</span><span id="token-time"></span></div>
                </div>
            </div>
            <div class="box_enter">
                <input class="enroll_enter" type="button" value="注册" name="ls_sub">
                <span class="enrolltips"></span>
            </div>
        </div>
    </div>
    <!-- 引入cropperjs -->
    <?php require "./php/link/public/cropperjs.php"; ?>
    <script src="./js/public/login.js" type="module"></script>
</body>

</html>