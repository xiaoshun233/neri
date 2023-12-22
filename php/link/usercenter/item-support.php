<div class="item-support">
    <div class="item-support-graph">
        <div id="graph-div"><canvas id="graph"></canvas></div>
        <div id="graph-text">这是来自neri的小窝的数据统计</div>
    </div>
    <div class="item-support-tips">
        <div class="support-text">
            <p>建立的属于所有二次元爱好者的非盈利性站点。本站所有资源来源于互联网或用户自购，交换形式仅限本站积分，获取积分途径均来源于站内互动或活动。</p>
            <p class="import"> 此项并不能用来换取积分，也不会有实质性奖励，纯属自愿。</p>
            <p> 尽管如此若您依然愿意支持neri的小窝，在您力所能及的范围里，不论数额多少，我们都会非常感激。</p>
        </div>
        <div class="button-div"><button class="support-button">支持小窝</button></div>
    </div>
</div>
<link rel="stylesheet" href="./css/usercenter/item-support.css" type="text/css">
<script src="./js/method/chart.js/package/dist/chart.umd.js"></script>
<?php require "./php/link/public/mysql.php"; ?>
<?php require_once "./php/method/mysqlPreprocess.php"; ?>
<?php
$sql = "SELECT type,COUNT(itemnumber) as contents,SUM(collection) as collections,SUM(hits) as hits
        from view_items group by type";
$result = mysqlPreprocess($link, $sql, false);
?>
<script type="module">
    const canvas = document.querySelector('#graph');
    const config = {
        type: 'bar',
        data: {
            labels: ['novel（小说）', 'comic（漫画）', 'anime（动画）', 'game（游戏）'],
            datasets: [{
                label: '点击量',
                data: [<?php echo $result[0]['hits'] ?>, <?php echo $result[1]['hits'] ?>, <?php echo $result[2]['hits'] ?>, <?php echo $result[3]['hits'] ?>],
                backgroundColor: 'rgba(250,128,128,0.2)',
                borderColor: 'rgb(250,128,128)',
                borderWidth: 1,
                barThickness: 30,
                hoverBackgroundColor: 'rgba(149,162,255,0.4)',
                stack: 'Stack 1',
            }, {
                label: '收藏量',
                data: [<?php echo $result[0]['collections'] ?>, <?php echo $result[1]['collections'] ?>, <?php echo $result[2]['collections'] ?>, <?php echo $result[3]['collections'] ?>],
                backgroundColor: 'rgba(149,162,255,0.2)',
                borderColor: 'rgb(149,162,255)',
                borderWidth: 1,
                barThickness: 30,
                hoverBackgroundColor: 'rgba(250,128,128,0.4)',
                stack: 'Stack 1',
            }, {
                label: '内容数',
                data: [<?php echo $result[0]['contents'] ?>, <?php echo $result[1]['contents'] ?>, <?php echo $result[2]['contents'] ?>, <?php echo $result[3]['contents'] ?>],
                backgroundColor: 'rgba(255,192,118,0.2)',
                borderColor: 'rgb(255,192,118)',
                borderWidth: 1,
                barThickness: 30,
                hoverBackgroundColor: 'rgba(255,192,118,0.4)',
                stack: 'Stack 0',
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    stacked: true,
                }
            }
        }
    };
    const chart = new Chart(canvas, config);
    const supportbutton = document.querySelector('.support-button');
    import {
        Popup
    } from './js/class/popup.js';
    supportbutton.addEventListener('click', () => {
        const popup = new Popup();
        popup.alert('感谢您的支持！', '这是收款码，但是并没有什么用（就不放真的收款码了）');
    })
</script>