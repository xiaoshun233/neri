function getQueryString(name) {
    const url_string = window.location.href; // 获取get参数
    const url = new URL(url_string);
    return url.searchParams.get(name);
  }
let page=getQueryString('page');

let links,login_check;//变量定义
//获取链接地址
function link(){
    $.ajax({
    type: "post", //接收方式
    url: "php/detect_3.php",  //地址  
    data: {name:page},//提交到后端的数据
    dataType: "json",//数据格式
    async: false,//异步传输
    success: function(msg){
        if(msg!=''){
            links=msg;
            for(let i=0;i<msg.length;i++){
                if(msg[i]==''||msg[i]==null){
                    links[i] = '链接为空';
                    console.log("link is null");
                }   
            }
        }
    },
    error:function(msg){
        console.log(msg);
    }
    });
    return links;
}
//检查是否登录
function check(){
    $.ajax({
    type: "post", //接收方式
    url: "php/detect_4.php",  //地址  
    data: {},//提交到后端的数据
    dataType: "json",//数据格式
    async: false,//异步传输
    success: function(check){
        if(check!=''){
            login_check=check;
        }
    },
    error:function(check){
        console.log(check);
    }
    });
    return login_check;
}
//链接按钮变化
let count_1=count_2=0;
check();link();//返回变量设置成全局变量
let link_text_1=document.getElementById("link_text_1");
let link_text_2=document.getElementById("link_text_2");
if(login_check=='true'){
    function link_click_1(){ 
        count_1 = count_1 + 1;
        if (count_1%2 == 0){           
            link_text_1.innerHTML=""; 
        }
        else{
            link_text_1.innerHTML=links[0];
        }
    }
    function link_click_2(){
        count_2 = count_2 + 1;
        if(count_2%2 == 0){
            link_text_2.innerHTML="";
        }
        else{
            link_text_2.innerHTML=links[1];
        }
    }
}else{
    function link_click_1(){link_text_1.innerHTML="请登录查看"}
    function link_click_2(){link_text_2.innerHTML="请登录查看"}
}