<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 引入php连接数据库 -->
    <?php require "./php/link/public/mysql.php"; ?>
    <?php require "./php/link/navigation/type.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?>导航页 ねりの小窝</title>
    <link rel="icon" href="images/title_ico/title_2.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/navigation.css" type="text/css">
    <?php require "./php/link/public/public-css.php"; ?>
    <?php require "./php/link/public/icon.php"; ?>
    <?php require "./php/link/public/jquery.php"; ?>
</head>

<body id="top">
    <!-- 头部导航栏 -->
    <?php require "./php/link/public/nav.php"; ?>
    <!--内容部分-->
    <div class="main">
        <div class="head"><?php echo "{$title}导航页"; ?></div>
        <div class="marquee">
            <marquee>
                <b class="marquee_text">逸一时 ，误一世 , 逸久逸久 , 罢以龄。(因为学习暂停更新,不学习也不更新)</b>
            </marquee>
        </div>
        <div class="body">
            <div class="top">
                <h3>标签</h3>
                <div class="tags">
                    <a href="#" class="tag_free">恋爱</a>
                    <a href="#" class="tag_free">治愈</a>
                    <a href="#" class="tag_free">催泪</a>
                    <a href="#" class="tag_free">战斗</a>
                    <a href="#" class="tag_free">喜剧</a>
                    <a href="#" class="tag_free">乙女向</a>
                    <a href="#" class="tag_free">第三视角</a>
                </div>
                <h3>类型</h3>
                <div class="types">
                    <a href="#" class="type_free">视觉小说</a>
                    <a href="#" class="type_free">主机游戏</a>
                    <a href="#" class="type_free">RPG</a>
                    <a href="#" class="type_free">SLG</a>
                    <a href="#" class="type_free">手机移植</a>
                    <a href="#" class="type_free">switch</a>
                </div>
            </div>
            <div class="middle">
                <div class="item_ver">
                    <!-- 导航栏主要内容 -->
                    <?php require "./php/link/navigation/items.php"; ?>
                </div>
            </div>
            <div class="bottom">
                <div class="pages">
                    <!-- 分页 -->
                    <?php require "./php/link/navigation/paging.php"; ?>
                </div>
            </div>
        </div>
    </div>
    <!--页脚-->
    <div id="footer">
        <p>Copyright © 2023-？ neri＆xiaoshun</p>
        <p>本页面资料均来自互联网，并不代表本人观点，仅供学习使用，禁止商业用途 请于下载后24小时内删除，若喜欢请支持正版。</p>
    </div>
    <!--侧边按钮-->
    <?php require "./php/link/public/sidebutton.php"; ?>
    <script src="./js/public/public.js" type="module"></script>
    <!-- 看板娘 -->
    <?php require "./php/link/public/kanban.php"; ?>
</body>

</html>