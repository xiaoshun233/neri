import { getQueryString } from './../method/getQueryString.js';
import { exitlogin } from './../method/exitlogin.js';
import { getCookie } from './../method/cookie.js';
import { loadXMLDoc } from './../method/ajax.js';
import { Popup } from './../class/popup.js';
import { checklogin } from './../method/checklogin.js';
window.addEventListener('load', function () {
    let pagetype = getQueryString('page');
    const createElement = (selector) => {
        return document.querySelector(selector)
    }
    try {
        const userkey = getCookie('userkey');
        if (!userkey || !checklogin()) {
            throw new Error('请先登录,登录才能使用该功能<br/>即将跳转到登录页面');
        }

        if (!pagetype) {
            pagetype = 'mydata';
        }
        const button = document.querySelector(`#user-${pagetype}`);
        const icon = document.querySelector(`#user-${pagetype} .icon`);
        icon.style.color = "#ffffff";
        button.style.backgroundColor = "#bbbbbb";


        let result = loadXMLDoc('../../php/interface/getuserdata.php', userkey, 'post');
        let userdata = result['result'];
        createElement('#user-headshot img').src = userdata['headshot'];
        createElement('#user-nickname span').innerHTML = userdata['nickname'];
        createElement('#user-attend div').innerHTML = userdata['signtime'] ? "签到" : "已签到";
        if (userdata['signtime']) {
            createElement('#user-attend div').addEventListener('click', attend);
        }
        function attend() {
            const popup = new Popup();
            let result = loadXMLDoc('../../php/interface/signin.php', userkey, 'post');
            if (result['status']) {
                popup.alert('neri的小窝', '签到成功');
                setTimeout(() => location.reload(), 2000);
            } else {
                popup.alert('neri的小窝', '签到失败');
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
                const popup = new Popup();
                //昵称长度在2-10之间
                if (nickname.length < 2 || nickname.length > 10) {
                    popup.alert('neri的小窝', '昵称长度在2-10之间');
                    return;
                }
                // 昵称不能包含特殊字符
                if (/[^\u4e00-\u9fa5a-zA-Z0-9]/.test(nickname.value)) {
                    popup.alert('neri的小窝', '昵称不能包含特殊字符');
                    return;
                }
                //简介长度在1-50之间
                if (introduce.length < 1 || introduce.length > 100) {
                    popup.alert('neri的小窝', '简介长度在1-100之间');
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
                    popup.alert('neri的小窝', '修改成功');
                    setTimeout(() => location.reload(), 2000);
                }
                else {
                    popup.alert('neri的小窝', '修改失败');
                    updatebutton.addEventListener('click', updateUserdata);
                }
            }
        }

        else if (pagetype == "permission") {
            createElement('.permission-message .amount').innerHTML = userdata['nekoprice'];
            createElement('.permission-message .user-permission').innerHTML = userdata['permissions'];
        }

        else if (pagetype == "collection") {
            let result = loadXMLDoc('../../php/interface/select-usercollect.php', { userkey: userkey }, 'post');
            if (!result['status']) {
                throw new Error('获取收藏失败');
            }
            let collectiondata = result['result'];
            let collectionlist = createElement('.item-collection');
            collectiondata.forEach(element => {
                collectionlist.innerHTML += `
                <div class="item-collection-div">
                    <a href="main.php?number=${element['itemnumber']}">
                        <div class="item-collection-img"><img src="${element['itemcover']}"></div>
                        <div class="item-collection-title"><span class="title">${element['itemname']}</span></div>
                    </a>
                    <div class="item-collection-time"><span class="time">收藏于:${element['collectiontime']}</span></div>
                    <div class="item-collection-cancel"><span class="cancel" data-id="${element['collectionid']}">取消收藏</span></div>
                </div>`;
                let cancelbutton = document.querySelectorAll(`.item-collection-cancel .cancel`);
                function cancelcollection() {
                    let collectionid = this.dataset.id;
                    let result = loadXMLDoc('../../php/interface/delete-usercollect.php', { userkey: userkey, collectionid: collectionid }, 'post');
                    if (!result['status']) {
                        throw new Error('取消收藏失败');
                    }
                    const popup = new Popup();
                    popup.alert('neri的小窝', '取消收藏成功');
                    setTimeout(() => location.reload(), 2000);
                }
                cancelbutton.forEach(element => {
                    element.addEventListener('click', cancelcollection);
                });
            });
        }
    }
    catch (err) {
        const popup = new Popup();
        popup.alert('neri的小窝', err);
        setTimeout(() => location.href = 'login.php', 2000);
        return;
    }
    finally {
        createElement('#user-nav-top').style.visibility = 'visible';
        createElement('#user-nav-bottom').style.visibility = 'visible';
        createElement('#user-item>div').style.visibility = 'visible';
    }

})
const exitbutton = document.querySelector('#user-exit');
exitbutton.addEventListener('click', exitlogin);

