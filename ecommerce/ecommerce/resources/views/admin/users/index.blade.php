@extends('layouts.app')
@section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
@include('errors')
  @if (session('user_created'))
    <div class="alert alert-success"> 
                  {{ Session::get('user_created')  }}  </div>
     {{ Session::forget('user_created') }}
                        
   @endif
 @if (session('user_deleted'))
    <div class="alert alert-success"> 
                  {{ Session::get('user_deleted')  }}  </div>
     {{ Session::forget('user_deleted') }}
                        
   @endif
    @if (session('user_updated'))
    <div class="alert alert-success"> 
                  {{ Session::get('user_updated')  }}  </div>
     {{ Session::forget('user_updated') }}
                        
   @endif

 <script type="text/javascript">
    
    $('document').ready(function()
    {
      $('#datatableusers').dataTable();
    });
</script>
  <h2> All Registered Users</h2>
    <table class="table" id="datatableusers">
    <thead>
      <tr>
        <th>#</th>
        <th>Username</th>
        <th>Role</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)   
	           		<tr> 
                  <td>{{$user->id}} </td>
                  <!-- @if($user->trashed())               
                  @endif --> 
	           			<td>{{ ucfirst($user->username) }}</td>	
	           			<td> {{  $user->role->name }}</td>

                  <td> <a href="/user/{{$user->id}}" class="btn btn-info">View</a> </td>
                  @if(Auth::user()==$user)
                   {!! Form::open(['method' => 'DELETE', 'route'=>['user.destroy', $user->id]]) !!} 
                  <td>                   
                   {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'disabled']) !!}
                   {!! Form::close() !!}
                   </a>
                </td>         
                  @else
                  <td>
                   <a href="#" style="color:inherit" onclick= "return confirm('Deleting this user will delete ALL its IMAGES .  CONTINUE ??');"> 
                      
              {!! Form::open(['method' => 'DELETE', 'route'=>['user.destroy', $user->id]]) !!}
             {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
             {!! Form::close() !!}
             </a>
          </td> 
             
          @endif  
	         </tr>
	        
			 @endforeach
    </tbody>
  </table>

  <a href="/user/create" class="btn btn-info" >ADD NEW USER</a>
</div>
@endsection		