function createconfirm(title, message, yescallback = void 0, nocallback = void 0) {
    title = title || 'neri的小窝';
    message = message || '来自此次提交的确认';

    const createelement = function (selector) {
        return document.querySelector(selector);
    }

    const creatediv = function (classname, parents = void 0, innerHTML = "") {
        const div = document.createElement('div');
        div.classList.add(classname);
        if (innerText) {
            div.innerHTML = innerHTML;
        }
        if (parents) {
            parents.append(div);
        }
        return div;
    }

    const confirmdiv = creatediv('confirm-mask');
    const contentdiv = creatediv('confirm-content-button', confirmdiv);
    const contenttitle = creatediv('confirm-content', contentdiv);
    const contentmessage = creatediv('confirm-content-title', contentdiv);
    const contentbutton = creatediv('confirm-content-message', contentdiv);
    creatediv('title-span', contenttitle, title);
    creatediv('message-span', contentmessage, message);
    creatediv('button-confirm', contentbutton, "确认");
    creatediv('button-cancel', contentbutton, "取消");
    document.body.append(confirmdiv);

    createelement('.button-confirm').onclick = function () {
        confirmdiv.remove();
        yescallback();
    };
    createelement('.button-cancel').onclick = function () {
        confirmdiv.remove();
        nocallback();
    };
}
export { createconfirm }