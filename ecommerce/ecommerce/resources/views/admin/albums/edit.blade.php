@extends('layouts.app')
@section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<center><h1>ALBUMS {{ $arr["album"]->id }}</h1></center>
<div class="container">
@include('errors')
<div class="row">
    <div class="col-xs-6">
                
            {!! Form::model($arr["album"], ['method' => 'PUT', 'route' => ['album.update', $arr["album"]->id],'files' => true ]) !!}
          <center><img src="/uploads/images/{{ $arr['album']->thumbnail }}" alt="Fotoja nuk gjendet" style="width:250px; height:250px">
          <br>
            {!! Form::label('Change Cover Image', null, ['class' => 'control-form']) !!}   
         {!!Form::file('thumbnail', ['class' => 'btn btn-default btn-file', 'style'=>'']) !!}
         </center>
    </div>
    <div class="col-xs-6">
           {!! Form::label('Name', null, ['class' => 'control-form']) !!} 
           {!! Form::text('name',$arr['album']->name, ['class' => 'form-control  width:20px']) !!}  
          {!! Form::label('Description', null, ['class' => 'control-form']) !!}
         {!! Form::text('description',$arr['album']->description, ['class' => 'form-control  width:20px']) !!}  
          
          {{csrf_field() }}
          
          {!! Form::label('category','Change Category: ') !!}
            <select class="form-control" name="category_id">
       
              <option value=""> SELECT AN OPTION </option>
                        @foreach($arr['categories'] as $category)
              <option value = "{{ $category->id}}" {{   ($category->id ==$arr['album']->category_id) ? 'selected = "selected" ': ''}} > {{ $category->name }} 
              </option>
                       
                  @endforeach
            </select>

             @include('admin/albums.admin')
          
          {!! Form::submit('Save',array('class'=> 'btn btn-primary')) !!}
             
            <a href="/album" class="btn btn-info" >Back</a>
          
          {!! Form::close() !!}
        </div>
 
</div>
</div>
@stop