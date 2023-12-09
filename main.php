<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 引入php连接数据库 -->
    <?php require "./php/link/public/mysql.php"; ?>
    <?php require "./php/link/public/session.php"; ?>
    <?php require "./php/link/main/main-page.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($data)) echo $data['name']; ?> ねりの小窝</title>
    <link rel="icon" href="images/title_ico/title_3.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/text.css" type="text/css">
    <!-- 引入导航栏和页脚css -->
    <?php require "./php/link/public/public-css.php"; ?>
    <!-- 引入图标库 -->
    <?php require "./php/link/public/icon.php"; ?>
    <!-- 引入jq库 -->
    <?php require "./php/link/public/jquery.php"; ?>
</head>

<body id="top">
    <!-- 头部导航栏 -->
    <?php require "./php/link/public/nav.php"; ?>
    <div class="flex">
        <!--主要内容-->
        <div class="main">
            <?php require "./php/link/main/main-content.php"; ?>
        </div>
        <div class="main_right">
            <?php require "./php/link/main/author.php"; ?>
        </div>
    </div>
    <div class="navigate">
        <ul class="navigate_main_2">
            <li><button>&ensp;游戏简介&ensp;</button></li>
            <li><button>&ensp;游戏截图&ensp;</button></li>
            <li><button>&ensp;下载地址&ensp;</button></li>
            <li><button>&ensp;外部链接&ensp;</button></li>
        </ul>
    </div>
    <!--背景动画-->
    <div class="video"><video src="./images/video/Nowa.mp4" autoplay="autoplay" loop="loop" muted="muted" class="video"></video></div>
    <!--页脚-->
    <div id="footer">
        <p>Copyright © 2023-？ neri＆xiaoshun</p>
        <p>本页面资料均来自互联网，并不代表本人观点，仅供学习使用，禁止商业用途 请于下载后24小时内删除，若喜欢请支持正版。</p>
    </div>
    <!--侧边按钮-->
    <?php require "./php/link/public/sidebutton.php"; ?>
    <script src="./js/public/public.js" type="module"></script>
    <script src="./js/public/section.js" type="module"></script>
    <!-- 看板娘 -->
    <?php require "./php/link/public/kanban.php"; ?>
</body>

</html>