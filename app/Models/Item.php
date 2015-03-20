<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $fillable = ['name', 'table_name', 'user_id_column_name', 'other_criteria', 'date_column', 'retention_span', 'user_grouping_span', 'start_date'];

	public function project(){
		return $this->belongsTo('App\Models\Project');
	}

}
