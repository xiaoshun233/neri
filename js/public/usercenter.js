import { getQueryString } from './../method/getQueryString.js';
import { exitlogin } from './../method/exitlogin.js'
window.addEventListener('load',function(){
    let pagetype = getQueryString('page');
    const button = document.querySelector(`#user-${pagetype}`);
    const icon = document.querySelector(`#user-${pagetype} .icon`);
    icon.style.color = "#ffffff"
    button.style.backgroundColor = "#bbbbbb"
})
const exitbutton = document.querySelector('#user-exit')
exitbutton.addEventListener('click',exitlogin)