<!--作者部分-->
<?php
require_once './php/method/mysqlPreprocess.php';
if (!empty($number)) {
    $sql = "SELECT introduce,nickname,headshot,usernumber 
            from users 
            where username = (SELECT author from items where number = ?) ";
    $result = mysqlPreprocess($link, $sql, 'i', $number);
    if (!empty($result)) {
        $userdata = $result[0];
        $result = null;
    }
}
?>
<?php if (!empty($userdata)) : ?>
    <a href="navigation.php?s=<?php echo $userdata['nickname']; ?>&ta=author">
        <div class="author">
            <img src="<?php echo $userdata['headshot']; ?>" class="author_head">
            <div class="author_content">
                <h4>作者：<?php echo $userdata['nickname']; ?></h4>
                <p><?php echo $userdata['introduce']; ?></p>
            </div>
        </div>
    </a>
<?php endif ?>