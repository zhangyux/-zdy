<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class SurveyaddController extends AdminbaseController{
	
	public function _initialize() {
		parent::_initialize();
		$this->survey_model = D("Common/Survey");
		$this->radio_model = D("Common/Radio");
		$this->question_model = D("Common/Question");

	}
	
	/**
	 * 电子校牌添加问卷
	 */
	public function index(){
		
		$this->display();
	}
	//得到问卷调查最大id
	public function getmaxsurveyid()
	{
		$maxid = 0;
		$getid = $this->survey_model->field("max(surveyid) as id")->find();
		if($getid)
		{
			$maxid = $getid['id']+1;
		}
		echo json_encode($maxid);
	}
	//问卷调查的题目
	public function addsurveyradio()
	{
		$maxid = 0;
		$surveyid = $_REQUEST['smaxid'];
		$radioname = $_REQUEST['radioname'];
		
		//得到当前最大id
		$getid = $this->radio_model->field("max(radioid) as id")->find();
		if($getid)
		{
			$maxid = $getid['id']+1;
		}
		
		$data['radioid'] = $maxid;
		$data['surveyid'] = $surveyid;
		$data['radiotitle'] = $radioname;
		$getid = $this->radio_model->add($data);


		echo json_encode($maxid);

	}
	/**
	 * 问卷调查的答案
	 */
	public function addsurveyquestion()
	{	
		$radioid = $_REQUEST['radioid'];
		$questiontitle = $_REQUEST['questiontitle'];
		$maxid = 0;
		//得到当前最大id
		$getid = $this->question_model->field("max(questionid) as id")->find();
		if($getid)
		{
			$maxid = $getid['id']+1;
		}
 		
 		$data['radioid'] = $radioid;
 		$data['questiontitle'] = $questiontitle;
 		$data['questionid'] = $maxid;
		$getid = $this->question_model->add($data);

		echo json_encode($maxid);

	}
	public function addsurvey()
	{
		$data['surveyid'] = $_REQUEST['smaxid'];
		$data['textarea'] = $_REQUEST['textarea'];
		$data['title'] = $_REQUEST['title'];

		$getid = $this->survey_model->add($data);

		$msg = "创建成功";
		echo json_encode($msg);
	}


 	public function add()
 	{

		$sql = 
			"CREATE TABLE `survey` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` char(200) DEFAULT NULL COMMENT '章节名称',
			`contents` text COMMENT '章节文字',
			`next` int(11) DEFAULT NULL COMMENT '下一章地址',
			`pid` int(11) DEFAULT NULL COMMENT '小说名称',
			`novel_url` char(50) DEFAULT NULL COMMENT '小说章节地址',
			PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";

		dump(M()->execute($sql));
 	}
	
	
}