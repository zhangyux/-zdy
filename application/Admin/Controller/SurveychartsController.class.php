<?php
/**
 * 后台首页
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class SurveychartsController extends AdminbaseController {
	
	public function _initialize() {
 
	}
	
    /**
     * 后台框架首页
     */
    public function index() {
        
        $dataPoints = array(
            array("y" => 6, "label" => "Apple"),
            array("y" => 4, "label" => "Mango"),
            array("y" => 5, "label" => "Orange"),
            array("y" => 7, "label" => "Banana"),
            array("y" => 4, "label" => "Jackfruit")
        );
        
        $this->assign('dataPoints',$dataPoints);
       	$this->display();
    }
    public function search()
    {
        
    }
}

