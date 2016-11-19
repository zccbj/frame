<?php 
namespace app\controller;
use app\model\OBJ as OBJ;
use app\model\BLL as BLL;
use framework\tool as tool;
class VerificationController extends \framework\lib\Controller{
	public function sdMessageAction(){
		$telNumber=$_POST['telNumber'];
		$verificationObj=new OBJ\VerificationObjModel();
		$verificationObj->telNumber=$telNumber;
//查询一下这个tel是否已经注册
		$user=new OBJ\UserObjModel();
		$user->telNumber=$verificationObj->telNumber;
		$userBLL=new BLL\UserBLLModel();
		$userObj=$userBLL->infoUserBytel($user);
		if ($userObj) {
			echo tool\ResponseTool::show(1,'user已存在',$userObj->objToArr());
		}
//进行注册
		$verificat=new BLL\VerificationBLLModel;
		$verificatObj=$verificat->sendAndAdd($verificationObj);
		echo tool\ResponseTool::show(1,'send message ok',$verificatObj->objToArr());

	}
	public function verificatMessageAction(){
		$telNumber=$_POST['telNumber'];
		$verificationNumber=$_POST['verificationNumber'];
		$verificationObj=new OBJ\VerificationObjModel;
		$verificationObj->telNumber=$telNumber;
		$verificationObj->verificationNumber=$verificationNumber;
		$verificat=new BLL\VerificationBLLModel;
		$verificatFromDb=$verificat->checkVerification($verificationObj);
		if ($verificatFromDb) {
			//验证成功，对用户进行添加
				$user=new OBJ\UserObjModel();
				$user->telNumber=$verificatFromDb->telNumber;
				
				$userBLL=new BLL\UserBLLModel();
				$user=$userBLL->registerTel($user);
			if ($user) {
				echo tool\ResponseTool::show(1,'Tel注册成功',$user->objToArr());
		
			}else{
				echo tool\ResponseTool::show(401,'用户已存在tel',NULL);
			}
		}else{
			//说明验证都没成功
			echo tool\ResponseTool::show(416,'fault verification',null);
		}

				
	}
	
}