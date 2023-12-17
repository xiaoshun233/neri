/**
 * 节流函数
 * @param {Function} fn 
 * 回调函数
 * @param {int} delay 
 * 多次触发间隔时间
 * @param {boolean} isImmediate 
 * isImmediate 为 true 时使用前缘节流，首次触发会立即执行，为 false 时使用延迟节流，首次触发不会立即执行
 * @returns 
 */
function throttle(fn, delay, isImmediate = true) {

    let last = Date.now();
    return function () {
        let now = Date.now();
        if (isImmediate) {
            fn.apply(this, arguments);
            isImmediate = false;
            last = now;
        }
        if (now - last >= delay) {
            fn.apply(this, arguments);
            last = now;
        }
    }
}

export { throttle }