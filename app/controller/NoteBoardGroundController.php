<?php 
namespace app\controller;
use app\model\BLL as BLL;
use framework\tool as tool;
class NoteBoardGroundController extends \framework\lib\Controller{
	//查询boardbackground
	public function gboardbackgroundAction(){
		$boardBackGroundBLLModel=new BLL\BoardBackGroundBLLModel;
		$result=$boardBackGroundBLLModel->infoBoardBackGround();
		echo $result;
	}
	
}