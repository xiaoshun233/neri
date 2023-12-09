//搜索栏全部和部分
const SearchBtnAll = document.querySelector('#search_1')
const SearchBtnSenior = document.querySelector('#search_2')
const SearchSenior = document.querySelector('.category_bottom')
//绑定高级和全部按钮点击事件
SearchBtnAll.addEventListener('click', click_all)
SearchBtnSenior.addEventListener('click', click_Senior);

//变化函数
function click_all() {
    SearchBtnAll.className = 'category_now';
    SearchBtnSenior.className = '';
    SearchSenior.className = 'category_bottom search_none'
}

function click_Senior() {
    SearchBtnSenior.className = 'category_now';
    SearchBtnAll.className = '';
    SearchSenior.className = 'category_bottom'
}


//点击搜索按钮
const SearchBtn = document.querySelector('#search');
SearchBtn.addEventListener('click', () => {
    const searchtext = document.querySelector('.text_search');
    let getstring = `s=${searchtext.value}`;
    if (document.querySelector('.category_now').innerHTML == "全部") {
        location.href = `navigation.php?${getstring}`;
        return;
    }
    const searchitem = document.querySelector('.category_item input:checked');
    const searcharticle = document.querySelector('.category_article input:checked');
    if (!(searchitem == void 0)) {
        getstring += `&ti=${searchitem.getAttribute('id')}`;
    }
    if (!(searcharticle == void 0)) {
        getstring += `&ta=${searcharticle.getAttribute('id')}`;
    }
    location.href = `navigation.php?${getstring}`;
})