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
	<label>ユーザIDのカラム名</label>
	{!! Form::input('text', 'user_id_column', $project->userDefinition ? $project->userDefinition->user_id_column: null, ['required', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
	<label>登録日付のカラム名</label>
	{!! Form::input('text', 'date_column', $project->userDefinition ? $project->userDefinition->date_column: null, ['required', 'class' => 'form-control']) !!}
</div>
<button type="submit" class="btn btn-default">編集</button>
{!! Form::close() !!}
@endsection
