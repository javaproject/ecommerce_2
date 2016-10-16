@extends('layouts.app')
@section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
@include('errors')
@if (session('role_created'))
    <div class="alert alert-success"> 
                  {{ Session::get('role_created')  }}  </div>
     {{ Session::forget('role_created') }}
                        
   @endif
 @if (session('role_deleted'))
    <div class="alert alert-success"> 
                  {{ Session::get('role_deleted')  }}  </div>
     {{ Session::forget('role_deleted') }}
                        
   @endif
    @if (session('role_updated'))
    <div class="alert alert-success"> 
                  {{ Session::get('role_updated')  }}  </div>
     {{ Session::forget('role_updated') }}
                        
   @endif

  <script type="text/javascript">
      
     $.ajaxSetup({  
         headers: {  
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                      } 
                     });

  $(document).ready(function()
  {
     $('#datatableroles').dataTable();

    $('#getRequest').click(function()
    { 
     
        $('#reg').css('visibility', 'visible');
         
      $('#reg').show();
    });

     $('#cancel').click(function()
    { 
      $.get('cancel', function(data){
       
        $('#reg').css('visibility', 'hidden');
          });
      $('#reg').hide();
    });


    $('#submit').on('click',function()
    {
      var na=$('#name').val();
      var desc = $('#description').val();
      var token = $('input[name=_token]').val();
        if(na==''||desc=='')
        {
          $('#lab').text("REQUIRED");
         return false;
        
        }else if(na.length>50 || desc.length>50 )
        {
          $('#lab').text("Too much characters");
          return false;
        }
        else if(na.length<4 || desc.length<4 )
        {
          $('#lab').text("Too short");
          return false;
        }
        else if($.isNumeric(na) || $.isNumeric(desc))
        {
          $('#lab').text("Only characters allowed"); 
          return false;
        }
        else{  
          $('#register').submit();
      $.ajax({
          type: "POST", 
          url: "role", 
         beforeSend: function (xhr) {
            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
          data:  {name: na, description: desc},
      success: function (result) {

                    window.location.reload('/role');
             
            }
      });
      }
    });
  });

  </script>
  <h2> Roles</h2>
    <table class="table" id="datatableroles">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Description</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($roles as $role)   
	           		<tr> 
                  <td>{{$role->id}} </td>
	           			<td>{{ ucfirst($role->name) }}</td>	
	           			<td> {{ $role->description }}</td>                 
                  <td> <a href="/role/{{$role->id}}" class="btn btn-info">View</a> </td>
                  @if($role->id == 1 || $role->id == 2)                 
                    
                    {!! Form::open(['method' => 'DELETE', 'route'=>['role.destroy', $role->id]]) !!}
                   <td>{!! Form::submit('Delete', ['class' => 'btn btn-danger', 'disabled']) !!}</td>
                   {!! Form::close() !!}
                 @else
                    <td>
                   <a href="#" style="color:inherit" onclick= "return confirm('Deleting this role will set ALL its users to clients.  CONTINUE ??');"> 
                    {!! Form::open(['method' => 'DELETE', 'route'=>['role.destroy', $role->id]]) !!}
                     {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                     {!! Form::close() !!}
                    </a>
                @endif             
          </td>          
	     </tr>

	        
			 @endforeach
    </tbody>
  </table>
<div class="container">
      
      <div class="row col-lg-5">
          <button type="button" class="btn btn-primary" id="getRequest">ADD NEW ROLE</button>
      </div>
    
      <div class="row col-lg-5" id="reg" style="visibility:hidden" >
     
        <h2>Register Role</h2>
        <form id="register" action="#">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <label  for="name">Role Name: </label>
          <input class="form-control" type="text" id="name">
          <label  id ="lab" for="length"></label><br>

          <label for="description">Role description: </label>
          <input class="form-control" type="text" id="description">
          
          <input type="submit" value="Add Role" class="btn btn-primary"  id="submit">
          <button type="reset" class="btn btn-primary" id="cancel">Cancel</button>
        </form>
     
      </div>
  </div>
</div>
@endsection		