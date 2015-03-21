<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model {

	public function item(){
		return $this->belongsTo('App\Models\Item');
	}

	public function retentionDatas(){
		return $this->hasMany('App\Models\RetentionData');
	}
}
