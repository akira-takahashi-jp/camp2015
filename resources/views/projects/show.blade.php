@extends('app')

@section('content')
<h2 class="page-header">プロジェクト</h2>
<ul class="list-inline">
	<li>
		<a href="/projects/edit/{{{ $project->id }}}" class="btn btn-primary pull-left">編集</a>
	</li>
	<li>
		{!! Form::open(['action' => ['ProjectsController@postDelete', $project->id]]) !!}
		<button type="submit" class="btn btn-danger pull-left">削除</button>
		{!! Form::close() !!}
	</li>
</ul>
<table class="table table-striped">
	<tbody>
	<tr>
		<th>ID</th>
		<td>{{{ $project->id }}}</td>
	</tr>
	<tr>
		<th>プロジェクト名</th>
		<td>{{{ $project->name }}}</td>
	</tr>
	<tr>
		<th>ユーザDBのテーブル名</th>
		<td>{{{ $project->userDefinition ? $project->userDefinition->table_name : null }}}</td>
	</tr>
	<tr>
		<th>ユーザDBのカラム名</th>
		<td>{{{ $project->userDefinition ? $project->userDefinition->column_name : null }}}</td>
	</tr>
	<tr>
		<th>更新日時</th>
		<td>{{{ $project->updated_at }}}</td>
	</tr>
	</tbody>
</table>
@endsection
