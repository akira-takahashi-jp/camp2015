<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetentionData extends Model {

	public function userGroup(){
		return $this->belongsTo('App\Models\UserGroup');
	}

}
