function throttle(fn, delay, isImmediate = true){
    // isImmediate 为 true 时使用前缘节流，首次触发会立即执行，为 false 时使用延迟节流，首次触发不会立即执行
    let last = Date.now();
    return function (){
        let now = Date.now();
        if(isImmediate){
            fn.apply(this, arguments);
            isImmediate = false;
            last = now;
        }
        if(now - last >= delay){
            fn.apply(this, arguments);
            last = now;
        }
    }
}

export {throttle}