<?php
namespace app\model\BLL;
use app\model\OBJ as OBJ;
use app\model\DAL as DAL;
use framework\tool as tool;
class NoteBoardBLLModel{

	public function infoNoteBoard($noteBoardObjModel){
		$userId=$noteBoardObjModel->userId;
		$noteBoardDALModel=new DAL\NoteBoardDALModel;
		$noteBoardObjFromDb=$noteBoardDALModel->selectByUserId($userId);
		
		if ($noteBoardObjFromDb) {
			$noteBoardObjFromDbArr=$noteBoardObjFromDb->objToArr();
			return tool\ResponseTool::show(1,'noteBoard查询成功',$noteBoardObjFromDbArr);
		
		}else{
			return tool\ResponseTool::show(0,'noteBoard查询失败',$noteBoardObjFromDb);
		
		}
		

	}
	public function modifyNoteBoard($noteBoardObjModel){
		$noteBoardArr=$noteBoardObjModel->objToArr();
		$noteBoardDALModel=new DAL\NoteBoardDALModel;

		$noteBoardObjFromDb=$noteBoardDALModel->updateNoteBoard($noteBoardArr);
		if ($noteBoardObjFromDb) {
			$noteBoardObjFromDbArr=$noteBoardObjFromDb->objToArr();
			return tool\ResponseTool::show(1,'noteBoard修改成功',$noteBoardObjFromDbArr->objToArr());
		
		}else{
			return tool\ResponseTool::show(0,'noteBoard修改失败',$noteBoardObjFromDb);
		
		}
		
		

	}


}