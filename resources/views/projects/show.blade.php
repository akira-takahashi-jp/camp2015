@extends('app')

@section('content')
<h2 class="page-header">プロジェクト</h2>
<ul class="list-inline">
	<li>
		<a href="{{ url('projects/edit', $project->id) }}" class="btn btn-primary pull-left">編集</a>
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
		<th>DB</th>
		<td>{{{ $project->db }}}</td>
	</tr>
	<tr>
		<th>ユーザDBのテーブル名</th>
		<td>{{{ $project->userDefinition ? $project->userDefinition->table_name : null }}}</td>
	</tr>
	<tr>
		<th>ユーザIDのカラム名</th>
		<td>{{{ $project->userDefinition ? $project->userDefinition->user_id_column : null }}}</td>
	</tr>
	<tr>
		<th>日付のカラム名</th>
		<td>{{{ $project->userDefinition ? $project->userDefinition->date_column : null }}}</td>
	</tr>
	</tbody>
</table>
<h3>項目一覧</h3>

<ul class="list-inline">
	<li>
		<a href="{{ url('items/create', $project->id) }}" class="btn btn-primary pull-left">項目作成</a>
	</li>
</ul><table class="table table-striped table-hover">
	<thead>
	<tr>
		<th>項目名</th>
		<th>作成日時</th>
		<th>操作</th>
	</tr>
	</thead>
	<tbody>
	@foreach($project->items as $item)
	<tr>
		<td><a href="{{ url('items/report', $item->id) }}">{{{ $item->name }}}</a></td>
		<td>{{{ $item->created_at }}}</td>
		<td>
			<a href="{{ url('items/edit', $item->id) }}">編集</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>@endsection
