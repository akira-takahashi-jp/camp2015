@extends('app')

@section('content')
<h2 class="page-header">プロジェクト編集</h2>
{!! Form::open(['action' => ['ProjectsController@postEdit', $project->id]]) !!}
<div class="form-group">
	<label>プロジェクト名</label>
	{!! Form::input('text', 'name', $project->name, ['required', 'class' => 'form-control']) !!}
</div>
<button type="submit" class="btn btn-default">編集</button>
{!! Form::close() !!}
@endsection
