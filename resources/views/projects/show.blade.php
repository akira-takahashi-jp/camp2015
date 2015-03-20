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
<h3>項目一覧</h3>

<ul class="list-inline">
	<li>
		<a href="/items/create/{{{ $project->id }}}" class="btn btn-primary pull-left">項目作成</a>
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
		<td><a href="/items/show/{{{ $item->id }}}">{{{ $item->name }}}</a></td>
		<td>{{{ $item->created_at }}}</td>
		<td>
			<a href="/items/edit/{{{ $item->id }}}">編集</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>@endsection
