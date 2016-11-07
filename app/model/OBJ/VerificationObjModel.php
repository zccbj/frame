<?php
namespace app\model;
class VerificationObjModel{
	private $verificationId;
	private $telNumber;
	private $verificationNumber;
	private $createTime;
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
		foreach ($arr as $key => $value) {
			$this->$key=$value;
		}

	}

}