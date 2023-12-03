<?php
include_once './php/method/mysqlPreprocess.php';
$num_rec_per_page=8;//每页显示数量
if(isset($_GET['type'])&&$type!=""):
    // 引入php连接数据库
    if (isset($_GET["page"])){
        if($_GET['page']<=1){
            $page = 1;
        }else{
            $page  = intval($_GET["page"]); }
    }else{
        $page=1; 
    }; //检测空值,填充、获取页数
    $start_from = ($page-1) * $num_rec_per_page; //从8*page开始获取，成页数比例增长
    $sql = "SELECT name,headshot,nickname,cover,number,hits
            FROM items as a,users as b 
            WHERE a.author = b.username  and a.type = ? 
            order by number desc LIMIT $start_from,$num_rec_per_page";//查询语句

    $data = mysqlPreprocess($link,$sql,'s',$type);
    foreach($data as $value):
    ?>
    <div class='items'>
        <a href='main.php?number=<?php echo $value["number"];?>'>
            <div class='item_top'>
                <img src='<?php echo $value["cover"];?>'>
                <span class='item_title'><?php echo $value["name"];?></span>
            </div>
        </a>
            <div class='item_center'>
                <div class='author'>
                    <img src='<?php echo $value["headshot"];?>'>
                    <span><?php echo $value["nickname"];?></span>
                </div>
            </div>
            <div class='item_bottom'>
                <span class='list_title'><?php echo $type;?></span>
                <div class='lists'>
                    <span class='item_list1'><i class='fa-regular fa-eye'></i><?php echo $value["hits"];?></span>
                    <span class='item_list2'><i class='fa-regular fa-comment'></i></span>
                    <span class='item_list3'><i class='fa-regular fa-heart'></i></span>
                </div>
            </div>
    </div>
    <?php endforeach;?>
    <?php endif;?>