@extends('app')

@section('content')
<h2 class="page-header">プロジェクト作成</h2>
{!! Form::open() !!}
<div class="form-group">
	<label>プロジェクト名</label>
	{!! Form::input('text', 'name', null, ['required', 'class' => 'form-control']) !!}
</div>
<button type="submit" class="btn btn-default">作成</button>
{!! Form::close() !!}
@endsection
