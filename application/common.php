<?php
// 应用公共文件
/**
 * 读取静态页面缓存
 */
function read_html_cache(){
    $html_catch_arr = C('HTML_CACHE_ARR');
    $request = think\Request::instance();
    $m_c_a_str = $request->module().'_'.$request->controller().'_'.$request->action(); // 模块_控制器_方法
    $m_c_a_str = strtolower($m_c_a_str);
    // exit('read_html_cache读取缓存<br/>');
    foreach($html_catch_arr as $key => $val)
    {
        $val['mca'] = strtolower($val['mca']);
        if($val['mca'] != $m_c_a_str) // 不是当前 模块 控制器 方法 直接跳过
            continue;

        $filename = $m_c_a_str;
        // 组合参数
        if(isset($val['p']))
        {
            foreach($val['p'] as $k => $v)
                $filename .= '_'.$_GET[$v];
        }
        $filename .= '.html';
        $html = \think\Cache::get($filename);
        if($html)
        {
            echo \think\Cache::get($filename);
            exit;
        }
    }
}
