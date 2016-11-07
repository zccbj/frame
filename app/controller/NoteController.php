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
		//$userId=1;
		//$data='{"noteStatus":"1","pictureURL":"","boolPicture":"","noteContent":"你好，世界","boolUrgent":"","voiceURL":"","boolVoice":"","noteTypeId":"2","boolOpen":"1","noteUpdateTime":null,"likeCount":"1","noteBoardId":"7"}';
		$data= json_decode($data);

 		$noteObj=new OBJ\NoteObjModel;
 		
 		$noteObj->noteDateTime=date('Y-m-d H:i:s');

 		$noteObj->noteBoardId=$data->noteBoardId;
 		$noteObj->noteStatus=$data->noteStatus;
		$noteObj->pictureURL=$data->pictureURL;
		$noteObj->boolPicture=$data->boolPicture;
		// $noteObj->noteDateTime=$data->noteDateTime;
		// $noteObj->noteUpdateTime;
		$noteObj->duration=$data->duration;
		$noteObj->noteContent=$data->noteContent;
		$noteObj->boolOpen=$data->boolOpen;
		$noteObj->boolUrgent=$data->boolUrgent;
		$noteObj->voiceURL=$data->voiceURL;
		$noteObj->boolVoice=$data->boolVoice;
		$noteObj->noteBoardId=$data->noteBoardId;
		$noteObj->noteTypeId=$data->noteTypeId;
		$noteObj->likeCount=$data->likeCount;

		//var_dump($noteObj);
		$noteBLLModel=new BLL\NoteBLLModel;
		$result=$noteBLLModel->addNote($userId,$noteObj);
		echo $result;
	}
	public function uNoteAction(){
		$data=$_POST['data'];
	//	$data='{"noteId":"7","noteStatus":"1","pictureURL":"","boolPicture":"","noteContent":"你好，界","boolUrgent":"","voiceURL":"","boolVoice":"","noteTypeId":"2","boolOpen":"1","noteUpdateTime":null,"likeCount":"1","noteBoardId":"7"}';
		$data= json_decode($data);
 		$noteObj=new OBJ\NoteObjModel;
 		$noteObj->noteId=$data->noteId;
 		$noteObj->noteBoardId=$data->noteBoardId;
 		$noteObj->noteStatus=$data->noteStatus;
		$noteObj->pictureURL=$data->pictureURL;
		$noteObj->boolPicture=$data->boolPicture;
		$noteObj->noteDateTime=$data->noteDateTime;
		$noteObj->noteUpdateTime=date('Y-m-d H:i:s');
		$noteObj->duration=$data->duration;
		$noteObj->noteContent=$data->noteContent;
		$noteObj->boolOpen=$data->boolOpen;
		$noteObj->boolUrgent=$data->boolUrgent;
		$noteObj->voiceURL=$data->voiceURL;
		$noteObj->boolVoice=$data->boolVoice;
		$noteObj->noteBoardId=$data->noteBoardId;
		$noteObj->noteTypeId=$data->noteTypeId;
		$noteObj->likeCount=$data->likeCount;


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