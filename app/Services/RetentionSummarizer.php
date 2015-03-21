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
		}

		while (true) {
			//日
			if ($this->item->user_grouping_span_type === 0) {
				if ($cursorDate > $to) break;
				else $cursorDate = $this->getNextUserGroupDate($cursorDate);
			}

//			echo $cursorDate;

			$userGroup = $this->sumUserGroup($cursorDate);

			for($i=1; $i<=$loopCount; $i++){
				$this->sumRetentionData($userGroup, $i);
			}
		}

	}

	private function getNextUserGroupDate($date)
	{
		return date("Y-m-d", strtotime("{$date} {$this->item->getUserGroupingSpanOffset()}"));
	}

	private function getRetentionDate($userGroupingDate, $sequence)
	{
		if($sequence === 1) return $userGroupingDate;
		return date("Y-m-d", strtotime("{$userGroupingDate} {$this->item->getRetentionSpanOffset($sequence)}"));
	}

	public function sumUserGroup($date)
	{
		$userDefinition = $this->item->project->userDefinition;
		$value = DB::connection($this->item->project->db)
			->table($userDefinition->table_name)
			->where($userDefinition->date_column, '>=', $date)
			->where($userDefinition->date_column, '<', $this->getNextUserGroupDate($date))
			->count();

		$userGroup = new UserGroup();
		$userGroup->user_grouping_date = $date;
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
			->where("$activityTable.{$this->item->date_column}", '>=', $this->getRetentionDate($date, $sequence))
			->where("$activityTable.{$this->item->date_column}", '<', $this->getRetentionDate($date, $sequence + 1))
			->count(DB::raw("DISTINCT $activityTable.{$this->item->user_id_column}"))
			;

		$retentionData = new RetentionData();
		$retentionData->sequence = $sequence;
		$retentionData->value = $value;
		$userGroup->retentionDatas()->save($retentionData);
			//->get();
		//->getQueryLog();
		//print_r(DB::connection($this->item->project->db)->getQueryLog());
		//print_r( $value);
	}

}