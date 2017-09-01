<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class SurveylistController extends AdminbaseController{
	
	public function _initialize() {
		parent::_initialize();
		$this->survey_model = D("Common/Survey"); 
		$this->radio_model = D("Common/Radio");
		$this->question_model = D("Common/Question");
		$this->surveyrecord_model = D("Common/Surveyrecord");
		$this->surveyradiorecord_model = D("Common/Surveyradiorecord");
	}
	
	/**
	 * 电子校牌添加问卷
	 */
	public function index(){
		$survey = 1;
		if($_REQUEST['survey']){
			$survey = $_REQUEST['survey'];
		}
	 
		$allsurvey = $this->survey_model->where(array('status'=>1))->select();
		$this->assign('allsurvey',$allsurvey);

		$nowsurvey = $this->survey_model->where(array('surveyid'=>$survey,'status'=>1))->find();
		$this->assign('nowsurvey',$nowsurvey);


		$surveylist = $this->survey_model
		->table("cmf_survey sv")
		->join("left JOIN cmf_radio r ON sv.surveyid=r.surveyid")
		->where(array('sv.surveyid'=>$survey,'sv.status'=>1,'r.status'=>1))->order('r.orders asc')->select();
		$i =0;
		foreach ($surveylist as $key => $value) {
			$surveylist[$key]['number'] = ++$i;


			$surveylist[$key]['question'] = $this->question_model->where(array('radioid'=>$value['radioid']))->limit(0,4)->select();
			$surveylist[$key]['count'] = $this->question_model->where(array('radioid'=>$value['radioid']))->count();
		}

		$numberradio = $this->radio_model->where(array('surveyid'=>$survey,'status'=>1))->count();


		$this->assign('numberradio',$numberradio);
		$this->assign('i',$i);
		$this->assign('surveylist',$surveylist);

		$this->display();
	}
	//查看统计
 	public function lists(){
		$survey = 1;
		if($_REQUEST['survey']){
			$survey = $_REQUEST['survey'];
		}
		
		if($_REQUEST['district']){
			$district = $_REQUEST['district'];
			$where['local'] = array('eq',$district);
		}


		$allsurvey = $this->survey_model->where(array('status'=>1))->select();
		$this->assign('allsurvey',$allsurvey);

		$surveylist = $this->survey_model
		->table("cmf_survey sv")
		->join("left JOIN cmf_radio r ON sv.surveyid=r.surveyid")
		->where(array('sv.surveyid'=>$survey,'sv.status'=>1,'r.status'=>1))->select();

		foreach ($surveylist as $key => $value) {
			$surveylist[$key]['question'] = $this->question_model->where(array('radioid'=>$value['radioid']))->select();
			$surveylist[$key]['count'] = $this->question_model->where(array('radioid'=>$value['radioid']))->count();

			foreach ($surveylist[$key]['question'] as $q => $vs) {
	 		$where['questionid'] = array('eq',$vs['questionid']);
	 		$where['status'] = array('eq',1);
	 		 

			$surveylist[$key]['question'][$q]['count'] = $this->surveyradiorecord_model->where($where)->count();
				
			}


			 
			$surveylist[$key]['questionallcount'] = $this->surveyradiorecord_model->where(array('radioid'=>$value['radioid'],'status'=>1,'questionid'=>array('neq','')))->count();


		}


		$this->assign('surveylist',$surveylist);

		$this->display();
	}
	public function edit()
	{
		$raidoid = $_REQUEST['radioid'];
		$radio = $this->radio_model->field('radioid,radiotitle')->where(array('radioid'=>$raidoid,'status'=>1))->find();
		$this->assign('radio',$radio);

		$question = $this->question_model->where(array('radioid'=>$raidoid))->select();
		$this->assign('question',$question);
		$this->display();
	}

	public function edit_post()
	{	
		$maxid = 0;
		//得到当前最大id
		$getid = $this->radio_model->field("max(radioid) as id")->find();
		if($getid)
		{
			$maxid = $getid['id']+1;
		}


		$qid = 0;
		//得到当前最大id
		$getqidid = $this->question_model->field("max(questionid) as id")->find();
		if($getqidid)
		{
			$qid = $getqidid['id']+1;
		}



		$radioid = $_REQUEST['radioid'];
		$radiotitle = $_REQUEST['question'];
		$add['radioid']=$maxid;
		$add['questiontitle']=$radiotitle;
		$add['questionid']=$qid;
		$this->question_model->add($add);
		// echo json_encode($radiotitle);

	}
	public function edit_posttitle()
	{	
		$maxid = 0;
		//得到当前最大id
		$getid = $this->radio_model->field("max(radioid) as id")->find();
		if($getid)
		{
			$maxid = $getid['id']+1;
		}

		$radioid = $_REQUEST['radioid'];
		$radiotitle = $_REQUEST['question'];


		$update['radiotitle']=$radiotitle;
		$update['radioid']=$maxid;
		$this->radio_model->where(array('radioid'=>$radioid))->save($update);

		// echo json_encode($radiotitle);

	}
	public function add()
	{
		$suv = $_REQUEST['suv'];
		$this->assign('suv',$suv);
		$this->display();
	}

	public function add_post()
	{
		$suv = $_REQUEST['suv'];
		$maxid = 0;
		//得到当前最大id
		$getid = $this->radio_model->field("max(radioid) as id")->find();
		if($getid)
		{
			$maxid = $getid['id']+1;
		}


		$qid = 0;
		//得到当前最大id
		$getqidid = $this->question_model->field("max(questionid) as id")->find();
		if($getqidid)
		{
			$qid = $getqidid['id']+1;
		}



		$radiotitle = $_REQUEST['question'];
		$add['radioid']=$maxid;
		$add['questiontitle']=$radiotitle;
		$add['questionid']=$qid;
		$this->question_model->add($add);
	}
	public function add_postquestion()
	{	
		$suv = $_REQUEST['suv'];
		$radioid = $_REQUEST['radioid'];
		$radiotitle = $_REQUEST['question'];
		$maxid = 0;
		//得到当前最大id
		$getid = $this->radio_model->field("max(radioid) as id")->find();
		if($getid)
		{
			$maxid = $getid['id']+1;
		}


		$orderid = 0;
		//得到当前最大id
		$getorderid = $this->radio_model->field("max(orders) as id")->where(array('radioid'=>$radioid))->find();
		if($getorderid)
		{
			$orderid = $getorderid['id']+1;
		}



		

		$add['surveyid'] = $suv;
		$add['radiotitle']=$radiotitle;
		$add['radioid']=$maxid;
		$add['status']=1;
		$add['orders']=$orderid;
		$this->radio_model->add($add);
		echo json_encode("fewf");
	}


	public function dele()
	{
		$suv = $_REQUEST['suv'];
		$this->survey_model->where(array('surveyid'=>$suv))->save(array('status'=>0));
	}

	public function delradio()
	{
		$radio = $_REQUEST['radio'];
		$this->radio_model->where(array('radioid'=>$radio))->save(array('status'=>0));
	}

	/**
	 * 上移
	 */
	public function up()
	{
		$suv = $_REQUEST['suv'];
		$radio = $_REQUEST['radioid'];
		$number = $_REQUEST['number'];
		$i=1;
		$a = $number ;
		$b = $number -2;
		if($number<2){
			$b = 0;
		}
		$radiotwo = $this->radio_model->where(array('surveyid'=>$suv,'status'=>1))->limit($b,$a)->order('orders asc')->select();
			foreach ($radiotwo as $key => $value) {
				$radios[$i] = $value['radioid'];
				$radion[$i] = $value['orders'];
				$i++;
		}

		$this->radio_model->where(array('radioid'=>$radios[1]))->save(array('orders'=>$radion[2]));
		$this->radio_model->where(array('radioid'=>$radios[2]))->save(array('orders'=>$radion[1]));

		echo json_encode($radion);
	}
	/**
	 * 下移
	 */
	public function down()
	{
		$suv = $_REQUEST['suv'];
		$radio = $_REQUEST['radio'];
		$number = $_REQUEST['number'];

		$i=1;
		$a = $number+1;
		$b = $number-1;
		if($number<2){
			$b = 0;
		}
		$radiotwo = $this->radio_model->where(array('surveyid'=>$suv,'status'=>1))->limit($b,$a)->order('orders asc')->select();
			foreach ($radiotwo as $key => $value) {
				$radios[$i] = $value['radioid'];
				$radion[$i] = $value['orders'];
				$i++;
		}

		$this->radio_model->where(array('radioid'=>$radios[1]))->save(array('orders'=>$radion[2]));
		$this->radio_model->where(array('radioid'=>$radios[2]))->save(array('orders'=>$radion[1]));

		echo json_encode($radion);

	}
	
}