<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $fillable = ['name'];

	public function userDefinition(){
		return $this->hasOne('App\Models\UserDefinition');
	}

	public function items(){
		return $this->hasMany('App\Models\Item');
	}

}
