<div class="nav">
    <!-- 左侧快速导航栏 -->
    <ul>
        <li><a href="index.php" class="nav_1"><i class="fa-solid fa-torii-gate fa-xs"></i>首页</a></li>
        <li><a href="navigation.php?type=novel" class="nav_2"><i class="fa-solid fa-seedling fa-xs"></i>小说</a></li>
        <li><a href="navigation.php?type=comic" class="nav_3"><i class="fa-solid fa-leaf fa-xs"></i>漫画</a></li>
        <li><a href="navigation.php?type=anime" class="nav_4"><i class="fa-solid fa-cannabis fa-xs"></i>动画</a></li>
        <li><a href="navigation.php?type=game" class="nav_5"><i class="fa-solid fa-snowflake fa-xs"></i>游戏</a></li>
    </ul>
    <!-- 时间展示 -->
    <div class="div_time">
        <div class="time_top"><span id="time"></span></div>
        <div class="time_bottom">合理安排时间,享受健康生活。</div>
    </div>
    <!-- 搜索栏 -->
    <div class="search">
        <input type="text" class="search_text">
        <button class="search_button"><i class="fa-solid fa-magnifying-glass fa-lg"></i><span>搜索</span></button>
    </div>
    <!-- 用户展示 -->
    <a href='login.php' class='goto_login'>登录||注册</a>

    <div class="user_center">
        <img src="#" class="headshot">
        <div class="user_message">
            <div class="user_info">
                <img src="" class="headshot">
                <div class="nickname"></div>
                <div class="vip"></div>
            </div>
            <div class="regtime">
                <span>注册时间:</span>
                <span id="regtime"></span>
            </div>
            <a href="submission.php">
                <div class="submission_go"><i class="fa-solid fa-upload"></i>去投稿</div>
            </a>
            <a href="usercenter.php">
                <div class="homepage"><i class="fa-solid fa-user"></i>个人主页</div>
            </a>
            <div class="change_login">
                <div class="change_user"><a href='login.php'>变更用户</a></div>
                <div class="exit_login"><a href='javascript:void(0);'>退出登录</a></div>
            </div>
        </div>
    </div>
</div>