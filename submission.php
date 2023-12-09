<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "./php/link/public/session.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿页面</title>
    <link rel="icon" href="images/title_ico/title_3.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/banner.css" type="text/css">
    <link rel="stylesheet" href="css/submission.css" type="text/css">
    <!-- 引入导航栏和页脚css -->
    <?php require "./php/link/public/public-css.php"; ?>
    <!-- 引入图标库 -->
    <?php require "./php/link/public/icon.php"; ?>
    <!-- 引入jq库 -->
    <?php require "./php/link/public/jquery.php"; ?>
    <!-- 引入cropperjs -->
    <?php require "./php/link/public/cropperjs.php"; ?>
    <!-- 引入bootstrap -->
    <?php require "./php/link/public/bootstrap.php"; ?>
    <!-- 引入php连接数据库 -->
    <?php require "./php/link/public/mysql.php"; ?>
</head>

<body>
    <!-- 头部导航栏 -->
    <?php require "./php/link/public/nav.php"; ?>
    <div class="main">
        <!-- 投稿表单 -->
        <form class="submission">
            <div class="title">标题：<input type="text" id="input_title"></div>
            <div class="type">
                <label for="type">分类:</label>
                <select id="type" class="select">
                    <option value="小说">小说</option>
                    <option value="漫画">漫画</option>
                    <option value="动画">动画</option>
                    <option value="游戏">游戏</option>
                </select>
                <div class="about"><span>简介:</span><textarea id="input_about"></textarea></div>
            </div>
            <div class="cover">封面图:<input type="file" class="cover_img" id="cover">
                <label for="cover" class="img_input_css">上传图片</label>
                <div class="cover_preview"></div>
            </div>
            <div class="img_file">内容截图:
                <label for="img_input" class="img_input_css" id="img_tips">上传图片</label><span class="img_file_tips">(最多上传四张)</span>
                <input type="file" id="img_input" accept="image/*">
                <div class="preview_box">
                    <div class="file_message"></div>
                </div>
            </div>
            <div class="download">
                百度网盘:<input type="text" id="baidu" name="baidu">
                OD网盘:<input type="text" id="od" name="od">
            </div>
            <div class="outlink">
                <div class="outlinks">外部链接:
                    <div>链接名称:<input type="text" name="outlink_name" class="outlink_name">链接地址:<input type="text" name="outlink_link" class="outlink_link"></div>
                </div>
                <div class="add_outlink"><i class="fa-solid fa-plus"></i></div>
            </div>
            <input type="button" value="提交" class="upload">
            <span class="tips"><?php if (isset($from_message)) {
                                    echo $from_message;
                                } ?></span>
        </form>
        <!--广告部分-->
        <div class="banner">
            <ul id="btn" class="turn_1">
                <li><img src="./images/advertising/btn_1.jpg"></li>
                <li><img src="./images/advertising/btn_2.png"></li>
                <li><img src="./images/advertising/btn_3.png"></li>
            </ul>
            <div class="btn_click">
                <button class="btn_first" id="btn_click_1">1</button>
                <button id="btn_click_2">2</button>
                <button id="btn_click_3">3</button>
            </div>
        </div>
    </div>
    <!-- 页脚 -->
    <div id="footer">
        <p>Copyright © 2023-？ neri＆xiaoshun</p>
        <p>本页面资料均来自互联网，并不代表本人观点，仅供学习使用，禁止商业用途 请于下载后24小时内删除，若喜欢请支持正版。</p>
    </div>
    <!--侧边按钮-->
    <?php require "./php/link/public/sidebutton.php"; ?>
    <script src="./js/public/public.js" type="module"></script>
    <script src="./js/public/submission.js" type="module"></script>
    <script src="./js/public/banner.js"></script>
    <!-- 看板娘 -->
    <?php require "./php/link/public/kanban.php"; ?>
</body>

</html>