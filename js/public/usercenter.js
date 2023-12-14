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
    const userkey = getCookie('userkey');
    let userdata;
    if (userkey != "") {
        let result = loadXMLDoc('../../php/interface/getuserdata.php', userkey, 'post');
        if (!result) {
            location.href = 'login.php';
            return;
        }
        userdata = result['result'];
        createElement('#user-headshot img').src = userdata['headshot'];
        createElement('#user-nickname span').innerHTML = userdata['nickname'];
        createElement('#user-attend div').innerHTML = userdata['signtime'] ? "签到" : "已签到";
        if (userdata['signtime']) {
            createElement('#user-attend div').addEventListener('click', attend);
        }
        function attend() {
            createElement('#user-attend div').removeEventListener('click', attend);
            let result = loadXMLDoc('../../php/interface/signin.php', userkey, 'post');
            if (result['status']) {
                createElement('#user-attend div').innerHTML = "已签到";
            } else {
                addEventListener('click', attend);
            }
        }
    }


    if (pagetype == "mydata") {
        createElement('#mydata-username').innerHTML = userdata['username'];
        createElement('#mydata-regtime').innerHTML = userdata['regtime'];
        createElement('#mydata-nickname').value = userdata['nickname'];
        createElement('#mydata-introduce').value = userdata['introduce'];
        let updatebutton = createElement('#mydata-button')
        updatebutton.addEventListener('click', updateUserdata);
        function updateUserdata() {
            let nickname = createElement('#mydata-nickname').value;
            let introduce = createElement('#mydata-introduce').value;
            let tip = createElement('#mydata-tip');
            //昵称长度在2-10之间
            if (nickname.length < 2 || nickname.length > 10) {
                tip.innerHTML = "昵称长度在2-10之间";
                return;
            }
            // 昵称不能包含特殊字符
            if (/[^\u4e00-\u9fa5a-zA-Z0-9]/.test(nickname.value)) {
                tip.innerHTML = "昵称不能包含特殊字符";
                return;
            }
            //简介长度在1-50之间
            if (introduce.length < 1 || introduce.length > 100) {
                tip.innerHTML = "简介长度在1-100之间";
                return;
            }
            updatebutton.removeEventListener('click', updateUserdata);
            let formdata = {
                'userkey': userkey,
                'nickname': nickname,
                'introduce': introduce,
            };
            let result = loadXMLDoc('../../php/interface/update-NicknameIntroduce.php', formdata, 'post');
            if (result['status']) {
                tip.innerHTML = "上传资料更新成功";
                setTimeout(() => location.reload(), 2000);
            }
            else {
                tip.innerHTML = "上传发生错误";
                updatebutton.addEventListener('click', updateUserdata);
            }
        }
    }
    else if (pagetype == "permission") {

    }
    createElement('#user-nav-top').style.visibility = 'visible';
    createElement('#user-nav-bottom').style.visibility = 'visible';
    createElement('#user-item>div').style.visibility = 'visible';
})
const exitbutton = document.querySelector('#user-exit');
exitbutton.addEventListener('click', exitlogin);

