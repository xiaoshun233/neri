<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户中心 ねりの小窝</title>
    <link rel="icon" href="images/title_ico/title_4.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/usercenter.css" type="text/css">
    <!-- 引入导航栏和页脚css -->
    <?php require "./php/link/public/public-css.php"; ?>
    <!-- 引入图标库 -->
    <?php require "./php/link/public/icon.php"; ?>
    <!-- 引入jq库 -->
    <?php require "./php/link/public/jquery.php"; ?>
    <!-- 引入php连接数据库 -->
    <?php require "./php/link/public/mysql.php"; ?>
</head>

<body id="top" class="light">
    <!-- 头部导航栏 -->
    <?php require "./php/link/public/nav.php"; ?>
    <div id="user">
        <div id='user-nav'>
            <div id="user-nav-top">
                <div id="user-headshot">
                    <img src="images/head_img/head_normal.png" alt="headshot">
                </div>
                <div id="user-nickname">
                    <span>昵称</span>
                </div>
                <div id="user-attend">
                    <div>签到</div>
                    <span>签到送1-2黑猫币</span>
                </div>
            </div>
            <div id="user-nav-bottom">
                <ul id="user-nav-item">
                    <li id="user-mydata">
                        <a href="?page=mydata">
                            <div class="icon"><i class="fa-regular fa-address-card"></i></div>
                            <span>我的资料</span>
                        </a>
                    </li>
                    <li id="user-collection">
                        <a href="?page=collection">
                            <div class="icon"><i class="fa-regular fa-star"></i></div>
                            <span>我的收藏</span>
                        </a>
                    </li>
                    <li id="user-contribute">
                        <a href="?page=contribute">
                            <div class="icon"><i class="fa-regular fa-file-lines"></i></div>
                            <span>我的投稿</span>
                        </a>
                    </li>
                    <li id="user-comment">
                        <a href="?page=comment">
                            <div class="icon"><i class="fa-regular fa-comment-dots"></i></div>
                            <span>我的评论</span>
                        </a>
                    </li>
                    <li id="user-buy">
                        <a href="?page=buy">
                            <div class="icon"><i class="fa-regular fa-clipboard"></i></div>
                            <span>购买记录</span>
                        </a>
                    </li>
                    <li id="user-support">
                        <a href="?page=support">
                            <div class="icon"><i class="fa-solid fa-yen-sign"></i></div>
                            <span>支持小窝</span>
                        </a>
                    </li>
                    <li id="user-record">
                        <a href="?page=record">
                            <div class="icon"><i class="fa-regular fa-newspaper"></i></div>
                            <span>捐助记录</span>
                        </a>
                    </li>
                    <li id="user-permission">
                        <a href="?page=permission">
                            <div class="icon"><i class="fa-regular fa-user"></i></div>
                            <span>用户权限</span>
                        </a>
                    </li>
                    <li id="user-alteremail">
                        <a href="?page=alteremail">
                            <div class="icon"><i class="fa-regular fa-envelope"></i></div>
                            <span>修改邮箱</span>
                        </a>
                    </li>
                    <li id="user-alterpassword">
                        <a href="?page=alterpassword">
                            <div class="icon"><i class="fa-solid fa-key"></i></div>
                            <span>修改密码</span>
                        </a>
                    </li>
                    <li id="user-exit">
                        <a href="javascript:void(0);">
                            <div class="icon"><i class="fa-solid fa-power-off"></i></div>
                            <span>安全退出</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="user-item">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : "";
            if ($page == "mydata") {
                require "./php/link/usercenter/item-mydata.php";
            } else if ($page == "collection") {
                require "./php/link/usercenter/item-collection.php";
            } else if ($page == "contribute") {
                // require "./php/link/usercenter/item-contribute.php";
            } else if ($page == "comment") {
                // require "./php/link/usercenter/item-comment.php";
            } else if ($page == "buy") {
                require "./php/link/usercenter/item-buy.php";
            } else if ($page == "support") {
                // require "./php/link/usercenter/item-support.php";
            } else if ($page == "record") {
                // require "./php/link/usercenter/item-record.php";
            } else if ($page == "permission") {
                require "./php/link/usercenter/item-permission.php";
            } else if ($page == "alteremail") {
                // require "./php/link/usercenter/item-alteremail.php";
            } else if ($page == "alterpassword") {
                // require "./php/link/usercenter/item-alterpassword.php";
            } else {
                require "./php/link/usercenter/item-mydata.php";
            }
            ?>
        </div>
    </div>
    <!--页脚-->
    <div id="footer">
        <p>Copyright © 2023-？ neri＆xiaoshun</p>
        <p>本页面资料均来自互联网，并不代表本人观点，仅供学习使用，禁止商业用途 请于下载后24小时内删除，若喜欢请支持正版。</p>
    </div>
    <!--侧边按钮-->
    <?php require "./php/link/public/sidebutton.php"; ?>
</body>
<script src="./js/public/usercenter.js" type="module"></script>
<script src="./js/public/public.js" type="module"></script>

</html>