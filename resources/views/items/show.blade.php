@extends('app')

@section('content')
<h2 class="page-header">{{{ $item->name }}} | {{{ $item->project->name }}}</h2>
<ul class="list-inline">
	<li>
		<a href="/items/edit/{{{ $item->id }}}" class="btn btn-primary pull-left">編集</a>
	</li>
	<li>
		{!! Form::open(['action' => ['ItemsController@postDelete', $item->id]]) !!}
		<button type="submit" class="btn btn-danger pull-left">削除</button>
		{!! Form::close() !!}
	</li>
</ul>
<table class="table table-striped">
	<tbody>
	<tr>
		<th>テーブル名</th>
		<td>{{{ $item->table_name }}}</td>
	</tr>
	<tr>
		<th>ユーザIDカラム名</th>
		<td>{{{ $item->user_id_column_name}}}</td>
	</tr>
	<tr>
		<th>その他条件</th>
		<td>{{{ $item->other_criteria}}}</td>
	</tr>
	<tr>
		<th>日付カラム名</th>
		<td>{{{ $item->date_column}}}</td>
	</tr>
	<tr>
		<th>リテンション期間</th>
		<td>{{{ $item::$retentionSpanTypeAttr[$item->retention_span_type]}}}</td>
	</tr>
	<tr>
		<th>ユーザグルーピング期間</th>
		<td>{{{ $item::$userGroupingSpanTypeAttr[$item->user_grouping_span_type]}}}</td>
	</tr>
	</tbody>
</table>
@endsection
