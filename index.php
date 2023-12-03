<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "./php/link/public/session.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ねりの小窝</title>
    <link rel="icon" href="images/title_ico/title_1.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/header.css" type="text/css">
    <link rel="stylesheet" href="css/main.css" type="text/css">
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
<!--头部内容部分-->
<div id="header">
    <!--头部背景部分-->
    <div class="video">
        <video src="./images/video/Neri.mp4" autoplay="autoplay" loop="loop" muted="muted" class="video"></video>
    </div>
    <!--logo层部分-->
    <div class="logo">
        <span class="logo_little">ACGN</span>
        <span class="logo_big">ねりの小窝</span>
    </div>
</div>
<!--内容-->
<div id="main">
    <!--公告部分-->
    <div class="notice">
        <a href="main_text.html"><img data-src="./images/notice/notice_1.png">公告</a>
        <a href="#"><img data-src="./images/notice/notice_2.png">必看</a>
        <a href="#"><img data-src="./images/notice/notice_3.png">须知</a>
        <a href="#"><img data-src="./images/notice/notice_4.png">声明</a>
    </div>
    <!--小说部分-->
    <div class="novel">
        <h3>小说</h3>
        <div class="novel_ver">
        <?php $class = "novel";$type="小说"; ?>
        <?php require "./php/link/index/items.php"; ?>
        </div>
        <div class="more"><a href="navigation.php?type=novel">查看更多</a></div>
    </div>
    <!--漫画部分-->
    <div class="comic">
        <h3>漫画</h3>
        <div class="comic_ver">
        <?php $class = "comic";$type="漫画"; ?>
        <?php require "./php/link/index/items.php"; ?>
        </div>
        <div class="more"><a href="navigation.php?type=comic">查看更多</a></div>
    </div>
    <!--动画部分-->
    <div class="anime">
        <h3>动画</h3>
        <div class="anime_ver">
        <?php $class = "anime";$type="动画"; ?>
        <?php require "./php/link/index/items.php"; ?>
        </div>
        <div class="more"><a href="navigation.php?type=anime">查看更多</a></div>
    </div>
    <!--游戏部分-->
    <div class="game">
        <h3>游戏</h3>
        <div class="game_ver">
        <?php $class = "game";$type="游戏"; ?>
        <?php require "./php/link/index/items.php"; ?>
        </div>
        <div class="more"><a href="navigation.php?type=game">查看更多</a></div>
    </div>
</div>
<!--页脚-->
<div id="footer">
    <p>Copyright © 2023-？ neri＆xiaoshun</p>
    <p>本页面资料均来自互联网，并不代表本人观点，仅供学习使用，禁止商业用途 请于下载后24小时内删除，若喜欢请支持正版。</p>
</div>
<!--侧边按钮-->
<?php require "./php/link/public/sidebutton.php"; ?>
<!-- 主页js -->
<script src="./js/public/public.js" type="module"></script>
<script src="./js/public/index.js" type="module"></script>
<!-- 看板娘 -->
<?php require "./php/link/public/kanban.php"; ?>
</body>
</html>