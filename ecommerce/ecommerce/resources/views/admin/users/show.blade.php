@extends('layouts.app')

@section('content')

<div class="container">

<p class="lead">This is the user</p>
<div class="row ">
<div class="col-xs-6">
    <table class="table">
    <tbody>
	         <tr>
	  		<tr> 
	           <th>Username</th><td>{{$user->username}} </td>      			
	         </tr>
	         <tr> 
	           	<th>E-mail Address</th><td>{{$user->email}} </td>
	         </tr>
	         	<tr> 
	           	<th>User Role</th><td>{{$user->role->name}} </td>
	         </tr>      
    </tbody>
  </table>
  </div>
  	<div class="col-xs-6">
  		
  		<dl class="dl-horizontal">
			  <dt>Created At </dt>
			  <dd> {{date('y-m-d h:i:sa',strtotime($user->created_at))}}</dd>
				<dt> Updated At</dt>
			  <dd>{{date('y-m-d h:i:sa',strtotime($user->updated_at))}}</dd>
				<br>
			
			  <dt>
			  @if(!($user->isAdmin() && Auth::user()==$user))

			  <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info" >Update</a></dt>
			  @endif


			 <dd> <a href="{{ route('user.index') }}" class="btn btn-info" >Back</a></dd>
			</dl>  
  	</div>
			  
</div>

</div>
@endsection