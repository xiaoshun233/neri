//定义全局变量，动态获取元素
var btn_ul = document.getElementById('btn');
var btn_click_turn_1 = document.getElementById('btn_click_1');
var btn_click_turn_2 = document.getElementById('btn_click_2');
var btn_click_turn_3 = document.getElementById('btn_click_3');
//创建轮播效果
var btn_interval = setInterval(btn_img_change,5000);
//聚焦时和不聚焦时事件
function btn_interval_on(){
    btn_interval = setInterval(btn_img_change,5000);
}
function btn_interval_off(){
    clearInterval(btn_interval);
}
//轮播改变事件
function btn_img_change_1(){
    btn_ul.className = 'turn_1';
    btn_click_turn_1.className = 'btn_first';
    btn_click_turn_2.className = '';
    btn_click_turn_3.className = '';
}
function btn_img_change_2(){
    btn_ul.className = 'turn_2';
    btn_click_turn_1.className = '';
    btn_click_turn_2.className = 'btn_first';
    btn_click_turn_3.className = '';
}
function btn_img_change_3(){
    btn_ul.className = 'turn_3';
    btn_click_turn_1.className = '';
    btn_click_turn_2.className = '';
    btn_click_turn_3.className = 'btn_first';
}
//点击事件
btn_click_turn_1.onclick =function(){
    btn_img_change_1();
}
btn_click_turn_2.onclick =function(){
    btn_img_change_2();
}
btn_click_turn_3.onclick =function(){
    btn_img_change_3();
}
//判断图片位置
function btn_img_change(){
    if(btn_ul.className=='turn_1'){
        btn_img_change_2();
    }
    else if(btn_ul.className=='turn_2'){
        btn_img_change_3();
    }
    else if(btn_ul.className=='turn_3'){
        btn_img_change_1();
    }
}