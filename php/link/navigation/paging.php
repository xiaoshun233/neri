<?php
include_once './php/method/mysqlPreprocess.php';
if (!empty($where) && $total_records != 0) :
    //获取最大页数
    $total_pages = ceil($total_records / $num_rec_per_page);
    if ($page == 1 && $total_pages - $page != 0) {
        $arr = [1, 2, 3];
        if ($total_pages != 3) {
            $max = $total_pages;
        }
    } else if ($total_pages - $page == 1) {
        $arr = [$page - 1, $page, $page + 1];
    } else if ($total_pages - $page <= 0) {
        if ($total_pages == 1) {
            $arr = [1];
        } else {
            $arr = [$page - 1, $page];
        }
    } else {
        $arr = [$page - 1, $page, $page + 1];
        if ($page <= $total_pages) {
            $max = $total_pages;
        }
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