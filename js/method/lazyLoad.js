const getTop = function(event,extrasadd=0){
    let eventTop = event.offsetTop + extrasadd;
    return eventTop;
}

const lazyLoad = function(imgs){
    let visibleheight = document.documentElement.clientHeight;
    let scrollheight = document.documentElement.scrollTop||document.body.scrollTop;
    for (let i = 0; i < imgs.length; i++) {
        if(visibleheight+scrollheight > getTop(imgs[i],-300)){
            if(imgs[i].src!="") continue;
            imgs[i].src = imgs[i].getAttribute('data-src');
        }    
    }
}
export {lazyLoad}