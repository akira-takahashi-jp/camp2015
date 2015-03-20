<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Item;

use Illuminate\Http\Request;

class ItemsController extends Controller {

	protected $item;

	public function __construct(Item $item){
		$this->item = $item;
	}

	public function getCreate($projectId){
		return view('items.create')->with(compact('projectId'));
	}

	public function postCreate(Request $request, $projectId){
		$data = $request->all();
		$this->item->fill($data);
		$this->item->project_id = $projectId;
		$this->item->save();
		return redirect()->to('projects/index');
	}

}
