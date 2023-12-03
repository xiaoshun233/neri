import { loadXMLDoc } from "./ajax.js";
import { getCookie } from "./cookie.js"

function checklogin(){
    const userkey = getCookie('userkey');
    let result = loadXMLDoc('./../../php/interface/checklogin.php',userkey)
    return result;
}
export {checklogin}