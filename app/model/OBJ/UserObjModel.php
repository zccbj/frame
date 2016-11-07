<?php
namespace app\model\OBJ;
class UserObjModel{
	private $userId;
	private $nickName;
	private $telNumber;
	private $account;
	private $password;
	private $gender;
	private $age;
	private $emotionStatus;
	private $userIntro;
	private $headimgURL;
	private $openId;
	private $EmailAddress;
	private $addCountry;
	private $addProvince;
	private $addCity;
	public function __set($key,$vaule){
		$this->$key=$vaule;
	}
	public function __get($key){
		if (isset($this->$key)) {
			return $this->$key;
		}else{
			return NULL;
		}
	}
	public function __construct($arr=NULL){
		if (!empty($arr)) {
			foreach ($arr as $key => $value) {
			$this->$key=$value;
			}
		}
	}
	public function ObjToArr() {	  
	    foreach ($this as $key => $value) {
	      $array[$key] = $value;
	    }

	  return $array;
	}
}