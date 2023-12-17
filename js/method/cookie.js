/**
 * 
 * @param {String} cname 
 * @param {any} cvalue 
 * @param {int} second 
 */
function setCookie(cname, cvalue, second) {
    var day = new Date();
    day.setTime(day.getTime() + (second * 1000));
    var expires = "expires=" + day.toGMTString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

/**
 * @param {String} cname 
 * @return {String}
 */
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i].trim();
        if (c.indexOf(name) == 0) { return c.substring(name.length, c.length); }
    }
    return "";
}
export { setCookie, getCookie }