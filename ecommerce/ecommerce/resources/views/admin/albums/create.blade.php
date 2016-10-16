@extends('layouts.app')
@section('content')
<div class="container">
@include('errors')
  <center><h3>CREATE ALBUM</h1></h3></center>

<div class="col-md-8 col-md-offset-2">
        
          <p></p>
        {{ Form::open((array('route' => 'album.store', 'method' => 'post','files' => true))) }}
            {!! Form::label('name','Album Name: ') !!}
             {!! Form::text('name',null,  array(
                                        'class'=> 'form-control'
                                        )) !!}
            {!! Form::label('description','Description: ') !!}
             {!! Form::text('description',null, array(
                                        'class'=> 'form-control'
                                        )) !!}                                      
               {!! Form::label('Cover Image','Cover Image') !!}
    
    {!!Form::file('thumbnail',['class' => 'btn btn-default btn-file control-form', 'style'=>'']) !!}
              <br>
                     
                    {{Form::radio('act','Active',true)}}
                     {!! Form::label('label', 'Active ') !!}
                                     
                      {{Form::radio('act','Not active')}}

                    {!! Form::label('label', 'Not Active ') !!}

                    <br>
            {!! Form::label('category','Assign Category: ') !!}
            <select class="form-control" name="category_id">
             <option value=""> SELECT AN OPTION </option>
                @foreach($categories as $category)
                  <option value = '{{ $category->id}}'> {{ $category->name }}</option>
                @endforeach
            </select>
              <p></p>
              <p></p> 
          {!! Form::submit('Submit',array(
                                  'class'=> 'btn btn-primary'
                                        )) !!}  

         {!! Form::close() !!}



        </div>
    </div>
    </div>
</div>
@endsection