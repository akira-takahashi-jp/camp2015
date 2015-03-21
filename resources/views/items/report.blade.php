@extends('app')

@section('content')
<h2 class="page-header">{{ $item->name }}</h2>
{!! Form::open(['method' => 'GET']) !!}
<div class="form-group">
	<label>期間</label>
	{!! Form::input('date', 'from_date', $request ? $request->get('from_date') : null, ['class' => 'form-control']) !!}
	〜
	{!! Form::input('date', 'to_date', $request ? $request->get('to_date') : null, ['class' => 'form-control']) !!}
	<label>リテンション数</label>
	{!! Form::input('number', 'retention_loop', $request ? $request->get('retention_loop') : null, ['class' => 'form-control']) !!}
</div>
<button type="submit" class="btn btn-default">更新</button>
{!! Form::close() !!}
@endsection
