<?php


namespace App\Models;

use CodeIgniter\Model;


class AppointmentsModel extends Model{


	protected $table = 'appointments';
	protected $primaryKey = 'appointment_id';
	protected $allowedFields = ['student_id', 'tutor_id', 'date', 'time', 'status', 'created_at', 'updated_at'];
	protected $returnType = 'array';
	protected $useTimestamps = true;

	public function getAppointments(){
		return $this->findAll();
	}

	public function getAppointment($appointment_id){
		return $this->find($appointment_id);
	}

	public function CreerAppointment($student_id, $tutor_id, $date, $time, $status){
		$data = [
			'student_id' => $student_id,
			'tutor_id' => $tutor_id,
			'date' => $date,
			'time' => $time,
			'status' => $status,
		];
		$this->save($data);
	}	

	public function UpdateAppointment($appointment_id, $data){
		$idexiste = $this->find($appointment_id);
		if($idexiste){
			$this->update($appointment_id, $data);
		}
	}

	public function DeleteAppointment($appointment_id){
		$idexiste = $this->find($appointment_id);
		if($idexiste){
			$this->delete($appointment_id);
		}
		else{
			return false;	
		}
	}
}