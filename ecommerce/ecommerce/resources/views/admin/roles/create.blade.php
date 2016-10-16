<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">     
@include('errors')
                      @if (session('status'))
                               <div class="alert alert-success"> {{ session('status') }}</div>
                        
                      @endif
          <center><h2>Create New Role</h2></center>
          <p></p>
        {{ Form::open((array('url' => 'role/store', 'method' => 'get'))) }}
            {!! Form::label('name','Role Name: ') !!}
             {!! Form::text('name',null,  array(
                                        'class'=> 'form-control'
                                        )) !!}
            {!! Form::label('description','Role Description: ') !!}
             {!! Form::text('description',null, array(
                                        'class'=> 'form-control'
                                        )) !!}                                         
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
