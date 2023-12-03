<?php
include_once './php/method/mysqlPreprocess.php';
if(!empty($type)){
    $sql = "SELECT count(name) as total FROM items where type= ?";
    $data = mysqlPreprocess($link,$sql,'s',$type);
    if(!empty($data)){
        $total_records = $data[0]['total'];  //查询数据条数
        $total_pages = ceil($total_records / $num_rec_per_page); 
    }
}
if(isset($_GET['type'])&&$type!=""):
//获取最大页数
    if($page==1&&$total_pages-$page != 0){
        $arr = [1,2,3];
        $max = $total_pages;
    }
    else if($total_pages-$page == 1){
        $arr = [$page-1,$page,$page+1];
    }
    else if($total_pages-$page == 0){
        if($total_pages == 1){
            $arr=[1];
        }
        else{
            $arr = [$page-1,$page];
        }
    }
    else{
        $arr = [$page-1,$page,$page+1];
        $max = $total_pages;
    }
?>
    <a class='next' href='navigation.php?page=1&type=<?php echo $class?>'>首页</a>
    <?php foreach($arr as $value):?>
        <?php if($value == $page):?>
        <a href='navigation.php?page=<?php echo $value ?>&type=<?php echo $class ?>' class='now'><?php echo $value ?></a>
        <?php else:?>
        <a href='navigation.php?page=<?php echo $value ?>&type=<?php echo $class ?>'><?php echo $value ?></a>
        <?php endif ?>
    <?php endforeach;?>
    <?php 
        if(isset($max)){
            echo " ...<a href='navigation.php?page=".($max)."&type={$class}'>".($max)."</a> ";
        }
    ?>
    <a class='next' href='navigation.php?page=<?php echo $total_pages?>&type=<?php echo $class?>'>尾页</a>
<?php endif;?>
