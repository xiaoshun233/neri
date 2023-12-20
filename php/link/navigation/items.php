<?php
if (!empty($where)) :
    include_once './php/method/mysqlPreprocess.php';
    $num_rec_per_page = 8; //每页显示数量
    // 引入php连接数据库
    if (!isset($_GET["page"])) {
        $page = 1;
    } else if ($_GET['page'] <= 1) {
        $page = 1;
    } else {
        $page  = intval($_GET["page"]);
    }
    //检测空值,填充、获取页数
    $start_from = ($page - 1) * $num_rec_per_page; //从8*page开始获取，成页数比例增长
    $sql = "SELECT name,headshot,nickname,cover,itemnumber,hits,collection,praise,type,comments,praise
            from view_items 
            where FIND_IN_SET(itemnumber,?)
            order by itemnumber desc 
            LIMIT ?,?"; //查询语句

    $data = mysqlPreprocess($link, $sql, 'sii', $numbers, $start_from, $num_rec_per_page);
    foreach ($data as $value) :
?>
        <div class='items'>
            <a href='main.php?number=<?php echo $value["itemnumber"]; ?>'>
                <div class='item_top'>
                    <img src='<?php echo $value["cover"]; ?>'>
                    <span class='item_title'><?php echo $value["name"]; ?></span>
                </div>
            </a>
            <div class='item_center'>
                <div class='author'>
                    <a href="navigation.php?s=<?php echo $value['nickname']; ?>&ta=author">
                        <img src='<?php echo $value["headshot"]; ?>'>
                        <span><?php echo $value["nickname"]; ?></span>
                    </a>
                </div>
            </div>
            <div class='item_bottom'>
                <span class='list_title'><?php echo $value['type']; ?></span>
                <div class='lists'>
                    <span class='item_list1'><i class='fa-regular fa-eye'></i><?php echo $value["hits"]; ?></span>
                    <span class='item_list2'><i class='fa-regular fa-heart'></i><?php echo $value["praise"]; ?></span>
                    <span class='item_list3'><i class='fa-regular fa-comment'></i><?php echo $value["comments"]; ?></span>
                    <span class='item_list4'><i class='fa-regular fa-star'></i><?php echo $value["collection"]; ?></span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif ?>