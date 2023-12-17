import { loadXMLDoc } from "./ajax.js";
import { getCookie } from "./cookie.js"
/**
 * 检查用户是否登录
 * @returns {boolean}
 */
function checklogin() {
    const userkey = getCookie('userkey');
    let result = loadXMLDoc('./../../php/interface/checklogin.php', userkey)
    return result;
}
export { checklogin }