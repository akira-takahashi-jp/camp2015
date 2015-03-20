@extends('app')

@section('content')
<h2 class="page-header">プロジェクト一覧</h2>
<ul class="list-inline">
	<li>
		<a href="/projects/create" class="btn btn-primary pull-left">作成</a>
	</li>
</ul>
<table class="table table-striped table-hover">
	<thead>
	<tr>
		<th>ID</th>
		<th>プロジェクト名</th>
		<th>作成日時</th>
		<th>操作</th>
	</tr>
	</thead>
	<tbody>
	@foreach($projects as $project)
	<tr>
		<td>{{{ $project->id }}}</td>
		<td><a href="/projects/show/{{{ $project->id }}}">{{{ $project->name }}}</a></td>
		<td>{{{ $project->created_at }}}</td>
		<td>
			<a href="/projects/edit/{{{ $project->id }}}">編集</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@endsection
