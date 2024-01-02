import { getQueryString } from './../method/getQueryString.js';
import { exitlogin } from './../method/exitlogin.js';
import { getCookie } from './../method/cookie.js';
import { loadXMLDoc } from './../method/ajax.js';
import { Popup } from './../class/popup.js';
import { checklogin } from './../method/checklogin.js';
import { convertHtmlBreaks, convertLineBreaks } from './../method/convertbreaks.js';
window.addEventListener('load', function () {
    let pagetype = getQueryString('page');
    const selector = (selector) => {
        return document.querySelector(selector)
    }
    try {
        const userkey = getCookie('userkey');
        if (!userkey || !checklogin()) {
            throw new Error('请先登录,登录才能使用该功能');
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
        selector('#user-headshot img').src = userdata['headshot'];
        selector('#user-nickname span').innerHTML = userdata['nickname'];
        selector('#user-attend div').innerHTML = userdata['signtime'] ? "签到" : "已签到";
        if (userdata['signtime']) {
            selector('#user-attend div').addEventListener('click', attend);
        }
        function attend() {
            const popup = new Popup();
            let result = loadXMLDoc('../../php/interface/signin.php', userkey, 'post');
            if (result['status']) {
                popup.alert('neri的小窝', '签到成功');
                setTimeout(() => location.reload(), 1000);
            } else {
                popup.alert('neri的小窝', '签到失败');
            }
        }


        if (pagetype == "mydata") {
            selector('#mydata-username').innerHTML = userdata['username'];
            selector('#mydata-regtime').innerHTML = userdata['regtime'];
            selector('#mydata-nickname').value = userdata['nickname'];

            selector('#mydata-introduce').value = convertLineBreaks(userdata['introduce']);
            let updatebutton = selector('#mydata-button')
            updatebutton.addEventListener('click', updateUserdata);
            function updateUserdata() {
                let nickname = selector('#mydata-nickname').value;
                let introduce = convertHtmlBreaks(selector('#mydata-introduce').value);
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
                    setTimeout(() => location.reload(), 1000);
                }
                else {
                    popup.alert('neri的小窝', '修改失败');
                    updatebutton.addEventListener('click', updateUserdata);
                }
            }
        }

        else if (pagetype == "permission") {
            selector('.permission-message .amount').innerHTML = userdata['nekoprice'];
            selector('.permission-message .user-permission').innerHTML = userdata['permissions'];
        }

        else if (pagetype == "collection") {
            let result = loadXMLDoc('../../php/interface/select-usercollect.php', { userkey: userkey }, 'post');
            if (!result['status']) {
                throw new Error('获取收藏失败');
            }
            let collectiondata = result['result'];
            let collectionlist = selector('.item-collection');
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
            });

            let cancelbutton = document.querySelectorAll(`.item-collection-cancel .cancel`);
            function cancelcollection() {
                const popup = new Popup();
                popup.setyescollback(function () {
                    let result = loadXMLDoc('../../php/interface/delete-usercollect.php', { userkey: userkey, collectionid: collectionid }, 'post');
                    if (!result['status']) {
                        throw new Error('取消收藏失败');
                    }
                    popup.alert('neri的小窝', '取消收藏成功');
                    setTimeout(() => location.reload(), 1000);
                })
                let collectionid = this.dataset.id;
                popup.confirm('neri的小窝', '确定取消收藏吗？');
            }
            cancelbutton.forEach(element => {
                element.addEventListener('click', cancelcollection);
            });
        }

        else if (pagetype == "contribute") {
            let result = loadXMLDoc('../../php/interface/select-usercontribute.php', { userkey: userkey }, 'post');
            if (!result['status']) {
                throw new Error('获取投稿失败');
            }
            let contributedata = result['result'];
            let contributelist = selector('.item-contribute');
            contributedata.forEach(element => {
                contributelist.innerHTML += `
                <div class="item-contribute-div">
                <a href="main.php?number=${element['itemnumber']}">
                    <div class="contribute-cover" ><img src="${element['itemcover']}"></div>
                    <div class="contribute-title"><span>${element['itemname']}</span></div>
                    <div class="contribute-list">
                        <span class='item_list1'><i class='fa-regular fa-eye'></i>${element['hits']}</span>
                        <span class='item_list2'><i class='fa-regular fa-heart'></i>${element['praise']}</span>
                        <span class='item_list3'><i class='fa-regular fa-comment'></i>${element['comments']}</span>
                        <span class='item_list4'><i class='fa-regular fa-star'></i>${element['collection']}</span>
                    </div>
                </a>
                </div> `;
            });
        }

        else if (pagetype == "comment") {
            let result = loadXMLDoc('../../php/interface/select-usercomment.php', { userkey: userkey }, 'post');
            if (!result['status']) {
                throw new Error('获取评论失败');
            }
            let commentdata = result['result'];
            let commentlist = selector('#item-comment');
            commentdata.forEach(element => {
                commentlist.innerHTML += `        
                <div class="item-comment-list">
                    <div class="item-comment-content">${element['content']}</div>
                    <div class="item-comment-commentid">${element['commentid']}</div>
                    <div class="item-comment-articlename"><a href="main.php?number=${element['itemnumber']}">${element['itemname']}</a></div>
                    <div class="item-comment-ordertime">${element['commenttime']}</div>
                    <div class="item-comment-check"><span class="remove">删除</span></div>
                </div>`;
            });
            let removebutton = document.querySelectorAll(`.item-comment-check .remove`);
            function removecomment() {
                const popup = new Popup();
                let commentid = this.parentNode.parentNode.querySelector('.item-comment-commentid').innerHTML;
                popup.setyescollback(function () {
                    let result = loadXMLDoc('../../php/interface/delete-usercomment.php', { userkey: userkey, commentid: commentid }, 'post');
                    if (!result['status']) {
                        throw new Error('删除评论失败');
                    }
                    popup.alert('neri的小窝', '删除评论成功');
                    setTimeout(() => location.reload(), 1000);
                })
                popup.confirm('neri的小窝', '确定删除评论吗？');
            }
            removebutton.forEach(element => {
                element.addEventListener('click', removecomment);
            });
        }
    }
    catch (err) {
        const popup = new Popup();
        popup.alert('neri的小窝', err);
        this.setTimeout(() => location.href = 'index.php', 1000);
        return;
    }
    finally {
        selector('#user-nav-top').style.visibility = 'visible';
        selector('#user-nav-bottom').style.visibility = 'visible';
        selector('#user-item>div').style.visibility = 'visible';
    }

})
const exitbutton = document.querySelector('#user-exit');
exitbutton.addEventListener('click', exitlogin);

function croppercheck() {
    setTimeout(() => {
        const popup = new Popup();
        let image = baseSrc;
        popup.setyescollback(function () {
            let result = loadXMLDoc('../../php/interface/update-headshot.php', { userkey: getCookie('userkey'), headshot: image }, 'post');
            if (!result['status']) {
                throw new Error('修改头像失败');
            }
            popup.alert('neri的小窝', '修改头像成功');
            setTimeout(() => location.reload(), 1000);
        });
        popup.confirm('您要确认修改此头像吗？', `<img src="${image}" style="width: 50px;height: 50px;border-radius: 50%;">`);
    }, 0)
}
const success = document.querySelector('.cropperSucess');
success.addEventListener('click', croppercheck);