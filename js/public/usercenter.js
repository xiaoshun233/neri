import { getQueryString } from './../method/getQueryString.js';
import { exitlogin } from './../method/exitlogin.js';
import { getCookie } from './../method/cookie.js';
import { loadXMLDoc } from './../method/ajax.js';
window.addEventListener('load', function () {
    const createElement = (selector) => {
        return document.querySelector(selector)
    }

    let pagetype = getQueryString('page');
    if (pagetype) {
        const button = document.querySelector(`#user-${pagetype}`);
        const icon = document.querySelector(`#user-${pagetype} .icon`);
        icon.style.color = "#ffffff";
        button.style.backgroundColor = "#bbbbbb";
    }
    const key = getCookie('userkey');
    let userdata;
    if (key != "") {
        let result = loadXMLDoc('../../php/interface/getuserdata.php', key, 'post');
        if (!result) {
            location.href = 'login.php';
            return;
        }
        userdata = result['result'];
        createElement('#user-headshot img').src = userdata['headshot'];
        createElement('#user-nickname span').innerHTML = userdata['nickname'];
        createElement('#user-attend div').innerHTML = userdata['signtime'] ? "签到" : "已签到";
    }


    if (pagetype == "mydata") {
        createElement('#mydata-username').innerHTML = userdata['username'];
        createElement('#mydata-regtime').innerHTML = userdata['regtime'];
        createElement('#mydata-nickname').value = userdata['nickname'];
        createElement('#mydata-introduce').value = userdata['introduce'];
        createElement('#mydata-button').addEventListener('click', updateUserdata);
        function updateUserdata() {
            //验证
        }
    }
    else if (pagetype == "permission") {

    }
})
const exitbutton = document.querySelector('#user-exit');
exitbutton.addEventListener('click', exitlogin);

