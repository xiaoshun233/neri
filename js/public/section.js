//超链接页内跳转
const navigatebutton = document.querySelectorAll('.navigate_main_2 button');
for (let i = 0; i < navigatebutton.length; i++) {
    navigatebutton[i].addEventListener('click', function () {
        const selectorname = `#turn_${i + 1}`
        let turn = document.querySelector(selectorname).offsetTop;
        window.scroll({ top: turn - 100, left: 0, behavior: 'smooth' });
    });
}
let downloadaddress;
const downloadbutton = document.querySelectorAll('.download button')
for (let i = 0; i < downloadbutton.length; i++) {
    downloadbutton[i].addEventListener('click', function () {
        const downloadtext = document.querySelector(`#link_text_${i + 1}`);
        if (downloadaddress[i] == "") {
            downloadtext.innerHTML = "链接为空(等待管理员添加)";
        }
        else {
            downloadtext.innerHTML = downloadaddress[i]
        }
    })
}

import { loadXMLDoc } from "../method/ajax.js";
import { getCookie } from "../method/cookie.js";
import { getQueryString } from "./../method/getQueryString.js"
import { checklogin } from "./../method/checklogin.js";
import { Popup } from "../class/popup.js";
window.addEventListener('load', function () {
    const commentbutton = document.querySelector('.comment-input-button');
    const heartbutton = document.querySelector('.content-button-heart');
    const collectionbutton = document.querySelector('.content-button-collection');
    try {
        let userstate = checklogin();
        if (!userstate) {
            throw new Error('未登录');
        }

        //获取下载地址
        const downloadform = {
            userkey: getCookie('userkey'),
            number: getQueryString('number')
        }
        let result = loadXMLDoc('../../php/interface/downloadaddress.php', downloadform, 'post');
        if (result) {
            downloadaddress = [result['baidu_link'], result['od_link']];
        }
        else {
            downloadaddress = ["", ""]
        }


        //5s后判断内容点击量增加
        setTimeout(function () {
            loadXMLDoc('../../php/interface/add-Articlehits.php', getQueryString('number'), 'post');
        }, 5000);


        heartbutton.addEventListener('click', heartclick);
        collectionbutton.addEventListener('click', collectionclick);
        //收藏按钮点击事件
        function collectionclick() {
            const tips = new Popup();
            tips.setyescollback(function () {
                const data = {
                    userkey: getCookie('userkey'),
                    number: getQueryString('number')
                }
                let result = loadXMLDoc('../../php/interface/add-Articlecollection.php', data, 'post');
                if (result['status']) {
                    tips.alert('neri的小窝', '收藏成功');
                }
                else {
                    tips.alert('neri的小窝', result['msg']);
                }
            })
            tips.confirm('neri的小窝', '你确定要收藏吗？');
        }
        //点赞按钮点击事件
        function heartclick() {
            const tips = new Popup();
            tips.setyescollback(function () {
                const data = {
                    userkey: getCookie('userkey'),
                    number: getQueryString('number')
                }
                let result = loadXMLDoc('../../php/interface/add-Articlepraise.php', data, 'post');
                if (result) {
                    tips.alert('neri的小窝', '点赞成功,可以重复点赞噢');
                }
            });
            tips.confirm('neri的小窝', '你确定要点赞吗');
        }



        commentbutton.onclick = commentclick;
        //评论按钮点击事件
        function commentclick() {
            const comment = document.querySelector('.comment-input-textarea');
            const tips = new Popup();
            //评论内容不能超过100字
            if (comment.value.length > 100) {
                tips.alert('neri的小窝', '评论内容不能超过100字');
                return;
            }
            if (comment.value == "") {
                tips.alert('neri的小窝', '评论不能为空');
                return;
            }
            const data = {
                userkey: getCookie('userkey'),
                number: getQueryString('number'),
                comment: comment.value
            }
            let result = loadXMLDoc('../../php/interface/add-comment.php', data, 'post');
            if (result['status']) {
                tips.alert('neri的小窝', '评论成功');
                setTimeout(function () {
                    location.reload();
                }, 1000)
            }
            else {
                tips.alert('neri的小窝', '评论失败');
            }
        }

    }
    catch (e) {
        //未登录时的下载地址
        downloadaddress = ['请登录查看百度网盘', '请登录查看OD网盘'];
        //未登录时按钮绑定事件
        heartbutton.addEventListener('click', alertlogin);
        collectionbutton.addEventListener('click', alertlogin);
        commentbutton.addEventListener('click', alertlogin);
        function alertlogin() {
            const tips = new Popup();
            tips.alert('来自neri的小窝的提示', '请先登录');
        }
    }
})

// 输入框监听事件
{
    const comment = document.querySelector('.comment-input-textarea');
    comment.addEventListener('input', function () {
        const counter = document.querySelector('.comment-input-counter');
        counter.innerHTML = `${comment.value.length}/100`;
        if (comment.value.length > 100) {
            counter.style.color = 'red';
        }
        else {
            counter.style.color = 'black';
        }
    })
}