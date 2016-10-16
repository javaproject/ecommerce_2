@extends('layouts.app')

@section('content')

<div class="container">
@include('errors')
<p class="lead">Edit User</p>
<div class="row ">
<div class="col-xs-6">
		
	{!! Form::model($arr['user'], [  'method' => 'PUT',  'route' => ['user.update', $arr['user']->id]]) !!}
	{{csrf_field() }}
 
    <table class="table">
    
	  		<tr> 
	          <th>Username</th><td>{!! Form::text('username', null, ['class' => 'form-control','disabled'] ) !!}</td>     		
	        </tr>
	         <tr> 
	         <th>E-mail Address</th><td>{!! Form::text('email', null, ['class' => 'form-control','disabled']) !!}</td> 	
	        </tr>
	        <tr><th>Assign Role </th>
	        <td>
            <select class="form-control" name="role_id">       
                  @foreach($arr['roles'] as $role)
		           
		          <option value = "{{ $role->id}}" {{   ($role->id == $arr['user']->role_id) ? 'selected = "selected" ': ''}} > {{ $role->name }} 
		            </option>
		            
                 
                  @endforeach 
            </select>
            </td>
            </tr>
	<!--         
	    	@foreach($arr['roles'] as $r)
				@if($r->id != $arr['user']->getRole())
				  <tr>
				  	<th></th>
				  	<td>{!!Form::radio('rolee', $r->name) !!}{{$r->name }}</td>				  
				  </tr>
				@else
				<tr>
				  <th></th>
				  <td>{!!Form::radio('rolee', $r->name ,'true')!!}{{$r->name}}</td>
				</tr>
				@endif
			@endforeach -->
   
  </table>
  </div>
  	<div class="col-xs-6">
  			<dl class="dl-horizontal">
			  <dt>Created At </dt>
			  <dd> {{date('y-m-d',strtotime($arr['user']->created_at))}}</dd>
				<dt> Updated At</dt>
			  <dd>{{date('y-m-d',strtotime($arr['user']->updated_at))}}</dd>
				<dd></dd>
			  <dt>
			  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
			   <dd> <a href="{{ route('user.show', $arr['user']->id) }}" class="btn btn-primary" >Cancel</a></dd>
			  
			</dl>  
  	</div>  
</div>
		{!! Form::close() !!}

</div>
@endsection