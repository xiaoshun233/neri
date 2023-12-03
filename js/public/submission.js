// 节流完整版，可选前缘节流或延迟节流
function throttle(fn, delay, isImmediate = true){
    // isImmediate 为 true 时使用前缘节流，首次触发会立即执行，为 false 时使用延迟节流，首次触发不会立即执行
    let last = Date.now();
    return function (){
        let now = Date.now();
        if(isImmediate){
            fn.apply(this, arguments);
            isImmediate = false;
            last = now;
        }
        if(now - last >= delay){
            fn.apply(this, arguments);
            last = now;
        }
    }
}



//检查登录函数
function check(){//检查是否登录
    $.ajax({
    type: "post", //接收方式
    url: "php/detect_4.php",  //地址  
    data: {},//提交到后端的数据
    dataType: "json",//数据格式
    async: false,//异步传输
    success: function(check){
        login_check=check;
    },
    error:function(check){
        console.log(check);
    }
    });
    return login_check;
}

function cleartips(){
    tips.innerHTML = ""
}

let Formtipclear = throttle(cleartips,2000,true)
let Form = document.querySelector('.submission')
Form.addEventListener('input',Formtipclear)
//投稿表单提交
let FormBtn=document.getElementsByClassName("upload")[0];//获取form表单提交按钮
FormBtn.addEventListener("click",judge);//绑定事件
let tips = document.querySelector('.tips');//绑定提示框
//点击表单按钮做对应的操作函数
function judge() {
    if(!check()){//检测登录
        tips.innerHTML="请先登录"; 
        return false;
    }//检测标题
    let title = document.getElementById('input_title');
    if(title.value==""||title.value==null){
        tips.innerHTML="标题不能为空"; 
        return false;
    }//检测简介
    let about = document.getElementById('input_about');
    if(about.value==""||about.value==null){
        tips.innerHTML="简介不能为空"; 
        return false;
    }//检测封面
    let cover = document.getElementById('img_cover');
    if(cover==""||cover==null){
        tips.innerHTML="封面图不能为空"; 
        return false;
    }//检测下载链接有其中一个不为空
    let baidu = document.getElementById('baidu');
    let od = document.getElementById('od');
    if((baidu.value==""||baidu.value==null)&&(od.value==""||od.value==null)){
        tips.innerHTML="下载链接必须有一个不为空"; 
        return false;
    }
    let outlink_names = document.querySelectorAll('.outlink_name');
    let outlink_links = document.querySelectorAll('.outlink_link');
    //对应链接内容不能为空
    if(checks(outlink_names,outlink_links)){
        tips.innerHTML = "对应链接内容不能为空"
        return false;
    }//对应链接名字不能为空
    if(checks(outlink_links,outlink_names)){
        tips.innerHTML = "对应链接名字不能为空"
        return false;
    }
    tips.innerHTML = "";//清除提示
    let outlinks = Array()//将outlink整合成数组对象
    for(i=0;i<outlink_names.length;i++){
        if(outlink_names[i].value!=""&&outlink_links[i].value!=""){
            outlinks.push(
                {
                "outlink_name":outlink_names[i].value,
                "outlink_link":outlink_links[i].value
                }
            );
        }
    }
    let img_about = document.querySelectorAll('.img_about');
    let about_imgs = Array()
    for(i=0;i<img_about.length;i++){
        about_imgs.push(img_about[i].src)
    }
    let type = document.querySelector('.select');
    const upload_url = "http://www.neri.com:3000/个人收集（部分）/neri的小窝/test/test6.php";
    const formdata = {
        "title":title.value,
        "type":type.value,
        "about":about.value,
        "cover":cover.src,
        "baidu":baidu.value,
        "od":od.value,
        "outlinks":outlinks,
        "about_imgs":about_imgs
    }
    // document.querySelector(".upload").disabled=true;
    console.log(loadXMLDoc(upload_url,formdata));
}

//检查x.value和y.value都为空或都不为空
function checks(x=null,y=null){
    for(i=0;i<x.length;i++){
        if(x[i].value==""&&y[i].value==""){
            continue;
        }
        if(x[i].value!=""||x[i].value!=null){
            if(y[i].value==""||y[i].value==null){
                return true;
            }
        }
    }
    return false;
}
module.exports.loadXMLDoc = loadXMLDoc();
//ajax与后端php进行数据交互
function loadXMLDoc(Url="",data=void 0)
{
	const xhr=new XMLHttpRequest();
    let result
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState==4 && xhr.status==200)
		{
			result = JSON.parse(xhr.responseText) ;
		}
	}
	xhr.open("post",`${Url}`,false);
    const StrData = JSON.stringify(data);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send(`data=${StrData}`);
    return result;
}

//添加外部连接
let AddOutlink = document.querySelector('.add_outlink');
AddOutlink.addEventListener('click',outlink_focus)
function outlink_focus(){
    let count = document.querySelectorAll('.outlinks div');
    if(count.length >= 3)return;
    let outlink_name = document.querySelector(".outlinks div:last-child input:nth-last-child(2)");
    let outlink_link = document.querySelector(".outlinks div:last-child input:nth-last-child(1)");
    if(outlink_name.value!=""&&outlink_link.value!=""){
        let newlink = "<div>链接名称:<input type='text' name='outlink_name' class='outlink_name'>链接地址:<input type='text' name='outlink_link' class='outlink_link'></div>";
        $(".outlinks").append(newlink)
    }else{
        tips.innerHTML = `请先输入第${count.length}个输入框的外部链接`
    }
}
// 内容截图上传
let	file_box = document.getElementsByClassName('preview_box')[0];
let file_tips = document.querySelector('#img_tips');
$("#img_input").on("change", function(file_image){
    var file = file_image.target.files[0]; //获取图片资源
    // 只选择图片文件
    if (!file.type.match('image.*')) {
    return false;
    }
    var reader = new FileReader();
    reader.readAsDataURL(file); // 读取文件
    // 渲染文件
    reader.onload = function(arg) {
        count_file = document.querySelectorAll(".preview").length;
        if(count_file<4){ //只允许上传四张
            var img = '<div class="img_box"><img class="preview img_about" src="' + arg.target.result + '"><a href="javascript:;" class="remove_file"><i class="fa-solid fa-xmark"></i></a></div>';//创建展示上传的img
            $(".preview_box").append(img);//出现内容
            delect_text();//绑定删除图片事件
        }
    }
});
//删除图片
function delect_text(){
    var as = document.querySelectorAll(".remove_file");
    for (var i = 0; i < as.length; i++) {
        as[i].onclick = function () {
            file_box.removeChild(this.parentNode);}
    }
}
//封面图预览
$(".cover_img").on("change", function(cover){
var file = cover.target.files[0]; //获取图片资源
// 只选择图片文件
if (!file.type.match('image.*')) {
    return false;
}
var reader = new FileReader();
reader.readAsDataURL(file); // 读取文件
// 渲染文件
reader.onload = function(arg) {
    var img = '<img src="' + arg.target.result + '"id="img_cover">';
    $(".cover_preview").empty().append(img);
}
});