<div class="comment-div">
    <!-- 评论输入框 -->
    <div class="comment-input">
        <textarea placeholder="请发表你的言论..." class="comment-input-textarea"></textarea>
        <div class="comment-input-counter">0/100</div>
        <button class="comment-input-button">发表</button>
    </div>
    <!-- 评论列表 -->
    <div class="comment-list">
        <?php
        if (isset($data) && isset($number)) {
            $number = intval($number);
            require_once './php/method/mysqlPreprocess.php';
            $sql = "SELECT content,commenttime,nickname,headshot from view_comments where itemnumber = ?";
            $comments = mysqlPreprocess($link, $sql, 'i', $number);
        }
        ?>
        <?php if (isset($comments)) foreach ($comments as $comment) : ?>
            <div class="comment">
                <div class="comment-text">
                    <div class="comment-content">
                        <span><?php echo $comment['content']; ?></span>
                    </div>
                    <div class="comment-details">
                        <span class="comment-date"><?php echo $comment['commenttime']; ?></span>
                        <span class="comment-user"><?php echo $comment['nickname']; ?></span>
                    </div>
                </div>
                <div class="comment-image">
                    <img src="<?php echo $comment['headshot']; ?>" alt="headshot" class="comment-headshot">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>