//留言板
var message_text = document.querySelector("#message_text");
var message_ul = document.querySelector("#message_ul"); 
var message_click = document.querySelector("#message_click");
//删除文本
function delect_text(){
    var as = document.querySelectorAll(".remove_message");
    for (var i = 0; i < as.length; i++) {
        as[i].onclick = function () {
        message_ul.removeChild(this.parentNode);}
    }
}
//点击确认时提交留言板
message_click.onclick=function() {
    var year = new Date().getFullYear();
    var month = new Date().getMonth() + 1;
    var date = new Date().getDate();
    var message_date = year+"-"+month+"-"+date;      
    if (message_text.value == "") {
            alert("您没有输入内容");
            return;
    }else{
        var messages_li = document.createElement("li");
        messages_li.innerHTML = "<img src='images/head_normal.png'><div class='inline_block'>"+ message_text.value+"<p>"+message_name.value+"&emsp;&emsp;"+message_date+"</p></div>" + "<a href='javascript:;' class='remove_message'>删除</a>"
        message_text.value = "";
        message_ul.insertBefore(messages_li,message_ul.children[0]);
        delect_text();
    }
}
//进入页面时触发函数
window.onload = function(){
    delect_text();
    days_getnow();
}