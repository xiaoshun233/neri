<link rel="stylesheet" href="js/node_modules/cropperjs/dist/cropper.css">
<script src="./js/node_modules/cropperjs/dist/cropper.js"></script>
<!-- 裁剪图片弹窗 -->
<div class="module-cropper" style="display: none;">
    <div class="module-cropper-content">
        <div class="module-cropper-bg">
            <!-- 包装图像或画布元素 -->
            <div class="cropper-img-box">
                <img id="cropperImg" src=""/>
            </div>
        </div>
        <div class="module-cropper-btn">
            <span class="cancelCropper">取消</span>
            <span class="rotateCropper">旋转</span>
            <span class="cropperSucess">完成</span>
        </div>
    </div>
</div>
<script src="./js/method/cropper.js"></script>