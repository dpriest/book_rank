@extends('master')
@section('header')
@if(isset($breed))
{{link_to('/', 'Back to the overview')}}
@endif
<h2>
    所有图书排序
    <a href="{{url('ranks/create')}}" class="btn btn-primary pull-right">
        添加排序
    </a>
</h2>
@stop
@section('content')
@foreach($ranks as $rank)
<div class="rank">
    <a href="{{url('ranks/'.$rank->id)}}">
        <strong> {{{$rank->name}}} </strong>
    </a>
</div>
@endforeach
@stop