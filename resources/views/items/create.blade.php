@extends('app')

@section('content')
<p><a href="{{ url('projects/show', $project->id) }}">← {{ $project->name }}</a></p>
<h2 class="page-header">項目作成</h2>
{!! Form::open() !!}
<div class="form-group">
	<label>項目名</label>
	{!! Form::input('text', 'name', null, ['required', 'class' => 'form-control']) !!}
	<label>テーブル名</label>
	{!! Form::input('text', 'table_name', null, ['required', 'class' => 'form-control']) !!}
	<label>ユーザIDカラム名</label>
	{!! Form::input('text', 'user_id_column', null, ['required', 'class' => 'form-control']) !!}
	<label>その他条件</label>
	{!! Form::input('text', 'other_criteria', null, ['class' => 'form-control']) !!}
	<label>日付カラム名</label>
	{!! Form::input('text', 'date_column', null, ['required', 'class' => 'form-control']) !!}
	<label>リテンション期間</label>
	{!! Form::select('retention_span_type', $item::$retentionSpanTypeAttr, null, ['required', 'class' => 'form-control']) !!}
	<label>ユーザグルーピング期間</label>
	{!! Form::select('user_grouping_span_type', $item::$userGroupingSpanTypeAttr, null, ['required', 'class' => 'form-control']) !!}
</div>
<button type="submit" class="btn btn-default">作成</button>
{!! Form::close() !!}
@endsection
