<?php 


namespace App\Models;

use CodeIgniter\Model;

class ReviewsModel extends Model{
	protected $table = 'reviews';
	protected $primaryKey = 'id';
	protected $allowedFields = ['user_id', 'product_id', 'rating', 'review', 'created_at', 'updated_at'];
	protected $returnType = 'array';
	protected $useTimestamps = true;

	public function getReviews($product_id){
		return $this->where('product_id', $product_id)->findAll();
	}


	public function getReview($product_id, $user_id){
		return $this->where('product_id', $product_id)->where('user_id', $user_id)->first();
	}

	public function getReviewById($id){
		return $this->where('id', $id)->first();
	}

	public function getReviewByUser($user_id){
		return $this->where('user_id', $user_id)->findAll();
	}

	public function getReviewByProduct($product_id){
		return $this->where('product_id', $product_id)->findAll();
	}

	public function creerReview($data){
		return $this->insert($data);
	}

	public function AjouterReview($id,$user_id,$product_id): bool|int|string{
		$data=[
			"id" => $id,
			"user_id" =>$user_id,
			"product_id" =>$product_id,
			"rating" => 0,
			"review" => "",
			"created_at" => date('Y-m-d H:i:s'),
			"updated_at" => date('Y-m-d H:i:s')
		];
		return $this->insert($data);
	}

	public function updateReview($id, $data){
		$entity = $this->find($id);
		if($entity){
			return $this->update($id, $data);
		}else{
			return false;
		}
	}

	public function deleteReview($id){
		$entity = $this->find($id);
		if($entity){
			return $this->delete($id);
		}else{
			return false;
		}
	}

}	
?>