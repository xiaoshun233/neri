<?php require_once './php/method/mysqlPreprocess.php';?>
<h2><?php if(isset($data)) echo $data['name']; ?> </h2>
<div class="content_1">
    <h3 id="turn_1"><?php if(isset($data)) echo $data['type']; ?>简介</h3>
    <p style="text-indent: 0;">
    <?php if(isset($data)) echo $data['introduce'];?>
    </p>
</div>
<div class="content_2" id="content_2">
    <h3 id="turn_2"><?php if(isset($data)) echo $data['type'];?>截图</h3>
    <?php
    if(isset($data)){
        $sql = "SELECT * from screenshot where name=?";
        $result = mysqlPreprocess($link,$sql,'s',$data['name']);
        for($i=0;$i<count($result);$i++){
            echo "<img src='./php/interface/screenshot.php?img={$i}&number={$data['number']}'>";
        }//获得图片get
    }
    ?>
</div>
<div class="content_3" id="content_3">
    <h3 id="turn_3">下载地址</h3>
    <div class="download">
        <div class="download_type"><p>百度网盘</p></div>
        <div class="download_center">
            <button class="link_click" onclick="link_click_1()">链接</button>
            <span id="link_text_1"></span>
        </div>
        <div class="download_bottom">
            <span>仅供日语学习参考使用，下载后24小时后请及时删除(请勿在线解压)</span>
            <span>提取码：neri，解压码：neri的小窝</span>
        </div>
    </div>
    <div class="download">
        <div class="download_type"><p>Onedrive网盘</p></div>
        <div class="download_center">
            <button class="link_click" onclick="link_click_2()">链接</button>
            <span id="link_text_2"></span>
        </div>
        <div class="download_bottom">
            <span>仅供日语学习参考使用，下载后24小时后请及时删除(请勿在线解压)</span>
            <span>解压码：neri的小窝</span>
        </div>
    </div>            
</div>
<div class="content_4" id="content_4">
    <h3 id="turn_4">外部链接</h3>
    <p style="text-indent: 0;">
    <?php
    if(isset($data)){ //检查查询是否为空
    $outlink = $data['inbound_link'];
    $outlink = explode(',',$outlink);;
        for($i=0;$i<count($outlink);$i++){
            if($i%2==0){
                echo "{$outlink[$i]}:";
            }else{
                echo "<a href='{$outlink[$i]}' target='_blank'>{$outlink[$i]}</a><br>";
            }
        }
    }
    ?>
    <p>
</div>