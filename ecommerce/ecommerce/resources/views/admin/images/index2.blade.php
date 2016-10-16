@extends('layouts.app')
@section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<center><h1>CATEGORIES</h1></center>
<div class="container">
@include('admin/users.messaged-success')
<table>
@foreach( $images as $image )
    <tr>
       
        <td>{{ $image->name }}</td></tr>
          <tr><td><a href="" id = "{{ $image->id }}" class="links-dark edits pull-left">
                <i class="fa fa-edit fa-lg"></i>
            </a></td>
            <div id="deleteTheimage">
                {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteimage', 'action' => ['ImageController@destroy', $image->id]]) !!}

               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <td>  {!! Form::button( '<i class="fa fa-trash fa-lg"></i>', ['type' => 'submit', 'class' => ' deleteimage','id' => 'btnDeleteimage', 'data-id' => $image->id ] ) !!}
               {!! Form::close() !!}
               </td>
           </div>
   </tr>
@endforeach

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript">
      
     $.ajaxSetup({  
         headers: {  
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                      } 
                     });

  $(document).ready(function()
  {

$('.deleteimage').on('click', function(e) {
    var inputData = $('#formDeleteimage').serialize();

    var dataId = $(this).attr('data-id');
    var token = $('input[name=_token]').val();
    alert(dataId);
    $.ajax({
        url: 'image' + '/' + dataId,
        type: 'POST',
        beforeSend: function (xhr) {
            if (token) {
               //alert('okkkkkkkk');
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
          },
         data: inputData + {'_token': token}
         /*,
         success: function (result) {
         window.location.replace('/prova');  
    }*/
    });

    //return false;
});
});
</script>


@stop