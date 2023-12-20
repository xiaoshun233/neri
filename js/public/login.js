//鼠标点击效果
function lg_change_1() {
    document.getElementsByClassName('login')[0].className = "login change_appear";
    document.getElementsByClassName('time_mdw')[0].className += " time_disappear";
    document.getElementsByClassName('time_hm')[0].className += " time_disappear";
    setTimeout(function () {
        document.getElementsByClassName('login')[0].className += " change_bg";
        document.getElementsByClassName('login_bg')[0].className += " change_img"
    }, 10);
    setTimeout(function () {
        document.getElementsByClassName('login_head')[0].className += " item_appear";
        document.getElementsByClassName('name')[0].className += " item_appear";
        document.getElementsByClassName('modify')[0].className += " item_appear";
    }, 60);
}
let count = 0;
document.querySelector('.background-on').addEventListener('click', lg_change_1);
document.onkeydown = function (event) {
    var click_yes = document.querySelector('.login');
    count = count + 1;
    if ((count == 1) && (click_yes.className == "login")) {
        lg_change_1();
    }
    else {
        document.onkeydown = null;
    }
}


//背景时间效果
var time_mdw = document.getElementsByClassName('time_mdw')[0];
var time_hm = document.getElementsByClassName('time_hm')[0];
time_mdw.innerHTML = now_mdw();
time_hm.innerHTML = now_hm();
setInterval(function () {
    var time_hm = document.getElementsByClassName('time_hm')[0];
    time_hm.innerHTML = now_hm();
}, 1000);
function now_mdw() {
    var month = new Date().getMonth() + 1;
    var date = new Date().getDate();
    var week = new Date().getDay();
    var week_day = ""
    if (week == 0) {
        week_day = "星期日"
    } else if (week == 1) {
        week_day = "星期一"
    } else if (week == 2) {
        week_day = "星期二"
    } else if (week == 3) {
        week_day = "星期三"
    } else if (week == 4) {
        week_day = "星期四"
    } else if (week == 5) {
        week_day = "星期五"
    } else if (week == 6) {
        week_day = "星期六"
    }
    var time_mdw = '' + month + '月' + date + '日,' + week_day;
    return time_mdw;
}
function now_hm() {
    var hour = new Date().getHours();
    var minute = new Date().getMinutes();
    var minute_two = ""
    if (minute == 0) {
        minute_two = "00"
    } else if (minute == 1) {
        minute_two = "01"
    } else if (minute == 2) {
        minute_two = "02"
    } else if (minute == 3) {
        minute_two = "03"
    } else if (minute == 4) {
        minute_two = "04"
    } else if (minute == 5) {
        minute_two = "05"
    } else if (minute == 6) {
        minute_two = "06"
    } else if (minute == 7) {
        minute_two = "07"
    } else if (minute == 8) {
        minute_two = "08"
    } else if (minute == 9) {
        minute_two = "09"
    } else {
        minute_two = minute
    }
    var time_hm = hour + ':' + minute_two;
    return time_hm;
}



//注册
const sign = document.querySelector('#sign')
sign.addEventListener('click', enroll)
function enroll() {
    document.getElementsByClassName('enroll_password')[0].className = "enroll_password change_appear"
    document.getElementsByClassName('login_input')[0].className = "login_input change_appear";
    document.getElementsByClassName('login')[0].className = "login change_appear change_bg change_img";
    document.getElementsByClassName('enroll_enter')[0].className = "enroll_enter change_appear";
}


//js头像变换效果
const username = document.querySelector('#username');
username.addEventListener('blur', function () {
    let result = loadXMLDoc('../../php/interface/changeHeadshot.php', this.value);
    const loginhead = document.querySelector('#login-head');
    const nickname = document.querySelector('#nickname');
    loginhead.src = result['headshot'];
    nickname.innerHTML = result['nickname'];
})

window.onload = function () {
    //禁用重新提交表单 
    window.history.replaceState(null, null, window.location.href);
    //显示时间  
    var time_mdw = document.getElementsByClassName('time_mdw')[0];
    var time_hm = document.getElementsByClassName('time_hm')[0];
    time_mdw.innerHTML = now_mdw();
    time_hm.innerHTML = now_hm();
}

//检测判断用户名密码,非法字符
function CheckCharacter(str, re) {
    let result = re.test(str)
    return result
}
//判断字符串长度,是否符合要求
function CheakStrLength(str, min, max) {
    let Strlength = str.length
    const result = (Strlength >= min && Strlength <= max)
    return result;
}
//检查字符串不能为空
function CheakStrNotnull(str) {
    if (str === "" || str === null || str === void 0 || str === NaN) {
        return false
    }
    else {
        return true
    }
}


const enrolltips = document.querySelector(".enrolltips")//提示信息
//监听用户名输入是否合法
const enrolluname = document.querySelector('.login_textarea')
enrolluname.addEventListener('blur', () => {
    //检查用户名字符长度
    const str = enrolluname.value
    if (!CheakStrLength(str, 4, 16)) {
        enrolltips.innerHTML = "用户名长度限制为4-16个英文,数字,下划线"
        return
    }
    //检查非法字符
    const re = /^[a-zA-Z0-9_]/g
    if (!CheckCharacter(str, re)) {
        enrolltips.innerHTML = "用户名含有非法字符"
        return
    }
    enrolltips.innerHTML = ""
})


//监听密码输入是否合法
const enrollpassword = document.querySelector(".login_textarea_1")//注册密码
enrollpassword.addEventListener('blur', () => {
    let str = enrollpassword.value
    if (!CheakStrLength(str, 6, 18)) {
        enrolltips.innerHTML = "密码长度限制为6-18个英文,数字,@等特殊字符"
        return
    }
    const re = /^[a-zA-Z0-9.@$!%*#_~?&^]/
    if (!CheckCharacter(str, re)) {
        enrolltips.innerHTML = "密码含有非法字符"
        return
    }
    enrolltips.innerHTML = ""
})

//检查确认密码与注册密码
const enrollpassword2 = document.querySelector(".login_textarea_2")//确认密码
enrollpassword2.addEventListener('blur', () => {
    const re = (enrollpassword.value === enrollpassword2.value)
    if (!re) {
        enrolltips.innerHTML = "确认密码与注册密码不相同"
    }
    else {
        enrolltips.innerHTML = ""
    }
})


//检查昵称长度且不能含有非法字符
const enrollnickname = document.querySelector('.login_textarea_3')
enrollnickname.addEventListener('blur', () => {
    let str = enrollnickname.value
    if (!CheakStrLength(str, 2, 10)) {
        enrolltips.innerHTML = "昵称长度限制为2-10个英文,数字,汉字"
        return
    }
    const re = /^[a-zA-Z0-9_\u4e00-\u9fa5]/
    if (!CheckCharacter(str, re)) {
        enrolltips.innerHTML = "昵称含有非法字符"
        return
    }
    enrolltips.innerHTML = ""
})
import { loadXMLDoc } from './../method/ajax.js';
//提交表单时内容不能为空
const enrollBtn = document.querySelector(".enroll_enter");
enrollBtn.addEventListener('click', signIn);
const enrollmailtoken = document.querySelector('.login-mailtoken')
function signIn() {
    const formname = {
        username: "用户名",
        password: "注册密码",
        checkPassword: "确认密码",
        nickname: "昵称",
        useremail: "用户邮箱",
        mailtoken: "邮箱验证码",
    }
    const formdata = {
        username: enrolluname.value,
        password: enrollpassword.value,
        checkPassword: enrollpassword2.value,
        nickname: enrollnickname.value,
        useremail: enrollmail.value,
        mailtoken: enrollmailtoken.value,
    }
    for (let k in formname) {
        let tipresult = CheakStrNotnull(formdata[k])
        if (!tipresult) {
            enrolltips.innerHTML = `${formname[k]}不能为空`;
            return;
        }
    }
    if (CheakStrNotnull(baseSrc)) {
        formdata['headshot'] = baseSrc;
    }
    enrollBtn.removeEventListener('click', signIn);
    let result = loadXMLDoc('../../php/interface/register.php', formdata);
    if (result['status']) {
        enrolltips.innerHTML = result['msg'];
        setTimeout(() => {
            location.reload();
        }, 3000)
    }
    else {
        enrolltips.innerHTML = result['msg'];
        enrollBtn.addEventListener('click', signIn)
    }
}

import { setCookie } from './../method/cookie.js';
const login = document.querySelector('#login');
login.addEventListener('click', loginIn);
function loginIn() {
    let username = document.querySelector('#username').value;
    let password = document.querySelector('#password').value;
    const formdata = {
        username: username,
        password: password
    }
    let result = loadXMLDoc("../../php/interface/login.php", formdata);
    if (result['status']) {
        setCookie('userkey', result['result'], 7200);
        window.location.href = "index.php";
    }
    else {
        const logintip = document.querySelector('.login-tip')
        logintip.innerHTML = "用户名或密码错误";
    }
}
window.addEventListener('keyup', function (event) {
    if (event.key == 'Enter') {
        loginIn();
    }
});


const mailbutton = document.querySelector('.btn-mail')
const enrollmail = document.querySelector('.login-mail')
enrollmail.addEventListener('blur', () => {
    let str = enrollmail.value;
    const re = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
    if (!CheckCharacter(str, re)) {
        mailbutton.removeEventListener('click', getmailtoken)
        enrolltips.innerHTML = "邮箱格式不合法"
        return;
    }
    enrolltips.innerHTML = ""
    mailbutton.addEventListener('click', getmailtoken)
})


function getmailtoken() {
    mailbutton.removeEventListener('click', getmailtoken)
    mailbutton.style.opacity = 0.5;
    let time = 60;
    mailbutton.innerHTML = `获取邮箱验证码${time}`;
    let countdown = setInterval(function () {
        time = time - 1;
        mailbutton.innerHTML = `获取邮箱验证码${time}`;
        if (time <= 0) {
            mailbutton.innerHTML = "获取邮箱验证码";
            mailbutton.style.opacity = 1;
            mailbutton.addEventListener('click', getmailtoken);
            clearInterval(countdown);
        }
    }, 1000)
    const email = document.querySelector('.login-mail').value
    let result = loadXMLDoc('../../php/interface/emailcode.php', email);
    if (result) {
        enrolltips.innerHTML = "发送验证码成功";
    }
    else {
        enrolltips.innerHTML = "发送验证码失败";
    }
}
//创建头像弹出框
let popover_view;
function view_headshot() {
    setTimeout(function () {
        const view = document.getElementById('view')
        popover_view = new bootstrap.Popover(view, {
            placement: "right",
            trigger: "hover focus click",
            html: true,
            content: "<img src='" + baseSrc + "' class='view_img'>",
            container: ".login_input"
        })
        view.innerHTML = "查看头像"
    }, 0);
}
const success = document.querySelector('.cropperSucess');
success.addEventListener('click', view_headshot);