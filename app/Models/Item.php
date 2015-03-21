<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $fillable = ['name', 'table_name', 'user_id_column', 'other_criteria', 'date_column', 'retention_span_type', 'user_grouping_span_type'];

	public static $retentionSpanTypeAttr = [0 => "日", 1 => "週", 2 => "月"];
	public static $userGroupingSpanTypeAttr = [0 => "日", 1 => "週", 2 => "月"];

	public function project(){
		return $this->belongsTo('App\Models\Project');
	}

	public function userGroups(){
		return $this->hasMany('App\Models\UserGroup');
	}

	public function getUserGroupingSpanOffset(){
		if($this->user_grouping_span_type === 0) return '+1 day';
		elseif($this->user_grouping_span_type === 1) return '+1 week';
		elseif($this->user_grouping_span_type === 2) return '+1 month';
	}

}
