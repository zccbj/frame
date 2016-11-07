<?php
namespace app\controller;
use app\model\OBJ as OBJ;
use app\model\BLL as BLL;
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
				$result=$userBLLModel->signWc($userFromView);
				echo $result;
		}elseif($from=='pc') {
			$account=$_POST['account'];
			$password=$_POST['password'];
			$userFromView=new OBJ\UserObjModel;
			$userFromView->account=$account;
			$userFromView->password=md5($password);
			$userBLLModel=new BLL\UserBLLModel;
			$result=$userBLLModel->signPc($userFromView);
			echo $result;
		}
	}
	/**
	 * pc注册（微信不需要注册）
	 *参数：用户用、密码
	 *
	 */
	public function registerIphoneAction(){
		//手机注册
		// $account=$_POST['account'];
		// $password=$_POST['password'];
		// $userFromView=new UserObjModel;
		// $userFromView->account=$account;
		// $userFromView->password=md5($password);
		// $userBLLModel=new UserBLLModel;
		// $result=$userBLLModel->registerPc($userFromView);
		// echo $result;
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