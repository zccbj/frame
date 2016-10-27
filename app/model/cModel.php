<?php
namespace app\model;
use framework\lib\Model;
class cModel extends Model{
	protected $table_name='user';
	public function add(){
		$sql=$this->from()->select();;
		$this->db->fetchAll($sql);
	}
	
}