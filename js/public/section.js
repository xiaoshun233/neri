//超链接页内跳转
const navigatebutton = document.querySelectorAll('.navigate_main_2 button');
for (let i = 0; i < navigatebutton.length; i++) {
    navigatebutton[i].addEventListener('click',function(){
        const selectorname = `#turn_${i+1}`
        let turn =document.querySelector(selectorname).offsetTop;
        window.scroll({ top: turn - 100, left: 0, behavior: 'smooth' });
    });    
}
let downloadaddress;
const downloadbutton = document.querySelectorAll('.download button')
for (let i = 0; i < downloadbutton.length; i++) {
    downloadbutton[i].addEventListener('click',function(){
        const downloadtext = document.querySelector(`#link_text_${i+1}`);
        if(downloadaddress[i]==""){
            downloadtext.innerHTML = "链接为空(等待管理员添加)";
        }
        else{
            downloadtext.innerHTML = downloadaddress[i]
        }
    })
}


import { loadXMLDoc } from "../method/ajax.js";
import { getCookie } from "../method/cookie.js";
import { getQueryString } from "./../method/getQueryString.js"
window.addEventListener('load',function(){
    const downloadform = {
        userkey:getCookie('userkey'),
        number:getQueryString('number')
    }
    let result = loadXMLDoc('../../php/interface/downloadaddress.php',downloadform,'post');
    if(result){
        downloadaddress = [result['baidu_link'],result['od_link']];
        result = null;
    }
    else{
        downloadaddress = ['请登录查看百度网盘','请登录查看OD网盘'];
    }
    //10s后判断内容点击量增加
    setTimeout(function(){

    },10000)
})
