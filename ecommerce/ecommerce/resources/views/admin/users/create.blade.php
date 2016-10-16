
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">     
@include('errors')
              
          <center><h2>Create New User</h2></center>
          <p></p>
          
       {{ Form::open((array('url' => 'user/store', 'method' => 'post'))) }}
        {{ csrf_field() }}
            {!! Form::label('username','Username: ') !!}
             {!! Form::text('username',null,  array(
                                        'class'=> 'form-control'
                                        )) !!}
            {!! Form::label('email','Email Address: ') !!}
             {!! Form::text('email',null, array(
                                        'class'=> 'form-control'
                                        )) !!}                      
                     
              {!! Form::label('password','Password: ') !!}
             {!! Form::password('password',  array(
                                        'class'=> 'form-control'
                                        )) !!}
                                   
                 
              {!! Form::label('password_confirmation','Confirm Password: ') !!}
               
             {!! Form::password('password_confirmation',  array(
                                        'class'=> 'form-control'
                                        )) !!}  
                        
              <p></p>
              <p></p>
          {!! Form::label('role','Assign Role: ') !!}
            <select class="form-control" name="role_id">
       
                  @foreach($roles as $role)
            <option value = "{{ $role->id}}" {{   ($role->id ==2) ? 'selected = "selected" ': ''}} > {{ $role->name }} 
            </option>
                 
                  @endforeach 
            </select>
              <p></p>
              <p></p>

                                    <center>
               {!! Form::submit('Submit',array(
                                  'class'=> 'btn btn-primary'
                                        )) !!}  </center>
                       

         {!! Form::close() !!}



        </div>
    </div>
</div>
@endsection
