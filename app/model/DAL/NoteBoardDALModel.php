<?php
namespace app\model\DAL;
use framework\lib as lib;
use framework\tool as tool;
class NoteBoardDALModel extends lib\Model{
	protected $table_name='noteBoard';

	public function insertNoteBoard($noteBoardArr){
		if ($reslut=$this->autoInsert($noteBoardArr)) {
			
			$noteBoardObjFromDb=$this->selectByUserId($noteBoardArr['userId']);

			return $noteBoardObjFromDb;
		}
	}
	//根据userId在noteboard中查找数据
	public function selectByUserId($userId){
		$sql=$this->from($this->table_name)->where("userId='$userId'")->select();
		 $noteBoardFromDbArr= $this->db->fetchRow($sql);
		$noteBoardObjFromDb= tool\ArrToObjTool::arrToObj($noteBoardFromDbArr,'NoteBoard');
		return $noteBoardObjFromDb;
	}
	//根据noteBoardId在noteboard中查找数据
	public function selectByNoteBoardId($noteBoardId){
		$noteBoardFromDbArr= $this->autoSelectRow($noteBoardId);;
		$noteBoardObjFromDb= tool\ArrToObjTool::arrToObj($noteBoardFromDbArr,'NoteBoard');
		return $noteBoardObjFromDb;

	}
	public function updateNoteBoard($noteBoardArr){
		$message=$this->autoUpdate($noteBoardArr);
		return $this->selectByNoteBoardId($noteBoardArr['noteBoardId']);
	}
	
}