class Popup {
    title;
    message;
    boxelement;
    csselement;
    #confirmtext;
    #canceltext;
    #contentdiv
    #result;
    #yescallback = function () { };
    #nocallback = function () { };

    constructor(title, message) {
        this.title = title;
        this.message = message;
    }


    static sleep = function (time) {
        return new Promise((resolve) => setTimeout(resolve, time));
    }


    get getresult() {
        return this.#result;
    }

    settitle(title) {
        this.title = title;
    }

    setmessage(message) {
        this.message = message;
    }

    setbuttontext(confirmtext, canceltext) {
        this.#confirmtext = confirmtext;
        this.#canceltext = canceltext;
    }

    setyescollback(yescallback = function () { }) {
        this.#yescallback = yescallback;
    }
    setnocollback(nocallback = function () { }) {
        this.#nocallback = nocallback;
    }


    #removebox() {
        this.boxelement.remove();
        this.csselement.remove();
        this.boxelement = void 0;
        this.csselement = void 0;
    }


    #creatediv = function (classname, parents = void 0, innerHTML = "") {
        const div = document.createElement('div');
        div.classList.add(classname);
        if (innerHTML) {
            div.innerHTML = innerHTML;
        }
        if (parents) {
            parents.append(div);
        }
        return div;
    }
    #show = function (element) {
        document.body.appendChild(element);
    }

    #createcss(href) {
        const css = document.createElement('link');
        css.rel = "stylesheet";
        css.type = "text/css";
        css.href = href;
        this.csselement = css;
        return css;
    }

    #createbox() {
        const confirmdiv = this.#creatediv('popup-mask');
        const contentdiv = this.#creatediv('popup-content', confirmdiv);
        const contenttitle = this.#creatediv('popup-content-title', contentdiv);
        const contentmessage = this.#creatediv('popup-content-message', contentdiv);

        this.#creatediv('title-span', contenttitle, this.title);
        this.#creatediv('message-span', contentmessage, this.message);
        this.boxelement = confirmdiv;
        this.#contentdiv = contentdiv;
    }

    #createbutton() {
        const contentbutton = this.#creatediv('popup-content-button', this.#contentdiv);
        const buttonconfirm = this.#creatediv('button-confirm', contentbutton, this.#confirmtext);
        const buttoncancel = this.#creatediv('button-cancel', contentbutton, this.#canceltext);

        buttonconfirm.onclick = () => {
            this.#removebox();
            this.#yescallback();
            this.#result = true;
        };
        buttoncancel.onclick = () => {
            this.#removebox();
            this.#nocallback();
            this.#result = false;
        };
    }


    confirm(title, message, confirmtext, canceltext) {

        this.settitle(title || 'neri的小窝');
        this.setmessage(message || '来自此次确认框的提示');
        this.setbuttontext(confirmtext || '确认', canceltext || '取消');

        this.#createcss("css/popup/confirm.css");
        this.#show(this.csselement);
        this.csselement.addEventListener('load', () => {
            this.#createbox();
            this.#createbutton();
            this.#show(this.boxelement);
        })
    }

    alert(title, message, second) {
        this.settitle(title || 'neri的小窝');
        this.setmessage(message || '来自此次警告框的提示');

        this.#createcss("css/popup/alert.css");
        this.#show(this.csselement);
        this.csselement.addEventListener('load', () => {
            this.#createbox(title, message);
            this.#show(this.boxelement);
            if (second != void 0) {
                const time = second * 1000;
                Popup.sleep(time).then(() => {
                    this.#removebox();
                })
            } else {
                this.boxelement.addEventListener('click', () => {
                    this.#removebox();
                })
            }
        })
    }

    prompt(title, message) {
        this.settitle(title || 'neri的小窝');
        this.setmessage(message || '来自此次输入框的提示');

        this.#createcss("css/popup/prompt.css");
        this.#show(this.csselement);
        this.csselement.addEventListener('load', () => {
            this.#createbox();
            this.#createbutton();
            this.#show(this.boxelement);
        })
    }
}

export { Popup }