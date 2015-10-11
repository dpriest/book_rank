@extends('master')
@section('header')
<a href="{{url('/')}}">返回</a>
<h2>
    {{{$rank->name}}}
</h2>
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<a href="{{url('ranks/'.$rank->id.'/createBooks')}}">
    <span class="glyphicon glyphicon-plus"></span> 添加
</a>
<a href="{{url('ranks/'.$rank->id.'/delete')}}">
    <span class="glyphicon glyphicon-trash"></span> 删除
</a>
最后更新: {{$rank->updated_at}}
<table class="table table-striped table-bordered" data-toggle="table" data-url="/ajax/rank/{{$rank->id}}" data-sort-name="mark" data-sort-order="desc">
    <thead>
    <tr>
        <th data-field="name" data-sortable="true">标题</th>
        <th data-field="mark" data-sortable="true">评分</th>
        <th data-field="mark_users" data-sortable="true">评论人数</th>
        <th data-field="name" data-formatter="urlFormatter">豆瓣地址</th>
        <th data-field="id" data-formatter="updateDataFormatter">更新数据</th>
        <th data-field="id" data-formatter="deleteDataFormatter">删除数据</th>
        <th data-field="updated_at" data-sortable="true">数据更新时间</th>
    </tr>
    </thead>
</table>
<script>
    function urlFormatter(value) {
        return '<a class="btn btn-small btn-success" target="_blank" href="http://book.douban.com/subject_search?search_text='+ value + '&cat=1001">在豆瓣中查看</a> ';
    }

    function updateDataFormatter(value) {
        return '<a class="btn btn-small btn-info" href="javascript:void(0);" data-role="updateData" data-value="' +value+ '">更新数据</a>';
    }

    function deleteDataFormatter(value) {
        return '<a class="btn btn-small btn-warning" href="javascript:void(0);" data-role="deleteData" data-value="' +value+ '">删除数据</a>';
    }

    $( document ).on( "click", '[data-role="updateData"]', function() {
        var id = $(this).attr('data-value');
        $.post( "/ajax/updatebook", { id: id } ).done(function( data ) {
            if (data ==0 ) {
                alert('调用接口过于频繁');
            } else {
                alert('更新成功');
            }
        });
    });

    $( document ).on( "click", '[data-role="deleteData"]', function() {
        var id = $(this).attr('data-value');
        var that = this;
        $.post( "/ajax/deletebook", { id: id } ).done(function( data ) {
            if (data ==0 ) {
                alert('删除失败');
            } else {
                alert('删除成功');
                that.closest('tr').remove();
            }
        });
    });
</script>
@stop