//关灯开灯
import { createCounter } from './../method/createCounter.js';
const lightcounter = createCounter(0);
const lightbutton = document.querySelector('.commond_3');
lightbutton.addEventListener('click',function(){
    const buttonicon = document.querySelector('.commond_3 .fa-solid');
    const body = document.querySelector('body');
    if(lightcounter.getcrement()%2==0){
        buttonicon.classList.remove('fa-moon');
        buttonicon.classList.add('fa-sun');
        body.style.backgroundColor = "rgba(0,0,0,0.5)";
    }
    else{
        buttonicon.classList.remove('fa-sun');
        buttonicon.classList.add('fa-moon');
        body.style.backgroundColor = "rgba(254,254,254,0.5)";
    }
    lightcounter.increment();
})
//返回顶部
const buttontop =  document.querySelector('.commond_1');
buttontop.addEventListener('click',return_top);
function return_top(){
    window.scroll({top:0,left:0,behavior:'smooth'})
}
const buttonbottom =  document.querySelector('.commond_2');
buttonbottom.addEventListener('click',return_bottom);
//回到底部
function return_bottom(){
    const t1 = document.body.clientHeight;
    window.scroll({ top: t1,left:0, behavior:'smooth'});
}
//时间栏
setInterval (function(){
    var time = document.getElementById('time');
    time.innerHTML=now_time();
},1000);
function now_time(){
    var year = new Date().getFullYear();
    var month = new Date().getMonth() + 1;
    var date = new Date().getDate();
    var hour = new Date().getHours();
    var minute = new Date().getMinutes();
    var time_now = '时间：'+year+'年'+month+'月'+date+'日'+hour+'时'+minute+'分';
    return time_now;
}
//搜索栏
var search = document.querySelector('.search_text');
search.addEventListener('click',search_click)
function search_click(){
    if (search.value == ""){
        window.location.href="search.php"; 
    }
    else{
        message = document.getElementsByClassName('search_text')[0].value;
        window.location.href = "navigation.php?s="+message+"";
    }
}
import {checklogin} from './../method/checklogin.js';
import {getCookie,setCookie} from './../method/cookie.js';
import {loadXMLDoc} from './../method/ajax.js';


window.addEventListener('load',function(){
    const navuser = document.querySelector('.user_center');
    const navlogin = document.querySelector('.goto_login');
    const usermode = checklogin();
    if(!usermode){
        navlogin.style.display = 'block'
        return;
    }
    const key = getCookie('userkey');
    let result = loadXMLDoc('../../php/interface/getuserdata.php',key,'post');
    if(!result['status']){
        navlogin.style.display = 'block'
        return;
    }
    let userdata = result['result'];
    result = null;
    navuser.style.display = 'block';

    const headshot = document.querySelectorAll('.headshot');
    const nickname = document.querySelector('.nickname');
    const vip = document.querySelector('.vip');
    const regtime = document.querySelector('#regtime');
    for (let i = 0; i < headshot.length; i++) {
        headshot[i].src = userdata['headshot'];
    }
    nickname.innerHTML = userdata['nickname'];
    vip.innerHTML = userdata['permissions'];
    regtime.innerHTML = userdata['regtime'];
    
    const exitlogin = document.querySelector('.exit_login')
    exitlogin.addEventListener('click',function(){
        setCookie('userkey','',-3600);
        location.reload();
    })
})

