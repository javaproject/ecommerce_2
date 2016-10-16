@extends('layouts.app')
@section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<center><h2> EDIT CATEGORY <em>{{$category->description}}</em></h2></center>
<br>
<div class="container">
@include('errors')
<div class="row">
    <div class="col-xs-6">
       {!! Form::model($category, ['method' => 'PUT', 'route' => ['category.update', $category->id] ,'files' => true ] ) !!}
      <center><img src="/uploads/images/{{ $category->thumbnail}}" alt="Fotoja nuk gjendet "   style="width:250px; height:250px">
      <br>
        {!! Form::label('Cover Image', null, ['class' => 'control-form']) !!}   
        {!!Form::file('thumbnail',['class' => 'btn btn-default btn-file', 'style'=>'']) !!}
      </center>
    </div>
    <div class="col-xs-6">
       
        {!! Form::label('Name', null, ['class' => 'control-form']) !!}
          {!! Form::text('name',$category->name, ['class' => 'form-control  width:20px']) !!}  
          {!! Form::label('Description', null, ['class' => 'control-form']) !!}
          {!! Form::text('description',$category->description, ['class' => 'form-control  width:20px']) !!}  
           
         {{csrf_field() }}        
         
          @include('admin/categories.admin')

          {!! Form::submit('Save',array('class'=> 'btn btn-primary')) !!}
          
        <a href="/category" class="btn btn-info" >Back</a>
          {!! Form::close() !!}
   
      </div>   
  
    </div>


@stop