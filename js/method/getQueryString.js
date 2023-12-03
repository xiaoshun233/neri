function getQueryString(name) {
    const url_string = window.location.href; // 获取get参数
    const url = new URL(url_string);
    return url.searchParams.get(name);
  }
  export {getQueryString}