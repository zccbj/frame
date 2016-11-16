<?php
namespace app\controller;
use app\model\OBJ as OBJ;
use app\model\BLL as BLL;
use framework\tool as tool;
class NoteController extends \framework\lib\Controller{
	//g,d,m,a,
	//根据userid获取用户所有note
	public function gNoteAction(){
		$userId=$_POST['userId'];
		$noteBoardObj=new OBJ\NoteBoardObjModel;
		$noteBoardObj->userId=$userId;

		$noteBLLModel=new BLL\NoteBLLModel;
		$noteObj=$noteBLLModel->infoNote($noteBoardObj);
		echo ($noteObj);
	}
	//根据noteid和userid获取一条note
	public function gNoteByIdAction(){
		 $userId=$_POST['userId'];
		 $noteId=$_POST['noteId'];
		$noteBoardObj=new OBJ\NoteBoardObjModel;
		$noteBoardObj->userId=$userId;
		$noteBLLModel=new BLL\NoteBLLModel;
		$noteObj=$noteBLLModel->infoNoteById($noteBoardObj,$noteId);
		echo ($noteObj);
	}
	//添加一条note
	public function aNoteAction(){
		$userId=$_POST['userId'];
		$data=$_POST['data'];
		$data= json_decode($data,true);//加上true就转换成数组。不加则转换成对象
		$data['noteDateTime']=date('Y-m-d H:i:s');
		$noteObj=tool\ArrToObjTool::arrToObj($data,'Note');
		$noteBLLModel=new BLL\NoteBLLModel;
		$result=$noteBLLModel->addNote($userId,$noteObj);
		echo $result;
	}
	public function uNoteAction(){
		$data=$_POST['data'];
		$data= json_decode($data,true);//加上true就转换成数组。不加则转换成对象
		$data['noteUpdateTime']=date('Y-m-d H:i:s');
		$noteObj=tool\ArrToObjTool::arrToObj($data,'Note');

		$noteBLLModel=new BLL\NoteBLLModel;
		$result=$noteBLLModel->modifyNote($noteObj);
		echo $result;


	}
	public function dNoteAction(){
		$noteId=$_POST['noteId'];
		$userId=$_POST['userId'];
	
		$noteObj=new OBJ\NoteObjModel;
 		$noteObj->noteId=$noteId;
 		$noteBLLModel=new BLL\NoteBLLModel;
 		$result=$noteBLLModel->delNote($userId,$noteObj);
 		echo $result;

	}
}