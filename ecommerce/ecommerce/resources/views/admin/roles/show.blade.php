@extends('layouts.app')
@section('content')

<div class="container">
@include('errors')
<p class="lead">This is the role</p>
<div class="row ">
<div class="col-xs-6">
    <table class="table">
    <tbody>
	         <tr>
	  		<tr> 
	           <th>Name</th><td>{{$role->name}} </td>      			
	         </tr>
	         <tr> 
	           	<th>Description</th><td>{{$role->description}} </td>
	         </tr>
	         	<tr> 
	           	<th>Assigned to</th><td>{{ $role->users->count() }} user(s)</td>
	         </tr>      
    </tbody>
  </table>
  </div>
  	<div class="col-xs-6">
  		
  		<dl class="dl-horizontal">
			  <dt>Created At </dt>
			  <dd> {{date('y-m-d h:i:sa',strtotime($role->created_at))}}</dd>
				<dt> Updated At</dt>
			  <dd>{{date('y-m-d h:i:sa',strtotime($role->updated_at))}}</dd>
				<br>
			
			  <dt>
			  @if(!($role->id==1 || $role->id==2))
			  <a href="{{ route('role.edit', $role->id) }}" class="btn btn-info" >Update</a></dt>
			  @endif

			 <dd> <a href="{{ route('role.index') }}" class="btn btn-info" >Back</a></dd>
			</dl>  
  	</div>
			  
</div>

</div>
@endsection