<?php
namespace app\model\BLL;
use app\model\OBJ as OBJ;
use app\model\DAL as DAL;
use framework\tool as tool;
class UserBLLModel{

	//提取代码。注册时默认在NoteBoard添加数据
	private function addNoteBoard($userFromDb){
		$userId=$userFromDb->userId;
		$noteBoardObj=new OBJ\NoteBoardObjModel;
		$noteBoardObj->userId=$userId;
		$noteBoardObj->boardBackGroundId=1;
		$noteBoardDALModel=new DAL\NoteBoardDALModel;
		$noteBoardObjFromDb=$noteBoardDALModel->InsertNoteBoard($noteBoardObj->objToArr());
		return $noteBoardObjFromDb;

	}
	//提取代码。注册时默认在note中添加数据
	private function addNote($noteBoardObjFromDb){
		$noteBoardId=$noteBoardObjFromDb->noteBoardId;
		$noteNum=$noteBoardId%7;
		$noteObj=new OBJ\NoteObjModel;
		$noteObj->noteBoardId=$noteBoardId;
		$noteObj->noteDateTime=date('Y-m-d H:i:s');
		$noteObj->noteContent="你好，世界";
		$noteObj->noteTypeId=2;
		$noteObj->noteStatus=1;
		$noteObj->boolUrgent=0;
		$noteDALModel=new DAL\NoteDALModel;

		$noteObjFromDb=$noteDALModel->insertNote($noteObj->objToArr(),$noteNum);
		$noteObjFromDbArr=$noteObjFromDb->objToArr();

			return $noteObjFromDbArr;
	}
	/**
	 * 微信登入
	 *查询用户是否存在，
	 *1不存在，先添加，后登入
	 *2存在，直接登入
	 *结果:肯定能登入
	 */
	public function signWc($userFromView){
		$userDALModel=new DAL\UserDALModel;
		$userFromDb=new OBJ\UserObjModel;
		$userFromDb=$userDALModel->checkByOpenId($userFromView->openId);
		if ($userFromDb) {
			$userarr=$userFromDb->objToArr();
		}else{
			//没找到这个用户则insert
			 $userFromDb=$userDALModel->InsertByUserWc($userFromView->objToArr());
			 $userarr=$userFromDb->objToArr();
			//在noteBoard里插入数据
			$noteBoardObjFromDb=$this->addNoteBoard($userFromDb);
			//在note里添加数据
			$noteObjFromDbArr=$this->addNote($noteBoardObjFromDb);

		}
		return tool\ResponseTool::show(1,'微信登入成功',$userarr);
	}
	//pc登入
	public function signPc($userFromView){
		$userDALModel=new DAL\UserDALModel;
		$userFromDb=new OBJ\UserObjModel;
		$userFromDb=$userDALModel->checkByAccount($userFromView->account);
		$userarr=($userFromDb->password==$userFromView->password)?$userFromDb->objToArr():NULL;
		if ($userarr) {
			return tool\ResponseTool::show(1,'pc登入成功',$userarr);
		}else{
			return tool\ResponseTool::show(402,'pc登入失败',NULL);
		}

	}
	/**pc注册
	 * 用户已存在，则返回false。
	*	用户不存在，则返回数组
	 */
	public function registerPc($userFromView){
		$message;
		$userDALModel=new UserDALModel;
		$userFromDb=$userDALModel->InsertByUser($this->userObj_Arr($userFromView));
		if ($userFromDb) {
			//在noteBoard里插入数据
			$noteBoardObjFromDb=$this->addNoteBoard($userFromDb);
			//在note里添加数据
			$noteObjFromDbArr=$this->addNote($noteBoardObjFromDb);
			return ResponseTool::show(1,'pc注册成功',$this->userObj_Arr($userFromDb));
		}else{
			return ResponseTool::show(401,'用户已存在',NULL);
		}

	//	return $this->userArr_json($this->userObj_Arr($userFromDb),$error);

	}
	//修改用户全部信息或修改单个信息
	public function modifyUser($userFromView){
		$userDALModel=new DAL\UserDALModel;
		$userFromDb=$userDALModel->ModifyByUser($userFromView->objToArr());
		
		if ($userFromDb) {
			return tool\ResponseTool::show(1,'user修改成功',$userFromDb->objToArr());
		}else{
			return tool\ResponseTool::show(406,'修改失败',NULL);
		}
		
	}
	//通过userid查用户信息
	public function infoUser($userFromView){
		$userDALModel=new DAL\UserDALModel;
		$userFromDb=$userDALModel->SelectByUserId($userFromView->userId);
		if ($userFromDb) {
			return tool\ResponseTool::show(1,'user查询成功',$userFromDb->objToArr());
		}else{
			//查无此人
			return tool\ResponseTool::show(405,'此用户不存在',NULL);
		}
		
	//	return $this->userArr_json($this->userObj_Arr($userFromDb));
	}

}