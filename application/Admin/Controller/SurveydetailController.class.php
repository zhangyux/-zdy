<?php
/**
 * 后台首页
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class SurveydetailController extends AdminbaseController {
	
	public function _initialize() {
        $this->survey_model = D("Common/Survey"); 
        $this->radio_model = D("Common/Radio");
        $this->question_model = D("Common/Question");
        $this->surveyrecord_model = D("Common/Surveyrecord");
        $this->surveyradiorecord_model = D("Common/Surveyradiorecord");
	}
	
    /**
     * 后台框架首页
     */
    public function index() {

        $survey = $_REQUEST['survey'];
        if(empty($survey)){
            $survey = 1;
        }


        $allsurvey = $this->survey_model->where(array('status'=>1))->select();
        $this->assign('allsurvey',$allsurvey);

        $choosesurvey = $this->survey_model->where(array('surveyid'=>$survey,'status'=>1))->find();
        $this->assign('sssurvey',$choosesurvey);
// echo $this->survey_model->getLastSql();;


        $allradio = $this->radio_model->where(array('surveyid'=>$survey,'status'=>1))->order('radioid asc')->select();
        $this->assign('allradio',$allradio);


        $countradio = $this->radio_model->where(array('surveyid'=>$survey,'status'=>1))->count();


        $district = $_REQUEST['district'];
        if($district){
            $where['local']=array('eq',$district);
        }
         
         $where['surveyid'] = array('eq',$survey);
         $where['status'] = array('eq',1);

        $surveyrecord = $this->surveyrecord_model->where($where)->select();
        foreach ($surveyrecord as $key => $value) {
             $surveyrecord[$key]['question']=$this->surveyradiorecord_model
            ->table("cmf_surveyradiorecord svrr")
            ->join("left JOIN cmf_radio r ON svrr.radioid=r.radioid")
            ->where(array('svrr.radiotag'=>$value['radiotag'],'svrr.status'=>1,'r.status'=>1))
            ->select();


            $surveyrecord[$key]['count'] = $this->surveyradiorecord_model
            ->table("cmf_surveyradiorecord svrr")
            ->join("left JOIN cmf_radio r ON svrr.radioid=r.radioid")
            ->where(array('svrr.radiotag'=>$value['radiotag'],'svrr.status'=>1,'r.status'=>1))
            ->count();
        }
        $this->assign('surveyrecord',$surveyrecord);


        $this->assign('countsurveyrecord',$countsurveyrecord);
        $this->assign('countradio',$countradio);
 
       	$this->display();
    }
    public function search()
    {
        
    }
    public function dele()
    {
        $id = $_REQUEST['id'];
        $this->surveyrecord_model->where(array('id'=>$id))->save(array('status'=>0));
        $tag = $this->surveyrecord_model->field('radiotag')->where(array('id'=>$id))->find();

        $this->surveyradiorecord_model->where(array('radiotag'=>$tag['radiotag']))->save(array('status'=>0));


    }
}

