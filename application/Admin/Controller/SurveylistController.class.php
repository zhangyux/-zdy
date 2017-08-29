<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class SurveylistController extends AdminbaseController{
	
	public function _initialize() {
		parent::_initialize();
	}
	
	/**
	 * 电子校牌添加问卷
	 */
	public function index(){
		 
		$this->display();
	}
	
 
	
	
}