import { setCookie } from './cookie.js';
import { loadXMLDoc } from './ajax.js';
/**
 * 退出登录
 * @return {boolean}
 */
function exitlogin() {
    try {
        setCookie('userkey', '', -3600);
        loadXMLDoc('./../../php/interface/exitlogin.php', true);
        location.reload();
        return true;
    }
    catch (e) {
        return false;
    }
}

export { exitlogin }