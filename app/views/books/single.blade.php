@extends('master')
@section('header')
<a href="{{url('/')}}">Back to overview</a>
<h2>
    {{{$book->name}}}
</h2>
<a href="{{url('books/'.$book->id.'/edit')}}">
    <span class="glyphicon glyphicon-edit"></span> Edit
</a>
<a href="{{url('books/'.$book->id.'/delete')}}">
    <span class="glyphicon glyphicon-trash"></span> Delete
</a>
Last edited: {{$book->updated_at}}
@stop
@section('content')
<p>Date of Birth: {{$book->date_of_birth}} </p>
<p>
    @if($book->breed)
    Breed:
    {{link_to('books/breeds/' . $book->breed->name,
    $book->breed->name)}}
    @endif
</p>
@stop