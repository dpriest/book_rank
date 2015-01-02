@extends('master')
@section('header')
<a href="{{url('/')}}">返回</a>
<h2>
    {{{$rank->name}}}
</h2>
<a href="{{url('ranks/'.$rank->id.'/edit')}}">
    <span class="glyphicon glyphicon-edit"></span> 编辑
</a>
<a href="{{url('ranks/'.$rank->id.'/delete')}}">
    <span class="glyphicon glyphicon-trash"></span> 删除
</a>
最后更新: {{$rank->updated_at}}
<table class="table table-striped table-bordered" data-toggle="table" data-url="/ajax/ranks/7" data-sort-name="mark" data-sort-order="desc">
    <thead>
    <tr>
        <th data-field="name" data-sortable="true">标题</th>
        <th data-field="mark" data-sortable="true">评分</th>
        <th data-field="mark_users" data-sortable="true">评论人数</th>
        <th data-field="douban_url">豆瓣地址</th>
        <th data-field="updated_at" data-sortable="true">数据更新时间</th>
    </tr>
    </thead>
</table>
@stop