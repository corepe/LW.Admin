<?php

/**
 * 管理员 MODEL
 */

class Template_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function generate($post) {
        $post = lwCheckValue($post, ['controllerName', 'controller', 'model', 'view', 'sql', 'tbName']);
        if ($post === false) {
            $this->rs['msg'] = '参数缺失';
            return $this->rs;
        }
        // TODO: 判断某些文件是否存在,存在将不能够重写,很危险

        // 视图文件夹也应该自动生成

        // 初始化 controller
        $controller = ucfirst(strtolower($post['controller']));
        $fromPath = APPPATH.'views/template/Controller.conf';
        $toPath = APPPATH.'controllers/'.$controller.'.php';
        $this->replaceContent($post, $fromPath, $toPath);
        // 初始化 model
        $model = strtolower($post['model']);
        $Model = ucfirst($model);
        $fromPath = APPPATH.'views/template/Model.conf';
        $toPath = APPPATH.'models/'.$Model.'.php';
        $this->replaceContent($post, $fromPath, $toPath);
        // 初始化 view
        // index 主页
        $view = strtolower($post['view']);
        $fromPath = APPPATH.'views/template/views/index.conf';
        $toPath = APPPATH.'views/'.$view.'/index.php';
        $this->replaceContent($post, $fromPath, $toPath);
        // 列表页
        $fromPath = APPPATH.'views/template/views/list.conf';
        $toPath = APPPATH.'views/'.$view.'/list.php';
        $this->replaceContent($post, $fromPath, $toPath);
        // 编辑页
        $fromPath = APPPATH.'views/template/views/edit.conf';
        $toPath = APPPATH.'views/'.$view.'/edit.php';
        $this->replaceContent($post, $fromPath, $toPath);

        $this->rs['success'] = true;
        $this->rs['msg'] = '初始化成功';
        $this->rs['url'] = site_url($controller.'/index');
        return $this->rs;
    }


    private function replaceContent($post, $fromPath, $toPath) {
        $controllerName = $post['controllerName'];
        // 全小写后再首字母大写
        $controller = strtolower($post['controller']);
        $Controller = ucfirst($controller);
        $model = strtolower($post['model']);
        $Model = ucfirst($model);
        $view = strtolower($post['view']);
        $sql = $post['sql'];
        $tbName = $post['tbName'];
        $content = file_get_contents($fromPath);
        $content = str_replace("\r\n", "\n", $content);
        $content = str_replace("===controllerName===", $controllerName, $content);
        $content = str_replace("===controller===",     $controller,     $content);
        $content = str_replace("===Controller===",     $Controller,     $content);
        $content = str_replace("===model===",          $model,          $content);
        $content = str_replace("===Model===",          $Model,          $content);
        $content = str_replace("===view===",           $view,           $content);
        $content = str_replace("===sql===",            $sql,            $content);
        $content = str_replace("===tbName===",         $tbName,         $content);
        @file_put_contents($toPath, $content);
    }

}