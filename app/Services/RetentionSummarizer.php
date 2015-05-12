<?php
/**
 * Created by IntelliJ IDEA.
 * User: takahashi
 * Date: 2015/03/21
 * Time: 12:04
 * To change this template use File | Settings | File Templates.
 */

namespace App\Services;

use App\Models\Item;
use App\Models\UserGroup;
use App\Models\RetentionData;
use Illuminate\Support\Facades\DB;

class RetentionSummarizer
{

	private $item;

	public function __construct(Item $item)
	{
		$this->item = $item;
	}

	public function getUserGroups($from, $to, $loopCount)
	{

		$cursorDate = null;

		if ($this->item->user_grouping_span_type === 0) {
			$cursorDate = $from;
			$endDate = $to;
		}elseif ($this->item->user_grouping_span_type === 1) {
			$week = date('w', strtotime($from));
			$cursorDate = date('Y-m-d', strtotime("$from -$week day"));
			$week = date('w', strtotime($to));
			$endDate = date('Y-m-d', strtotime("$to -$week day"));
		}elseif ($this->item->user_grouping_span_type === 2) {
			$cursorDate = date('Y-m-01', strtotime($from));
			$endDate = date('Y-m-01', strtotime($to));
		}

		$userGroups = [];

		while (true) {

			$userGroup = $this->sumUserGroup($cursorDate);

			for($i=1; $i<=$loopCount; $i++){
				$this->sumRetentionData($userGroup, $i);
			}

			$userGroups[] = $userGroup;

			$cursorDate = $this->getNextUserGroupDate($cursorDate);
			if ($cursorDate > $endDate) break;
		}

		return $userGroups;

	}

	private function getNextUserGroupDate($date)
	{
		return date("Y-m-d", strtotime("{$date} {$this->item->getUserGroupingSpanOffset()}"));
	}

	public function sumUserGroup($date)
	{
		$userDefinition = $this->item->project->userDefinition;
		$value = DB::connection($this->item->project->db)
			->table($userDefinition->table_name)
			->where($userDefinition->date_column, '>=', $date)
			->where($userDefinition->date_column, '<', $this->getNextUserGroupDate($date))
			->count();

		$userGroup = UserGroup::where('item_id', $this->item->id)->where('user_grouping_date', $date)->first();
		if(!$userGroup){
			$userGroup = new UserGroup();
			$userGroup->user_grouping_date = $date;
		}
		$userGroup->value = $value;
		return $this->item->userGroups()->save($userGroup);

	}

	public function sumRetentionData(UserGroup $userGroup, $sequence){

		$date = $userGroup->user_grouping_date;
		$userDefinition = $this->item->project->userDefinition;
		$userTable = $userDefinition->table_name;
		$activityTable = $this->item->table_name;

		$value = DB::connection($this->item->project->db)
			->table($userTable)
			->join(
				$activityTable,
				"$userTable.$userDefinition->user_id_column",
				'=',
				"$activityTable.{$this->item->user_id_column}"
			)
			->where("$userTable.$userDefinition->date_column", '>=', $date)
			->where("$userTable.$userDefinition->date_column", '<', $this->getNextUserGroupDate($date))
			->whereRaw("$activityTable.{$this->item->date_column} >= $userTable.$userDefinition->date_column + INTERVAL {$this->item->getRetentionSpanOffset($sequence)}")
			->whereRaw("$activityTable.{$this->item->date_column} < $userTable.$userDefinition->date_column + INTERVAL {$this->item->getRetentionSpanOffset($sequence + 1)}")
			->count(DB::raw("DISTINCT $activityTable.{$this->item->user_id_column}"))
			;

		$retentionData = RetentionData::where('user_group_id', $userGroup->id)->where('sequence', $sequence)->first();
		if(!$retentionData){
			$retentionData = new RetentionData();
			$retentionData->sequence = $sequence;
		}
		$retentionData->value = $value;
		$userGroup->retentionDatas()->save($retentionData);
			//->get();
		//->getQueryLog();
		//print_r(DB::connection($this->item->project->db)->getQueryLog());
		//print_r( $value);
	}

}