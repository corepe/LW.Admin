<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 主要用户生成模板使用
 */
class Template extends AuthController {

	function __construct()
	{
        parent::__construct();
        $this->load->model('template_model');
	}

    /**
     * 模板主页
     */
	public function index()
	{
		$data['assets'] = $this->lw_assets->getPageAssets();
        $data['breadcrumb'] = [
            ['模板生成功能',null]
        ];
		$this->_tpl_page('template/index', $data);
    }



    public function generate() {
        $post = $this->input->post();
        $rs = $this->template_model->generate($post);
        lwReturn($rs);
    }
    
}