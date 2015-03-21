<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDefinition extends Model {

	protected $fillable = ['table_name', 'user_id_column', 'date_column'];
	protected $guarded = ['project_id'];

	public function project(){
		return $this->belongsTo('App\Models\Project');
	}

}
