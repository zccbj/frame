<?php 
namespace app\controller;
use app\model\OBJ as OBJ;
use app\model\BLL as BLL;
use framework\tool as tool;
class UserController extends \framework\lib\Controller{

	public function modifyAction(){
		  $data=$_POST['data'];
		// echo $data;
		// $data='{"userId":"46","nickName":"32"}';
		$data=json_decode($data);//转换为为了data对象
		$userFromView=new OBJ\UserObjModel;
		$userFromView->userId=$data->userId;
		$userFromView->nickName=$data->nickName;
	//	$userFromView->telNumber=$data->telNumber;
		$userFromView->account=$data->account;
	//	$userFromView->password=$data->password;
		$userFromView->gender=$data->gender;
		$userFromView->age=$data->age;
		$userFromView->emotionStatus=$data->emotionStatus;
		$userFromView->userIntro=$data->userIntro;
		$userFromView->headimgURL=$data->headimgURL;
	//	$userFromView->openId=$data->openId;
	//	$userFromView->EmailAddress=$data->EmailAddress;
		$userFromView->addCountry=$data->addCountry;
		$userFromView->addProvince=$data->addProvince;
		$userFromView->addCity=$data->addCity;
		$userBLLModel=new BLL\UserBLLModel;

		$userObj=$userBLLModel->modifyUser($userFromView);
		if ($userObj) {
			echo tool\ResponseTool::show(1,'user修改成功',$userObj->objToArr());
		}else{
			echo tool\ResponseTool::show(406,'修改失败',NULL);
		}

	}
	/**查询user信息
	 * 根据userid
	 */
	public function infouserAction(){
		$userId=$_POST['userId'];
		$userFromView=new OBJ\UserObjModel;
		$userFromView->userId=$userId;
		$userBLLModel=new BLL\UserBLLModel;
		$userObj=$userBLLModel->infoUser($userFromView);
		if ($userObj) {
			echo tool\ResponseTool::show(1,'user查询成功',$userObj->objToArr());
		}else{
			//查无此人
			echo tool\ResponseTool::show(405,'此用户不存在',NULL);
		}
	}
	//根据用户userId修改nickName或userIntro
	public function modifyoneAction(){
		$userId=$_POST['userId'];
		@$nickName=$_POST['nickName']?$_POST['nickName']:null;
		@$userIntro=$_POST['userIntro']?$_POST['userIntro']:null;
		$userFromView=new OBJ\UserObjModel;
		$userFromView->userId=$userId;
		$userFromView->nickName=$nickName;
		$userFromView->userIntro=$userIntro;
		$userBLLModel=new BLL\UserBLLModel;
		$userObj=$userBLLModel->modifyUser($userFromView);
		if ($userObj) {
			echo  tool\ResponseTool::show(1,'user修改成功',$userObj->objToArr());
		}else{
			echo  tool\ResponseTool::show(406,'修改失败',NULL);
		}
	}
	
}

