<?php
require "./../link/public/mysql.php";
require_once './../method/sendtokenMail.php';
require_once './../method/codestr.php';
require_once './../method/checkString.php';
require_once './../method/token.php';
require_once './../method/mysqlPreprocess.php';
try {
    if (!isset($_POST['data'])) {
        throw new Exception('No get data in this register post request');
    }
    $email = json_decode($_POST['data']);

    $preg_email = '/^[a-zA-Z0-9]+([-_.][a-zA-Z0-9]+)*@([a-zA-Z0-9]+[-.])+([a-z]{2,5})$/ims';
    if (!checkLegitimate($email, $preg_email)) {
        throw new Exception('e-mail error');
    }

    $sql = "SELECT usernumber FROM users WHERE useremail = ?";
    if (mysqlPreprocess($link, $sql, 's', $email)) {
        throw new Exception('email has been used');
    }
    $mailtitle = "来自ねりの小窝的验证信息";
    $token = codestr();
    date_default_timezone_set('PRC');
    $mailmessage = "
    <div style='width: 100%;padding: 50px 0;background-color: #f2f2f2;'>
        <div style='background-color: #ffffff; width: 550px; height:400px; margin: 0 auto;display:flex;justify-content: center;flex-direction: column;'>
            <h1 style='text-align: center;'>ねりの小窝</h1>
            <h3 style='text-align: center;'>邮箱验证</h3>
            <div style='width:350px; margin:0 auto;'>
                <p>尊敬的用户：</p>
                <p>
                    您请求的邮箱验证代码为:" . $token . ",请在网页中填写，完成验证。</br>
                    (本验证代码在 " . date('Y-m-d H:i:s', time() + 3600) . " 之前有效)
                </p>
                <p>如果此验证码非您本人所请求，请直接忽视。</p>
            </div>
        </div>
    </div>";
    $sendmail = sendtokenMail($email, $mailtitle, $mailmessage);
    if (!$sendmail) {
        throw new Exception('send mail fail');
    }
    if (!setToken('emailtoken', $token) || !setToken('signemail', $email)) {
        throw new Exception('设置token失败');
    }
    $result = true;
} catch (Exception $e) {
    $result = false;
} finally {
    echo json_encode($result);
}
