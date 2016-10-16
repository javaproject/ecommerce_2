@extends('layouts.app')
@section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
@include('errors')
@if (session('album_removed'))
    <div class="alert alert-success"> 
                  {{ Session::get('album_removed')  }}  </div>
     {{ Session::forget('album_removed') }}
                        
   @endif
@foreach(array_chunk($albums->all(),3) as $r)
	<div class="row">
			@foreach($r as $album)
				<article class="col-md-4">
					<h3>{{$album->name}} </h3>
					<a href="/album/{{$album->id}}"><img alt="{{$album->name}}" src="/uploads/images/{{ $album->thumbnail}}" class="img-thumbnail" style="width:250px; height:250px"></a>
					<h4>{{$album->description}} </h4>			

			 @if(Auth::user()->isAdmin())
             <a href="" style="color:inherit" class="links-dark edits pull-left" >
            {{ Form::open(['url'=>['remove',$album->id ], 'method' => 'put', 'class'=>'col-md-12']) }}
            
             {!! Form::button('<i class="fa fa-remove fa-lg links-dark" style="font-size:30px;"></i>', ['class' => 'col-md-12','type' => 'submit', 'style'=>'']) !!}
			{{ Form::close() }}
           	</a>	
           	@endif
           	 <br>

            <div id = "divform">
              <button value="{{ $album->id }}" class="btn btn-primary btn-xm upload"><i class="fa fa-file-photo-o"></i> Upload Image</button>
                <center>
                <div class="modal fade" id="modal" ">
                  <div class="modal-content" style=" position:absolute;top:10% !important;margin:auto 20%;width:60%;height:70%;">
                   <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Image Upload</h4>
                    </div>
                        <form class="form" action="#" enctype="multipart/form-data">

                         <input type="hidden" name="_token" value="{{ csrf_token() }}">                                              

                            <div class="form-group">

                                <label for="name" id="lab">Name</label>
                                <input type="text" style="width:300px;" class="form-control name" name="name">

                                <label for="price" id="price">Price</label>
                                <input type="number" style="width:300px;" class="form-control price" name="price">

                                <label for="quantity" id="quantity">Quantity</label>
                                <input type="number" style="width:300px;" class="form-control quantity" name="quantity">

                                <label for="path">Image</label>
                                <input type="file" name="path" class="btn btn-default btn-file path" id="path" />

                           </div>
                          <button type="button" value="{{ $album->id }}" name="album" id="submit" class="btn btn-danger btn-xm submit">Submit</button>
                         
                          </form>
                      </div>
                    </center>
                    </div>
               </article>  
           					
			@endforeach
	</div>
@endforeach
{{ $albums->links() }}
</div>

  <script type="text/javascript"> 
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});   

  $(document).ready(function()
  {
           
  $('.upload').on('click', function() {
    var nr_al = document.getElementsByClassName("form").length;
    var imgAlbum = $(this).val();
    /*alert(imgAlbum);
    return false;*/
    var token = $('input[name=_token]').val();
    var al = 0;
    $('#modal').modal({show:true});

      $('.submit').on('click', function() {  
              var imgName = '';
              var imgPrice = '';
              var imgQuantity = '';
              var imgPath ='';
                $("#divform .name").each(function() {   
                                
                     if($(this).val()!= ''){
                      imgName = $(this).val();
                      return false;

                    }                   
               });
          $("#divform .price").each(function() {

              if($(this).val()!= ''){
                  imgPrice = $(this).val();
                  return false;

              }
          });
          $("#divform .quantity").each(function() {

              if($(this).val()!=''){
                  imgQuantity = $(this).val();
                  return false;

              }
          });

                $("#divform .path").each(function() {
                        if($(this).val()!= ''){
                        imgPath =  $(this).val();
                        }
                    });
          if(imgName=='' ||  imgQuantity == ''|| imgPrice == ''  || imgPath=='')
          {
                    alert("All fields are required !!");
                    return false;
          }
          else if(imgPrice <0 || imgQuantity < 0  || imgPrice.match('/^\d+(?:\.\d\d?)?$/'))
          {
              alert("Price or quantity have invalid format !!");
              return false;
          }
          else
                {

                  var ext = imgPath.split('.').pop().toLowerCase();
                      if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                          alert('invalid Image Type!');
                        }
                        else{

                         var dis = new FormData($(".form")[0]);
                         dis.append('album_id', imgAlbum);
                      $.ajax({
                                  url:'/image',         
                                  data:dis, 
                                  async:true,
                                  type:'post',
                                  processData: false,
                                  contentType: false,
                                  success:function(response){
                                    console.log(response);
                                    window.location.reload();
                                     alert("Image has been sucssessfully uploaded !");

                                  },
                                  error:function(response){
                                    console.log(response);
                                    window.location.reload();
                                     alert("Image couldn't get uploaded");

                                  },
                              });
                       
                       $('#modal').modal('hide');
                              
                    }
                }
    });

  });
});
   
  </script>




@stop