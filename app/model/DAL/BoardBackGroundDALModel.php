<?php
namespace app\model\DAL;
use framework\tool as tool;
use framework\lib as lib;
	class BoardBackGroundDALModel extends lib\Model{
		protected $table_name='boardBackGround';
		

		//返回对象数组
		public function selectByNo(){
			$sql=$this->from($this->table_name)->select();
			$boardBackGroundArr=$this->db->fetchAll($sql);
			//return $boardBackGroundArr;
			
			$objArr=tool\ArrToObjTool::arr2ToObj($boardBackGroundArr,'boardBackGround');

			return $objArr;
		}


	}