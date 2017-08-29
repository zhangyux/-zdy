<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tuolaji <479923197@qq.com>
// +----------------------------------------------------------------------
namespace Portal\Controller;

use Common\Controller\AdminbaseController;

class SurveyController extends AdminbaseController {
	
	 
	
	function _initialize() {
		parent::_initialize();
		$this->survey_model = D("Common/Survey"); 
		$this->radio_model = D("Common/Radio");
		$this->question_model = D("Common/Question");
		$this->surveyrecord_model = D("Common/Surveyrecord");
		$this->surveyradiorecord_model = D("Common/Surveyradiorecord");
	}
 
	function index()
	{
		$surveyid = $_REQUEST['surveyid'];
		$survey = $this->survey_model->where(array("surveyid"=>$surveyid))->find();		
		$survey['radio'] = $this->radio_model->where(array("surveyid"=>$surveyid))->select();
		 $addcounter = 0;
		 $addnumber  = 0;
		foreach ($survey['radio'] as $key => $value) {
			$survey['radio'][$key]['addcounter']=++$addcounter;
			$survey['radio'][$key][$value['radioid']]=$this->question_model->where(array("radioid"=>$value['radioid']))->select();
			 
		}
		$survey["addcounter"]=1;
		$survey["radioall"]=$addcounter;
		// var_dump($survey);
		$this->assign('survey',$survey);
	 	
	 
		$maxid = 0;
		$getid = $this->surveyrecord_model->field("max(radiotag) as id")->find();
		if($getid)
		{
			$maxid = $getid['id']+1;
		}
		
		$this->assign('radiotag',$maxid);

		$jsonraido = json_decode($survey['radio']);
		$this->assign('jsonraido',$jsonraido);


		$this->display();
	}

	public function getradio()
	{
		$survey = $_REQUEST['surveyid'];
		$radio = $this->radio_model->where(array('surveyid'=>$survey))->select();
		foreach ($radio as $key => $value) {
			$radio[$key]['question'] = $this->question_model->where(array('radioid'=>$value['radioid']))->select();
		}
		echo json_encode($radio);
	}

	//增加回答的问题的记录
	public function surveyradiorecord()
	{

		$data['radioid'] = $_REQUEST['radioid'];
		$data['questionid'] = $_REQUEST['questionid'];
		$data['questionname'] = $_REQUEST['questionname'];
		$data['radioname'] = $_REQUEST['radioname'];
		$data['radiotag'] = $_REQUEST['radiotag'];
		$this->surveyradiorecord_model->add($data);

	}
	//增加记录
	public function surveyrecord()
	{
		$data['surveyid'] = $_REQUEST['surveyid'];
		$data['radiotag'] = $_REQUEST['radiotag'];
		$data['local'] = $_REQUEST['local'];
		$data['textarea'] = $_REQUEST['textarea'];
		$this->surveyrecord_model->add($data);
		 
	}
}