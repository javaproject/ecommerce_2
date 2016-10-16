@extends('layouts.app')

@section('content')

<div class="container">
@include('errors')
<p class="lead">Edit User</p>
<div class="row ">
<div class="col-xs-6">
		
	{!! Form::model($role, [  'method' => 'PUT',  'route' => ['role.update', $role->id]]) !!}
		{{csrf_field() }}
 
    <table class="table">
    
	  		<tr> 
	          <th>Name</th><td>{!! Form::text('name', null, ['class' => 'form-control'] ) !!}</td>     		
	        </tr>
	         <tr> 
	         <th>Description</th><td>{!! Form::text('description', null, ['class' => 'form-control']) !!}</td> 	
	        </tr>
			  
   
  </table>
  </div>
  	<div class="col-xs-6">
  			<dl class="dl-horizontal">
			  <dt>Created At </dt>
			  <dd> {{date('y-m-d',strtotime($role->created_at))}}</dd>
				<dt> Updated At</dt>
			  <dd>{{date('y-m-d',strtotime($role->updated_at))}}</dd>
				<dd></dd>
			  <dt>

	 		<dd>
	 		<dt><a href="{{ route('role.show', $role->id) }}" class="btn btn-primary" >Cancel</a></dt>

	 		<dt></dt>
	 		{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		 	</dd> 
			</dl>  
			
  {!! Form::close() !!}
  	</div>  
</div>
		
</div>
@endsection