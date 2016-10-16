@extends('layouts.app')
@section('content')

 <meta name="csrf-token" content="{{ csrf_token() }}" />
<center><h2>WELCOME </h2></center>
<div class="container">
@include('errors')
  @if (Session::has('category_updated'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('category_updated')  }}  
                 </div>
                 
                  {{ Session::forget('category_updated')}}

  @endif 
     @if (Session::has('category_created'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('category_created')  }}  
                 </div>
                  {{ Session::forget('category_created')}}

  @endif
     @if (Session::has('category_deleted'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('category_deleted')  }}  
                 </div>
                 {{ Session::forget('category_deleted')}}
  @endif 
 @if(Auth::user()->isAdmin())
   <h4><span><a href ="{{ url('/category/create') }}" >>> Create Category</a></span></h4>
  @endif
  @if($categories->count()>0)
  @foreach($categories->chunk(2) as $r)
    <div>
        @foreach($r as $category)
        <article class="col-md-4">
              <h2> {{$category->name}} </h2>
              <h2> <a href= "/category/{{$category->id}} "><img class="img-thumbnail" src="/uploads/images/{{ $category->thumbnail}}" alt="Fotoja nuk gjendet " style="width:310px; height:310px"></a></h2>
              <div class="body">
                  <h4>{{ $category->description }}</h4>
                  <p></p>
                  @if(Auth::user()->isAdmin())  
                  <div class="row" style=" background: rgba(255, 255, 255, 0.8);">
                         <div class="col-sm-2">
                 <a href="/category/{{$category->id}}/edit" style="color:inherit" class="links-dark edits pull-left">
                    <i class="fa fa-edit fa-lg"  style="font-size:35px; "></i>
                </a>
              </div>
            <div id="deleteThecategory" class="col-sm-2">
                <a href="#" style="color:inherit" onclick="                     
                           return confirm('Deleting this category will delete ALL its albums along with their images .  CONTINUE ??')"> 

                {!! Form::open(['method' => 'DELETE', 'route'=>['category.destroy', $category->id]]) !!}
                {!! Form::button('<i class="fa fa-trash fa-lg links-dark" style="font-size:35px;"></i>', ['class' => 'deletecategory','type' => 'submit']) !!}
                  </a>
                {!! Form::close() !!}
           </div>
            @endif
              </div>
        </article>
        @endforeach
    </div>
  @endforeach
 {{ $categories->links() }}
</div>
@endif
<br><br><br>
@stop