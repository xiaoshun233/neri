import { setCookie } from './cookie.js';
import { loadXMLDoc } from './ajax.js';
/**
 * 退出登录
 * @return {boolean}
 */
function exitlogin() {
    try {
        setCookie('userkey', '', -7200);
        loadXMLDoc('./../../php/interface/exitlogin.php', true);
        location.href = 'index.php';
        return true;
    }
    catch (e) {
        return false;
    }
}

export { exitlogin }