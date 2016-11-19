<?php
namespace app\controller;
use app\model\OBJ as OBJ;
use app\model\BLL as BLL;
use framework\tool as tool;
class UserEnterController extends \framework\lib\Controller{
		/**wx、pc用户登入
	 * 参数:wehcat,openId,headimgURL,nickName,addCountry,addProvice,addCity,
	 */
	public function signAction(){
		$from=$_POST['from'];
		if ($from=='wechat') {
				$openId=$_POST['openId'];
				$headimgURL=$_POST['headimgURL'];
				$nickName=$_POST['nickName'];
				@$addCountry=$_POST['addCountry'];
				@$addProvince=$_POST['addProvince'];
				@$addCity=$_POST['addCity'];

				$userFromView=new OBJ\UserObjModel;
				$userFromView->openId=$openId;
				$userFromView->headimgURL=$headimgURL;
				$userFromView->nickName=$nickName;
				$userFromView->addCountry=$addCountry;
				$userFromView->addProvince=$addProvince;
				$userFromView->addCity=$addCity;
				$userBLLModel=new BLL\UserBLLModel;
				$userObj=$userBLLModel->signWc($userFromView);
				echo tool\ResponseTool::show(1,'微信登入成功',$userObj->objToArr());;
		}elseif($from=='pc') {
			$account=$_POST['account'];
			$password=$_POST['password'];
			$userFromView=new OBJ\UserObjModel;
			$userFromView->account=$account;
			$userFromView->password=md5($password);
			$userBLLModel=new BLL\UserBLLModel;
			$user=$userBLLModel->signPc($userFromView);
			if ($user) {
				echo  tool\ResponseTool::show(1,'pc登入成功',$user->objToArr());
			}else{
				echo tool\ResponseTool::show(402,'pc登入失败',NULL);
			}
		}
	}
	/**
	 * pc注册（微信不需要注册）
	 *参数：用户用、密码
	 *
	 */
	public function registerIphoneAction(){

	}
	public function registerWebAction(){
		//邮箱注册
		// $account=$_POST['account'];
		// $password=$_POST['password'];
		// $userFromView=new UserObjModel;
		// $userFromView->account=$account;
		// $userFromView->password=md5($password);
		// $userBLLModel=new UserBLLModel;
		// $result=$userBLLModel->registerPc($userFromView);
		// echo $result;
	}
}