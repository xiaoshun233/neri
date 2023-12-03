const createCounter = function(init = 0) {
    const counter = {
        counterStart:init,
        increment:function(){
            return ++init
        },
        decrement:function(){
            return --init
        },
        reset:function(){
            return init = this.counterStart
        },
        getcrement(){
            return init;
        }
    }
    return counter;
};
export { createCounter }