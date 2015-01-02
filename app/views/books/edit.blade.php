@extends('master')
@section('header')
<a href="{{url('books/'.$book->id.'')}}">← Cancel </a>
<h2>
    @if($method == 'post')
    Add a new book
    @elseif($method == 'delete')
    Delete {{$book->name}}?
    @else
    Edit {{$book->name}}
    @endif
</h2>
@stop
@section('content')
{{Form::model($book, array('method' => $method, 'url'=>
'books/'.$book->id))}}
@unless($method == 'delete')
<div class="form-group">
    {{Form::label('Name')}}
    {{Form::text('name')}}
</div>
<div class="form-group">
    {{Form::label('评分')}}
    {{Form::text('mark')}}
</div>
<div class="form-group">
    {{Form::label('人数')}}
    {{Form::text('mark_users')}}
</div>
<div class="form-group">
    {{Form::label('Rank')}}
    {{Form::select('rank_id', $rank_options)}}
</div>
{{Form::submit("Save", array("class"=>"btn btn-default"))}}
@else
{{Form::submit("Delete", array("class"=>"btn btn-default"))}}
@endif
{{Form::close()}}
@stop