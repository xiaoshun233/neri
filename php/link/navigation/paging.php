<?php
include_once './php/method/mysqlPreprocess.php';
if (!empty($where) && $total_records != 0) :
    //获取最大页数
    $total_pages = ceil($total_records / $num_rec_per_page);
    if ($page > $total_pages) {
        $page = $total_pages;
    }
    if ($total_pages - $page < 2) {
        if ($page == 1) {
            $arr = range($page, $total_pages);
        } else {
            $arr = range($page - 1, $total_pages);
        }
    } else {
        if ($page == 1) {
            $arr = range($page, $page + 2);
        } else {
            $arr = range($page - 1, $page + 1);
        }
        $max = $total_pages;
    }
?>
    <a class='next' href='navigation.php?<?php echo $where ?>&page=1'>首页</a>
    <?php foreach ($arr as $value) : ?>
        <?php if ($value == $page) : ?>
            <a href='navigation.php?<?php echo $where ?>&page=<?php echo $value ?>' class='now'><?php echo $value ?></a>
        <?php else : ?>
            <a href='navigation.php?<?php echo $where ?>&page=<?php echo $value ?>'><?php echo $value ?></a>
        <?php endif ?>
    <?php endforeach; ?>
    <?php
    if (isset($max)) {
        echo " ...<a href='navigation.php?$where&page=$max'>$max</a> ";
    }
    ?>
    <a class='next' href='navigation.php?<?php echo $where ?>&page=<?php echo $total_pages ?>'>尾页</a>
<?php endif; ?>