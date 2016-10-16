@extends('layouts.app')
@section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
@include('errors')
<center><h1>UPLOAD IMAGE</h1></center>
          
	<div class="col-sm-8">
	<div class="form-group">
        
        {!! Form::open((array('route' => 'image.store', 'files' => true, 'method' => 'post','class'=>'form-horizontal'))) !!}
	 	
		{!! Form::label('Image Title', null, ['class' => 'control-form']) !!}

	    {!! Form::text('name', null, ['class' => 'form-control']) !!}

		{!! Form::label('Upload File', null, ['class' => 'control-form']) !!}

		
		{!!Form::file('path',['class' => 'btn btn-default btn-file', 'style'=>'']) !!}

		{{ csrf_field() }}

		{!! Form::submit('Submit',array(
                                  'class'=> 'btn btn-primary'
                                        )) !!}

		{!! Form::close() !!}
	</div>
	</div>
</div>
@stop