<?php



namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model{
	protected $table = 'messages';
	protected $primaryKey = 'message_id';
	protected $allowedFields = ['from_id', 'to_id', 'message', 'created_at', 'updated_at'];
	protected $returnType = 'array';
	protected $useTimestamps = true;

	public function getMessages($from_id, $to_id){
		return $this->where('from_id', $from_id)->where('to_id', $to_id)->findAll();
	}

	public function getMessage($from_id, $to_id){
		return $this->where('from_id', $from_id)->where('to_id', $to_id)->first();
	}

	public function CreerMessage($message_id,$from_id, $to_id, $message){
		$data = [
			'message_id' => $message_id,
			'from_id' => $from_id,
			'to_id' => $to_id,
			'message' => $message,
		];
		$this->save($data);
	}	

	public function getMessagesByUser($message_id){
		return $this->where('from_id', $message_id)->orWhere('to_id', $message_id)->findAll();
	}

	public function UpdateMessage($message_id, $data){
		$idexiste = $this->find($message_id);
		if($idexiste){
			$this->update($message_id, $data);
		}
	}

	public function DeleteMessage($message_id){
		$idexiste = $this->find($message_id);
		if($idexiste){
			$this->delete($message_id);
		}
		else{
			return false;	
		}
	}	

}

?>