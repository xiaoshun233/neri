<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<div class="scrollBar">&nbsp;</div>
<style>
    #user{
        width: 1080px;
        height: 800px;
        margin: 100px auto;
        border-radius:10px;
        display: flex;
    }
    #user-nav{
        width: 20%;
        height: 100%;
        border-radius: 10px 0 0 10px;
        background-color: #f2f2f2;
    }
    #user-item{
        width: 80%;
        height: 100%;
        border-radius: 0 10px 10px 0;
        background-color: #f8f8f8;
    }
    #user-nav-top{
        width: 90%;
        height: 20%;
        margin: 0 auto;
        border-bottom: 1px soild #111111;
    }
    #user-nav-bottom{
        width: 90%;
        height: 80%;
        margin: 0 auto;
    } 
    #user-headshot{
        text-align: center;
        margin-top: 10%;
    }
    #user-headshot img{
        width: 80px;
        height: 80px;
        border-radius: 50%;
    }
    #user-nickname,#user-attend{
        text-align: center;
        margin-top: 4%;
        font-family: "微软雅黑";
    }
    #user-nickname span{
        font-size: 16px;
        font-weight: 700;
    }
    #user-attend div{
        width: 100px;
        height: 20px;
        margin: 0 auto;
        font-size: 14px;
        background-color: #dddddd;
        line-height: 20px;
        color: #ffffff;
        border-radius: 50px;
        text-align: center;
    }
    #user-attend span{
        color:#aaaaaa;
        font-size: 12px;
        letter-spacing: 1px;
    }
</style>
<div id="user">
    <div id='user-nav'>
        <div id="user-nav-top">
            <div id="user-headshot">
                <img src="images/head_img/head_1.png" alt="headshot">
            </div>
            <div id="user-nickname">
                <span>丶salty</span>
            </div>
            <div id="user-attend">
                <div>签到</div>
                <span>签到送0-5黑猫币</span>
            </div>
        </div>
        <div id="user-nav-bottom">

        </div>
    </div>
    <div id="user-item">

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
<script src="./js/public/public.js" type="module"></script>
</html>