<?php 
namespace app\controller;
use app\model\OBJ as OBJ;
use app\model\BLL as BLL;
use framework\tool as tool;
class NoteBoardController extends \framework\lib\Controller{
	//查询noteboard
	public function gnoteboardAction(){
		$userId=$_POST['userId'];

		$noteBoardObjModel=new OBJ\NoteBoardObjModel;
		$noteBoardObjModel->userId=$userId;
		$noteBoardBLLModel=new BLL\NoteBoardBLLModel;
		$noteBoardObjFromDb=$noteBoardBLLModel->infoNoteBoard($noteBoardObjModel);
		if ($noteBoardObjFromDb) {
			echo tool\ResponseTool::show(1,'noteBoard查询成功',$noteBoardObjFromDb->objToArr());
		
		}else{
			echo tool\ResponseTool::show(408,'noteBoard查询失败',$noteBoardObjFromDb);
		
		}
		
	}
	//修改noteboard
	public function cgnoteboardAction(){
		$userId=$_POST['userId'];
		$boardBackGroundId=$_POST['boardBackGroundId'];
		$noteBoardId=$_POST['noteBoardId'];
		$noteBoardObjModel=new OBJ\NoteBoardObjModel;
		$noteBoardObjModel->userId=$userId;
		$noteBoardObjModel->boardBackGroundId=$boardBackGroundId;
		$noteBoardObjModel->noteBoardId=$noteBoardId;
		$noteBoardBLLModel=new BLL\NoteBoardBLLModel;
		$noteBoardObjFromDb=$noteBoardBLLModel->modifyNoteBoard($noteBoardObjModel);
		if ($noteBoardObjFromDb) {
			// $noteBoardObjFromDbArr=$noteBoardObjFromDb->objToArr();
			echo tool\ResponseTool::show(1,'noteBoard修改成功',$noteBoardObjFromDb->objToArr());
		
		}else{
			echo tool\ResponseTool::show(409,'noteBoard修改失败',$noteBoardObjFromDb);
		
		}
	}

	
}