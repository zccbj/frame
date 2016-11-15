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
		$verificat=new BLL\VerificationBLLModel;
		$reslut=$verificat->sendAndAdd($verificationObj);
		echo $reslut;
	}
	public function verificatMessageAction(){
		$telNumber=$_POST['telNumber'];
		$verificationNumber=$_POST['verificationNumber'];
		$verificationObj=new OBJ\VerificationObjModel;
		$verificationObj->telNumber=$telNumber;
		$verificationObj->verificationNumber=$verificationNumber;
		$verificat=new BLL\VerificationBLLModel;
		$reslut=$verificat->checkVerification($verificationObj);
		//var_dump($reslut);
		echo $reslut;
	}
	
}