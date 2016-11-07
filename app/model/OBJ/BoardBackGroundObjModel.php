<?php
namespace app\model\OBJ;
class BoardBackGroundObjModel{
	private $boardBackGroundId;
	private $boardBackGroundName;
	public function __set($key,$value){
		$this->$key=$value;
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