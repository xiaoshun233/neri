<?php

$sql = "SELECT name,headshot,nickname,cover,number,hits,collection,praise
        FROM items as a,users as b 
        WHERE a.author = b.username and a.type = ? 
        order by number desc LIMIT 8";//查询语句
include_once "./php/method/mysqlPreprocess.php";
$data = mysqlPreprocess($link,$sql,'s',$type);
foreach($data as $value):
?>
    <div class='items'>
        <a href='main.php?number=<?php echo $value["number"];?>'>
            <div class='item_top'>
                <img data-src='<?php echo $value["cover"];?>'>
                <span class='item_title'><?php echo $value["name"];?></span>
            </div>
        </a>
            <div class='item_center'>
                <div class='author'>
                    <img data-src='<?php echo $value["headshot"];?>'>
                    <span><?php echo $value["nickname"];?></span>
                </div>
            </div>
            <div class='item_bottom'>
                <span class='list_title'><?php echo $type;?></span>
                <div class='lists'>
                    <span class='item_list1'><i class='fa-regular fa-eye'></i><?php echo $value["hits"];?></span>
                    <span class='item_list2'><i class='fa-regular fa-star'></i><?php echo $value["collection"];?></span>
                    <span class='item_list3'><i class='fa-regular fa-heart'></i><?php echo $value["praise"];?></span>
                </div>
            </div>
    </div>";
<?php endforeach;?>