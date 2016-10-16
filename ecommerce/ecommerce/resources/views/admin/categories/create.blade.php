
@extends('layouts.app')

@section('content')

<div class="container">
@include('errors')
          <center><h2>Create New Category</h2></center>
          <p></p>
        {{ Form::open((array('route' => 'category.store', 'method' => 'post','files' => true))) }}
            {!! Form::label('name','Category Name: ') !!}
             {!! Form::text('name',null,  array(
                                        'class'=> 'form-control'
                                        )) !!}
                                        <br>
            {!! Form::label('description','Description: ') !!}
             {!! Form::text('description',null, array(
                                        'class'=> 'form-control'
                                        )) !!}                      
                     <br>

    {!! Form::label('Cover Image', null, ['class' => 'control-form']) !!}

    
    {!!Form::file('thumbnail',['class' => 'btn btn-default btn-file', 'style'=>'']) !!}
              <br>
                     
                    {{Form::radio('act','Active',true)}}
                     {!! Form::label('label', 'Active ') !!}
                 
                    
                      {{Form::radio('act','Not active')}}

                    {!! Form::label('label', 'Not Active ') !!}

              <p></p>
              <p></p> 
               {!! Form::submit('Submit',array(
                                  'class'=> 'btn btn-primary'
                                        )) !!}  </center>
                       

         {!! Form::close() !!}



        </div>
    </div>
</div>
@endsection