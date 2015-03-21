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
				else $cursorDate = $this->getNextDate($cursorDate);
			}

//			echo $cursorDate;

			$this->sumUserGroup($cursorDate);
		}

	}

	private function getNextDate($date)
	{
		return date("Y-m-d", strtotime("{$date} {$this->item->getUserGroupingSpanOffset()}"));
	}

	public function sumUserGroup($date)
	{
		$value = DB::connection($this->item->project->db)
			->table($this->item->project->userDefinition->table_name)
			->where($this->item->project->userDefinition->date_column, '>=', $date)
			->where($this->item->project->userDefinition->date_column, '<', $this->getNextDate($date))
			->count();

		$userGroup = new UserGroup();
		$userGroup->user_grouping_date = $date;
		$userGroup->value = $value;
		$this->item->userGroups()->save($userGroup);

	}

}