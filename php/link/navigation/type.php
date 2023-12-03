<?php
if(isset($_GET['type'])){
    switch ($_GET['type']){
        case 'novel':
            $class = 'novel';
            $type = '小说';
            break;
        case 'comic':
            $class = 'comic';
            $type = '漫画';
            break;
        case 'anime':
            $class = 'anime';
            $type = '动画';
            break;
        case 'game':
            $class = 'game';
            $type = '游戏';
            break;
        default:
            $type=$class='';
    }
}else{
    $type=$class='';
}
?>