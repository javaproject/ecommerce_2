@extends('layouts.app')
@section('content')

 <meta name="csrf-token" content="{{ csrf_token() }}" />
<center><div class="container">
@include('errors')
<div class="row">
        <div class="col-xs-6">
        <h2>IMAGE   {{ $arr["image"]->id }}</h2>
      <img src="/uploads/images/{{ $arr['image']->path}}" alt="Fotoja nuk gjendet " class="img-thumbnail" style="width:250px; height:250px"</h2>
      </div>
       <div class="col-xs-6">
       <br><br><br>
        {!! Form::model($arr["image"], ['method' => 'PUT', 'route' => ['image.update', $arr["image"]->id ],
         'class' => 'form-group col-lg-6' ]) !!}  
          {!! Form::label('Title', null, ['class' => 'control-form']) !!}
          {!! Form::text('name',$arr['image']->name, ['class' => 'form-control  width:20px']) !!}  
          <br><br>
              <div class="body">
          {{csrf_field() }}
          @include('admin/images.admin')

          {!! Form::submit('Submit',array('class'=> 'btn btn-primary')) !!}
        
          {!! Form::close() !!}
   </div>
    </div>   

  </div>
</div>
</center>
@stop