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

	public function getCreate(){
		return view('items.create');
	}

	public function postCreate(Request $request, $projectId){
		$this->item->fill($request->all());
		$this->item->project_id = $projectId;
		$this->item->save();
		return redirect("projects/show/{$projectId}");
	}

	public function getEdit($id){
		$item = $this->item->find($id);
		return view('items.edit', compact('item'));
	}

	public function postEdit(Request $request, $id){
		$item = $this->item->find($id);
		$item->fill($request->all())->save();
		return redirect("projects/show/{$item->project_id}");
	}


}
