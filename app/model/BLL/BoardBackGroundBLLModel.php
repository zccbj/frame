<?php
namespace app\model\BLL;
use app\model\DAL as DAL;
use framework\tool as tool;
	class BoardBackGroundBLLModel{
	//BoardBackGround的
	public function infoBoardBackGround(){

		$boardBackGroundDALModel=new DAL\BoardBackGroundDALModel;
		$arrObjFromDb=$boardBackGroundDALModel->selectByNo();
		if ($arrObjFromDb) {
			$arr2=tool\ArrToObjTool::objArrToArr($arrObjFromDb);
			$a=tool\ResponseTool::show(1,'noteBoardGround查询成功',$arr2);
			
		}else{
			return tool\ResponseTool::show(407,'noteBoardGround查询失败',$arrFromDb);
		
		}
		
	} 
}
