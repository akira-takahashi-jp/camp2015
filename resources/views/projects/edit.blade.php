@extends('app')

@section('content')
<h2 class="page-header">プロジェクト編集</h2>
{!! Form::open(['action' => ['ProjectsController@postEdit', $project->id]]) !!}
<div class="form-group">
	<label>プロジェクト名</label>
	{!! Form::input('text', 'name', $project->name, ['required', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
	<label>ユーザDBのテーブル名</label>
	{!! Form::input('text', 'table_name', $project->userDefinition ? $project->userDefinition->table_name : null, ['required', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
	<label>ユーザDBのカラム名</label>
	{!! Form::input('text', 'column_name', $project->userDefinition ? $project->userDefinition->column_name : null, ['required', 'class' => 'form-control']) !!}
</div>
<button type="submit" class="btn btn-default">編集</button>
{!! Form::close() !!}
@endsection
