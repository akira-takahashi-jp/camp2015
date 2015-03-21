<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $fillable = ['name', 'table_name', 'user_id_column_name', 'other_criteria', 'date_column', 'retention_span_type', 'user_grouping_span_type', 'start_date'];

	public static $retentionSpanTypeAttr = [0 => "日", 1 => "週", 2 => "月"];
	public static $userGroupingSpanTypeAttr = [0 => "日", 1 => "週", 2 => "月"];

	public function project(){
		return $this->belongsTo('App\Models\Project');
	}

}
