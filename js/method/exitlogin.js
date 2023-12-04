import { setCookie } from './cookie.js';
import  { loadXMLDoc } from './ajax.js';
function exitlogin(){
    setCookie('userkey','',-3600);
    loadXMLDoc('./../../php/interface/exitlogin.php',true);
    location.reload();
}

export {exitlogin}