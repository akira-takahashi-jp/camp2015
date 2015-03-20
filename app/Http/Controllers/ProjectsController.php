<?php namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProjectsController extends Controller {

	protected $project;

	public function __construct(Project $project){
		$this->project = $project;
	}

	public function getIndex(){
		$projects = $this->project->all();
		return view('projects.index')->with(compact('projects'));
	}

	public function getShow($id){
		$project = $this->project->find($id);
		return view('projects.show', compact('project'));
	}

	public function getCreate(){
		return view('projects.create');
	}

	public function postCreate(Request $request){
		$data = $request->all();
		$this->project->fill($data);
		$this->project->save();

		return redirect()->to('projects/index');
	}

	public function getEdit($id){
		$project = $this->project->find($id);
		return view('projects.edit')->withproject($project);
	}

	public function postEdit(Request $request, $id){
		$project = $this->project->find($id);
		$data = $request->all();
		$project->fill($data);
		$project->save();
		return redirect()->to('projects/index');
	}

	public function postDelete($id){
		$project = $this->project->find($id);
		$project->delete();
		return redirect()->to('projects/index');
	}



}
