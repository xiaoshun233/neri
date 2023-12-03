<?php
class Template {
    private $templatePath;
    private $data;

    public function setTemplatePath($path) {
        $this->templatePath = $path;
    }

    /**
     * 设置模板变量
     * @param $key string | array
     * @param $value
     */
    public function assign($key, $value) {
        if(is_array($key)) {
            $this->data = array_merge($this->data, $key);
        } elseif(is_string($key)) {
            $this->data[$key] = $value;
        }
    }

    /**
     * 渲染模板
     * @param $template
     * @return string
     */
    public function display($template) {
        extract($this->data);       // 注入变量
        ob_start();         // 开启缓冲区，暂存输出
        include "{$this->templatePath}{$template}";      // 加载模板
        $res = ob_get_contents();       // 获取即将输出的模板的数据
        ob_end_clean();
        return $res;
    }
}


?>