<div id="item-buy">
    <div class="item-buy-title">
        <div class="item-buy-name">名称</div>
        <div class="item-buy-ordernumber">订单号</div>
        <div class="item-buy-price">金额（黑猫币）</div>
        <div class="item-buy-ordertime">时间</div>
        <div class="item-buy-check">操作</div>
    </div>
    <?php $data = []; ?>
    <?php foreach ($data as $v) : ?>
        <div class="item-buy-list">
            <div class="item-buy-name">名称</div>
            <div class="item-buy-ordernumber">订单号</div>
            <div class="item-buy-price">金额(黑猫币)</div>
            <div class="item-buy-ordertime">时间</div>
            <div class="item-buy-check"><a href="#">查看</a></div>
        </div>
    <?php endforeach; ?>
</div>
<link rel="stylesheet" href="./css/usercenter/item-buy.css" type="text/css">