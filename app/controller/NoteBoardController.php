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
		$result=$noteBoardBLLModel->infoNoteBoard($noteBoardObjModel);
		echo $result;
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
		$result=$noteBoardBLLModel->modifyNoteBoard($noteBoardObjModel);
		echo $result;
	}

	
}