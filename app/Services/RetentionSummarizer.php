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

class RetentionSummarizer {

	private $item;

	public function __construct(Item $item){
		$this->item = $item;
	}

	public function getUserGroups($from, $to, $loopCount){

		$cursorDate = null;
		if($this->item->user_grouping_span_type === 0){
			$cursorDate = $from;
		}

		while(true){
			//日
			if($this->item->user_grouping_span_type === 0){
				if($cursorDate > $to) break;
				else $cursorDate =  date("Y-m-d", strtotime("{$cursorDate} +1 day"));
			}

			$this->sumUserGroup($cursorDate);
			echo $cursorDate;
		}

	}

	public function sumUserGroup($date){

	}

}