<?php

$sql = "SELECT name,headshot,nickname,cover,itemnumber,hits,collection,praise,type,comments
        from view_items 
        where type = (SELECT alias from item_type where name =?)
        order by itemnumber desc limit 8"; //查询语句
require_once "./php/method/mysqlPreprocess.php";
$data = mysqlPreprocess($link, $sql, 's', $class);
foreach ($data as $value) :
?>
    <div class='items'>
        <a href='main.php?number=<?php echo $value["itemnumber"]; ?>'>
            <div class='item_top'>
                <img data-src='<?php echo $value["cover"]; ?>'>
                <span class='item_title'><?php echo $value["name"]; ?></span>
            </div>
        </a>
        <div class='item_center'>
            <div class='author'>
                <img data-src='<?php echo $value["headshot"]; ?>'>
                <span><?php echo $value["nickname"]; ?></span>
            </div>
        </div>
        <div class='item_bottom'>
            <span class='list_title'><?php echo $value['type']; ?></span>
            <div class='lists'>
                <span class='item_list1'><i class='fa-regular fa-eye'></i><?php echo $value["hits"]; ?></span>
                <span class='item_list2'><i class='fa-regular fa-comment'></i><?php echo $value["comments"]; ?></span>
                <span class='item_list3'><i class='fa-regular fa-star'></i><?php echo $value["collection"]; ?></span>
            </div>
        </div>
    </div>
<?php endforeach; ?>