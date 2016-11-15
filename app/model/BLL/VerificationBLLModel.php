<?php
namespace app\model\BLL;
use app\model\OBJ as OBJ;
use app\model\DAL as DAL;
use framework\tool as tool;
class VerificationBLLModel{
	public function sendAndAdd($verificationObjFromView){
		$user=new OBJ\UserObjModel();
				$user->telNumber=$verificationObjFromView->telNumber;
				$userBLL=new UserBLLModel();
				$result=$userBLL->infoUserBytel($user);
				$a=json_decode($result);
if ($a->sign==1) {
	$a->sign=417;
	$result=json_encode($a,JSON_UNESCAPED_UNICODE);
	//说明这个用户已存在
	return $result;

}


		$tel=$verificationObjFromView->telNumber;
		$num=mt_rand(100000,999999);
		$verificationObjFromView->verificationNumber=$num;
		$verificationObjFromView->createTime=date('Y-m-d H:i:s');
		// echo date('Y-m-d H:i:s',strtotime('+20 minute'));
		// echo(strtotime("now") . "<br>");
		$verificationObjFromView->telNumber=$tel;
		$data="num=$num&tel=$tel";
		echo 'send message:'.$data;
		// $curlobj=curl_init();
		// curl_setopt($curlobj,CURLOPT_URL,"http://localhost/tbsdk/test.php");
		// curl_setopt($curlobj,CURLOPT_RETURNTRANSFER,1);
		// curl_setopt($curlobj,CURLOPT_POST,1);
		// curl_setopt($curlobj,CURLOPT_POSTFIELDS,$data);
		// curl_setopt($curlobj,CURLOPT_HTTPHEADER,array("application/x-www-form-urlencoded; charset=utf-8", "Content-length: ".strlen($data)));
		// $rtn=curl_exec($curlobj);
		// if(!curl_errno($curlobj)){
		// 	echo  $rtn;

		// }else{
		// 	echo 'Curl error'.curl_errno($curlobj);
		// }
		// curl_close($curlobj);
		$verificationArr=$verificationObjFromView->objToArr();
		$verificationDAL=new DAL\VerificationDALModel();
		$already=$verificationDAL->selectBytelNumber($verificationArr['telNumber']);
		if (!empty($already)) {//已经存在了这个家伙
			$verificationArr['verificationId']=$already->verificationId;
			$verificatObjFromDb=$verificationDAL->updateMessage($verificationArr);
		}else{
			$verificatObjFromDb=$verificationDAL->insertMessage($verificationArr);
		}
		
		return tool\ResponseTool::show(1,'send message ok',$verificatObjFromDb->objToArr());


	}
	public function checkVerification($verificationObjFromView){
		// $verificationArr=$verificationObjFromView->objToArr();
		$verificationDAL=new DAL\VerificationDALModel();
		$verificatObjFromDb=$verificationDAL->selectBytelNumber($verificationObjFromView->telNumber);
		//var_dump($verificatObjFromDb);
		$message=$verificatObjFromDb->verificationNumber;
		$theTime=$verificatObjFromDb->createTime;

		if (strtotime("$theTime +20 minute")<strtotime("now")) {
			//超出了有效时间
			return tool\ResponseTool::show(415,'timeout verification',null);
		}else{
			if ($verificationObjFromView->verificationNumber!=$message) {
				//验证错误
				return tool\ResponseTool::show(416,'fault verification',null);
			}
			else{
				//验证成功，对用户进行添加
					$user=new OBJ\UserObjModel();
					$user->telNumber=$verificatObjFromDb->telNumber;
					$userBLL=new UserBLLModel();
					$result=$userBLL->registerPc($user);
					$a=json_decode($result);
				if ($a->sign!=1) {
					return $result;
				}else{
					return tool\ResponseTool::show(1,'success verification',$verificatObjFromDb->objToArr());

				}
				
			}
		}

		
		

	}
}