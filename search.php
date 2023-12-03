<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "./php/link/public/session.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>搜索页</title>
    <link rel="icon" href="images/title_ico/title_5.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/search.css" type="text/css">
    <?php require "./php/link/public/public-css.php"; ?>
    <?php require "./php/link/public/icon.php"; ?>
    <?php require "./php/link/public/jquery.php"; ?>
    <!-- 引入php连接数据库 -->
    <?php require "./php/link/public/mysql.php"; ?>
</head>
<body id="top" class="light">
<!-- 头部导航栏 -->
<?php require "./php/link/public/nav.php"; ?>
<!--搜索栏主要部分-->
<div class="main">
    <div class="main_search">
        <div class="item_search">
            <div class="item_search_left">
            <textarea class="text_search"></textarea><a href="javascript:location.reload();"><i class="fa-solid fa-magnifying-glass fa-2xl" id="search"></i></a>
            </div>
            <div class="item_search_right">
                <ul class="Searchre">
                </ul>
            </div>
        </div>
        <div class="category">
            <div class="category_top">
                <button id="search_1">全部</button>
                <button class="category_now" id="search_2">高级</button>
            </div>
            <div class="category_bottom" id="category_bottom">
                <p>搜索命名空间：</p>
            <div class="category_1">    
                <input type="checkbox">小说
                <input type="checkbox">漫画
                <input type="checkbox">游戏
                <input type="checkbox">动画
            </div>
            <div class="category_2">
                <input type="checkbox">作者
                <input type="checkbox">文章
            </div>
            <div class="category_3">
                <input type="checkbox">讨论
                <input type="checkbox">留言                   
            </div>
            </div>
        </div>
    </div>
</div>
<!--页脚-->
<div id="footer">
    <p>Copyright © 2023-？ neri＆xiaoshun</p>
    <p>本页面资料均来自互联网，并不代表本人观点，仅供学习使用，禁止商业用途 请于下载后24小时内删除，若喜欢请支持正版。</p>
</div>
<script src="./js/public/public.js" type="module"></script>
<script src="./js/public/search.js" type="module"></script>
<!-- 看板娘 -->
<?php require "./php/link/public/kanban.php"; ?>
</body>
</html>