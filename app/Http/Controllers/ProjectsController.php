<?php namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UserDefinition;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Symfony\Component\Security\Core\User\User;

class ProjectsController extends Controller {

	protected $project;

	public function __construct(Project $project){
		$this->project = $project;
	}

	public function getIndex(){
		$projects = $this->project->all();
		return view('projects.index', compact('projects'));
	}

	public function getShow($id){
		$project = $this->project->find($id);
		return view('projects.show', compact('project'));
	}

	public function getCreate(){
		return view('projects.create');
	}

	public function postCreate(Request $request){
		$this->project->fill($request->all())->save();
		return redirect('projects/index');
	}

	public function getEdit($id){
		$project = $this->project->find($id);
		return view('projects.edit', compact('project'));
	}

	public function postEdit(Request $request, $id){
		$project = $this->project->find($id);
		$project->fill($request->all())->save();
		$userDefinition = new UserDefinition();
		$userDefinition->fill($request->all());
		$project->userDefinition()->save($userDefinition);
		return redirect()->to('projects/index');
	}

	public function postDelete($id){
		$project = $this->project->find($id);
		$project->delete();
		return redirect()->to('projects/index');
	}



}
