<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserDefinition;

class Project extends Model {

	protected $fillable = ['name'];

	public function userDefinition(){
		return $this->hasOne('App\Models\UserDefinition');
	}

}
