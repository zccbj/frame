<?php
namespace app\model\DAL;
use app\model\OBJ as OBJ;
use app\model\DAL as DAL;
use framework\lib as lib;
use framework\tool as tool;
class UserDALModel extends lib\Model{
	//{$this->table()}来自于父类
	protected $table_name = 'user';
	
	//openid查找用户，返回对象
	public function checkByOpenId($openId){
		$sql="select * from {$this->table()} where openId='$openId' ";
		$User_info=$this->db->fetchRow($sql);
		if ($User_info) {
			$user=tool\ArrToObjTool::arrToObj($User_info,'User');

			return $user;
		}else{
			return NULL;
		}
	}
	//通过用户名登入。返回对象
	public function checkByAccount($account){
		$sql="select * from {$this->table()} where account='$account' ";
		$User_info=$this->db->fetchRow($sql);
		if ($User_info) {
			$user=tool\ArrToObjTool::arrToObj($User_info,'User');
			return $user;
		}else{
			return NULL;
		}
	}
	//通过useid来查询。返回对象
	public function SelectByUserId($userId){

		if ($message=$this->autoSelectRow($userId)) {
			return tool\ArrToObjTool::arrToObj($message,'User');
		}
	}
	//pc注册，返回的对象
	public function InsertByUser($userArr){
		if($this->checkByaccount($userArr['account'])){
				return false;
		}
		if ($message=$this->autoInsert($userArr)) {
			$user=$this->checkByaccount($userArr['account']);
			return $user;
		}

	}
	//相当于注册微信用户，返回对象
	public function InsertByUserWc($userArr){
		if ($message=$this->autoInsert($userArr)) {
			$user=$this->checkByOpenId($userArr['openId']);
			return $user;
		}
	}
	//修改用户信息,返回对象//通过传入的数组是整个或者一个进行数组拼接。
	public function ModifyByUser($userArr){
		if ($message=$this->autoUpdate($userArr)) {
			$user=$this->SelectByUserId($userArr['userId']);
			return $user;
		}
	}
	
}
