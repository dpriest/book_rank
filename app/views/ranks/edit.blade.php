@extends('master')
@section('header')
<a href="{{url('ranks/'.$rank->id.'')}}">← 返回 </a>
<h2>
    @if($method == 'post')
    新建一个排序
    @elseif($method == 'delete')
    Delete {{$rank->name}}?
    @else
    编辑 {{$rank->name}}
    @endif
</h2>
@stop
@section('content')
{{Form::model($rank, array('method' => $method, 'url'=>
'ranks/'.$rank->id))}}
@unless($method == 'delete')
<div class="form-group">
    {{Form::label('名称')}}：
    {{Form::text('name')}}
</div>
<div class="form-group">
    <div>{{Form::label('书名列表')}}：</div>
    {{Form::textarea('content')}}
</div>
{{Form::submit("提交", array("class"=>"btn btn-default"))}}
@else
{{Form::submit("删除", array("class"=>"btn btn-default"))}}
@endif
{{Form::close()}}
@stop