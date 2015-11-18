@extends('app')

@section('content')
<p><a href="{{ url('projects/show', $item->project->id) }}">← {{ $item->project->name }}</a></p>
<h2 class="page-header">{{ $item->name }}</h2>
{!! Form::open(['method' => 'GET', 'class' => 'form-inline']) !!}
<div class="form-group">
	<label>期間</label>
	{!! Form::input('date', 'from_date', $request->get('from_date') ? $request->get('from_date') : date('Y-m-d', strtotime('-31 day')), ['class' => 'form-control']) !!}
	〜
	{!! Form::input('date', 'to_date', $request->get('to_date') ? $request->get('to_date') : date('Y-m-d', strtotime('-1 day')), ['class' => 'form-control']) !!}
	{!! Form::input('number', 'retention_loop', $request->get('retention_loop') ? $request->get('retention_loop') : '5', ['class' => 'form-control']) !!} {{ $item::$retentionSpanTypeAttr[$item->retention_span_type] }}分を表示
</div>
<button type="submit" class="btn btn-default">表示</button>

@if( $userGroups )
<h3>データ</h3>
<table class="table table-bordered">
	<tr class="active">
		<th>ユーザのグループ</th>
		<th>ユーザ登録</th>
		@for($i=1; $i<=$request->get('retention_loop'); $i++)
		<th>{{ $item::$retentionSpanTypeAttr[$item->retention_span_type] . $i }}</th>
		@endfor
	</tr>
	@foreach($userGroups as $userGroup )
	<tr>
		<td>{{ $userGroup->user_grouping_date }}</td>
		<td>{{ $userGroup->value }}</td>
		@foreach($userGroup->retentionDatas as $retentionData)
		<?php
		$percentage = $userGroup->value ? round( $retentionData->value/$userGroup->value * 100, 2 ) : false;
		if($percentage >= 20) $class = 'per_20-';
		elseif($percentage >= 15) $class = 'per_15-20';
		elseif($percentage >= 10) $class = 'per_10-15';
		elseif($percentage >= 5) $class = 'per_5-10';
		elseif($percentage >= 0.5) $class = 'per_0-5';
		else $class = 'per_0';
		?>
		<td class="{{ $class }}">
			<p>{{ $percentage ? $percentage . '%' : '-'}}</p>
			<p>{{ $retentionData->value }}</p>
		</td>
		@endforeach
	</tr>
	@endforeach
</table>
@endif

<style>
	.per_20-{background-color: #1B39A8; color: #FFFFFF;}
	.per_15-20{background-color: #3A77E6; color: #FFFFFF;}
	.per_10-15{background-color: #6B99EC;}
	.per_5-10{background-color: #9BBBF2;}
	.per_0-5{background-color: #CEDDF9;}
	.per_0{background-color: #F6F6F6;}
</style>
{!! Form::close() !!}
@endsection

