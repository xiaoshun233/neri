window.onscroll = function(){
    change();
}  
//定义位移事件函数
function in_top(){
    document.getElementsByClassName('nav')[0].className ='nav';
    document.getElementById('return_top').className ='return_top transform_click';
    document.getElementById('return_bottom').className ='return_bottom';
}
function in_middle(){
    document.getElementsByClassName('nav')[0].className ='nav new';
    document.getElementById('return_top').className ='return_top';
    document.getElementById('return_bottom').className ='return_bottom'; 
}
function in_bottom(){
    document.getElementsByClassName('nav')[0].className ='nav new'
    document.getElementById('return_top').className ='return_top';
    document.getElementById('return_bottom').className ='return_bottom transform_click';
}
function change() {
    let height = document.documentElement.scrollTop;
    let window_height = window.screen.height;
    let header_height = document.querySelector('#header').scrollHeight;
    let footer_height = document.querySelector('#footer').offsetTop;
    if (height <= header_height) {
        in_top();
    }
    else if ((height > header_height)&&(height < (footer_height-window_height))){
        in_middle();
    }
    else{
        in_bottom();
    }
}
//进入页面时触发函数
    
    import { throttle } from './../method/throttle.js'
    import { lazyLoad } from './../method/lazyLoad.js';
    const imgs = document.querySelectorAll('img');
    window.addEventListener('load',throttle(function(){
        lazyLoad(imgs);
        change();
    },100))
    window.addEventListener('scroll',throttle(function(){
        lazyLoad(imgs);
    },100))