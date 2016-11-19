<?php 
namespace app\controller;
use app\model\BLL as BLL;
use framework\tool as tool;
class NoteBoardGroundController extends \framework\lib\Controller{
	//查询boardbackground
	public function gboardbackgroundAction(){
		$boardBackGroundBLLModel=new BLL\BoardBackGroundBLLModel;
		$arrObjFromDb=$boardBackGroundBLLModel->infoBoardBackGround();
		if ($arrObjFromDb) {
			$arr2=tool\ArrToObjTool::objArrToArr($arrObjFromDb);
			echo tool\ResponseTool::show(1,'noteBoardGround查询成功',$arr2);
			
		}else{
			echo tool\ResponseTool::show(407,'noteBoardGround查询失败',$arrFromDb);
		
		}
	}
	
}