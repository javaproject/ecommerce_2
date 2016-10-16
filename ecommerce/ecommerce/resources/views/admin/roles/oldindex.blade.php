@extends('layouts.app')
@section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
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
      $.get('getRequest', function(data){
        
        $('#reg').css('visibility', 'visible');
          });
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
          data:  {name: na, description: desc},//, '_token': token},
      success: function (result) {

          //setInterval(function() {
                    window.location.reload('/role');
                //}, 1000);
    }
      });
      /*
      $('#name').val() = '' ;
      $('#description').val() = '';
*/
      }
    });
  });

  </script>
  <h4>ROLES</h4>
    <table class="table" id="datatableroles">
    <thead>
      <tr>
        <th>Role</th>
        <th>Assigned to </th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($roles as $k)   
	           		<tr>          			
                  <div class="col-xs-2" >
                  {!! Form::model($k, ['method' => 'PUT', 'route' => ['role.update', $k->id] ] ) !!}

                @if($k->name=='admin' || $k->name =='client') 
                  <td> {!!Form::text('name', $k->name,['class' => 'form-control', 'disabled']) !!}
                  </td>
                @else
                  <td>  {!!Form::text('name', $k->name,['class' => 'form-control']) !!}</td>
               @endif
              
                  <td>{{ $k->users->count() }} users(s)</td>
	           			<td> {!!Form::text('description', $k->description,['class' => 'form-control']) !!}</td>

                  <td> {!! Form::submit('Update', ['class' => 'btn btn-default']) !!} </td>
                  {!! Form::close() !!}
                  
                  @if($k->name=='admin' || $k->name =='client') 
                  <td>  {!! Form::open(['method' => 'DELETE', 'route'=>['role.destroy', $k->id]]) !!}

                 {!! Form::submit('Delete', ['class' => 'btn btn-danger','disabled' => 'disabled']) !!}
                 {!! Form::close() !!}</td>
                 @else
                  <td>  {!! Form::open(['method' => 'DELETE', 'route'=>['role.destroy', $k->id]]) !!}

                 {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                 {!! Form::close() !!}</td>
                 @endif
                 </div>
	           		 </tr>
	        
			 @endforeach
    </tbody>
  </table>
   
</div>

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
 
@stop