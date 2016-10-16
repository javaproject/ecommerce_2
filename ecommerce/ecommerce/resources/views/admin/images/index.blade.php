@extends('layouts.app')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
@include('errors')
 @if (session('image_updated'))
    <div class="alert alert-success"> 
                  {{ Session::get('image_updated')  }}  </div>
     {{ Session::forget('album_updated') }}
                        
   @endif
    @if (session('image_deleted'))
    <div class="alert alert-success"> 
                  {{ Session::get('image_deleted')  }}  </div>
     {{ Session::forget('image_deleted') }}
   @endif
  @foreach(array_chunk($images->getCollection()->all(),3) as $r)
    <div class="row">
        @foreach($r as $image)
        <article class="col-md-4">
            <div class="row">
              <h4> {{ucfirst($image->name) .' '.$image->active}} </h4>

            @if(Auth::user()->isAdmin())
                 <a href= "/image/{{$image->id}}"><img src="/uploads/images/{{ $image->path}}" alt="Fotoja nuk gjendet " class = " img-thumbnail" style="width:200px; height:200px">
                 </a>
                 @else
                 <a href= "/uploads/images/{{ $image->path}}"><img src="/uploads/images/{{ $image->path}}" alt="Fotoja nuk gjendet " class = " img-thumbnail" style="width:200px; height:200px">
                 </a>
             @endif
           <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-xs-1">
                        {!! Form::open(['method' => 'get', 'route'=>['image.addImageToCart', $image]]) !!}
                        {!! Form::label('price','$ '. $image->price ) !!}
                        {!! Form::button('<i class="glyphicon glyphicon-shopping-cart"  style="font-size:20px;"> </i>',
                        ['style'=>'color:inherit','class'=>'btn-link ', 'type' => 'submit']) !!}
                        {{ csrf_field() }}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-xs-1">
                        @if(Auth::user()->isAdmin() || $image->editImage())
                          <a href="/image/{{$image->id}}/edit"  style="color:inherit" class="links-dark edits pull-left">
                            <i class="fa fa-edit fa-lg links-dark" style="font-size:35px;"></i>
                          </a>
                            {!! Form::open(['method' => 'DELETE', 'route'=>['image.destroy', $image->id]]) !!}
                            {!! Form::button('<i class="fa fa-trash fa-lg links-dark" style="font-size:20px;"></i>', ['class' => 'deletecategory','type' => 'submit']) !!}
                            {{ csrf_field() }}
                            {!! Form::close() !!}
                        @endif
                           </div>

                    </div>
                </div>
            </div>
        </article>
        @endforeach
    </div>
  @endforeach

  {{ $images->links() }}
</div><br>

@stop