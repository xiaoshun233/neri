//图片裁剪
const image = document.getElementById('cropperImg');// 包装图像或画布元素
let options = {
    aspectRatio: 1, // 裁剪框的宽高比,默认NAN,可以随意改变裁剪框的宽高比
    viewMode:2,  // 0,1,2,3
    dragMode:'move', // 'crop': 可以产生一个新的裁剪框 'move': 只可以移动 'none': 什么也不处理
    // preview:".small",  // 添加额外的元素(容器)以供预览
    responsive:true, //在调整窗口大小的时候重新渲染cropper,默认为true
    restore:true, // 调整窗口大小后恢复裁剪的区域。
    checkCrossOrigin:true, //检查当前图像是否为跨域图像,默认为true
    modal:true, // 显示图片上方的黑色模态并在裁剪框下面，默认为true
    guides:false, // 显示在裁剪框里面的虚线，默认为true
    center:true, // 裁剪框在图片正中心，默认为true
    highlight:false, // 在裁剪框上方显示白色的区域,默认为true
    background:false, // 显示容器的网格背景(即马赛克背景)，默认为true，若为false，这不显示
    autoCrop:true, // 当初始化时，显示裁剪框，改成false裁剪框消失需要你重绘裁剪区域，默认为true
    autoCropArea:0.8, // 定义自动裁剪面积大小(百分比)和图片进行对比，默认为0.8
    movable:true, // 是否允许可以移动后面的图片，默认为true（但是如果dragMode为crop，由于和重绘裁剪框冲突，所以移动图片会失效）
    rotatable:true, // 是否允许旋转图像,默认为true
    scalable:true, // 是否允许缩放图像，默认为true
    zoomable:true, // 是否允许放大图像，默认为true
    zoomOnTouch:true, // 是否可以通过拖动触摸来放大图像，默认为true
    wheelZoomRatio:0.1, // 用鼠标移动图像时，定义缩放比例,默认0.1
    cropBoxMovable:true, // 是否通过拖拽来移动剪裁框，默认为true
    cropBoxResizable:true, // 是否通过拖动来调整剪裁框的大小，默认为true
    toggleDragModeOnDblclick:true, // 当点击两次时可以在“crop”和“move”之间切换拖拽模式，默认为true
    crop: function(event) {

    }
}
let cropper = new Cropper(image,options); // 初始化cropper对象
// 调起input（相机图片）事件
$(".btn-box").click(function(){
    $('#select-box').click()
})
// input事件
$('#select-box').on('change',function(e){
    let file = e.target.files[0];
    let reader = new FileReader();  
    reader.onload = function(evt) {  
        let replaceSrc = evt.target.result;
        // 更换cropper的图片
        cropper.replace(replaceSrc, false);
    }
    reader.readAsDataURL(file);
    $(".module-cropper").show();
    const cancel = document.querySelector('.cancelCropper');
    const rotate = document.querySelector('.rotateCropper');
    const success = document.querySelector('.cropperSucess');
    cancel.addEventListener('click',cancelCropper);
    rotate.addEventListener('click',rotateCropper);
    success.addEventListener('click',cropperSucess);
})
// 取消弹窗
function cancelCropper(){
    $(".module-cropper").hide();
}
// 旋转图片
function rotateCropper(){
    cropper.rotate(90);
}
let baseSrc;
// 图片选择完成
function cropperSucess(){
    const Imagefile = document.querySelector('#select-box').value
    let Imagetype = Imagefile.split('.')
    Imagetype = Imagetype[Imagetype.length-1]
    baseSrc = cropper.getCroppedCanvas().toDataURL(`image/${Imagetype}`, 1);
    $(".module-cropper").hide();
    view_headshot();
}

//创建头像弹出框
let view,popover_view;
function view_headshot(){
const view = document.getElementById('view')
popover_view = new bootstrap.Popover(view, {
    placement:"right",
    trigger:"hover focus click",
    html:true,
    content:"<img src='"+baseSrc+"' class='view_img'>",
    container:".login_input"
})
view.innerHTML="查看头像"
}