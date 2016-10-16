@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

   @if (Session::has('category_created'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('category_created')  }}  
                 </div>
                  {{ Session::forget('category_created')}}

  @endif
     @if (Session::has('category_updated'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('category_updated')  }}  
                 </div>
                 

  @endif 
      @if (Session::has('category_deleted'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('category_deleted')  }}  
                 </div>
  @endif 


@if (Session::has('deleted'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('deleted')  }}  
                 </div>
               {{ Session::forget('deleted')}}

@endif 
  @if (Session::has('updated'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('updated')  }}  
                 </div>

  @endif 
  @if (Session::has('success'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('success')  }}  
                 </div>

  @endif 
   @if (Session::has('change_role'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('change_role')  }}  
                 </div>
       
  @endif 
    @if (Session::has('deleted_role'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('deleted_role')  }}  
                 </div>
       
  @endif 
   @if (Session::has('uploaded'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('uploaded')  }}  
                 </div>

  @endif
  
   @if (Session::has('image_deleted'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('image_deleted')  }}  
                 </div>

  @endif

   @if (Session::has('updated_name'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('updated_name')  }}  
                 </div>

  @endif

   @if (Session::has('album_created'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('album_created')  }}  
                 </div>

  @endif
  
   @if (Session::has('album_updated'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('album_updated')  }}  
                 </div>

  @endif
   
    @if (Session::has('album_deleted'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('album_deleted')  }}  
                 </div>

  @endif
  

    @if (Session::has('album_removed'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('album_removed')  }}  
                 </div>

  @endif
   @if (Session::has('image_removed'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('image_removed')  }}  
                 </div>

  @endif
    @if (Session::has('role_updated'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('role_updated')  }}  
                 </div>

  @endif
  

@if (Session::has('no_albums'))
                 
                 <div class="alert alert-info">
                   {{ Session::get('no_albums')  }}  
                 </div>

  @endif
       @if (Session::has('no_images'))
                 
                 <div class="alert alert-info">
                   {{ Session::get('no_images')  }}  
                 </div>

  @endif

     @if (Session::has('no_albums_active'))
                 
                 <div class="alert alert-info">
                   {{ Session::get('no_albums_active')  }}  
                 </div>

  @endif  
  
       @if (Session::has('pass_update'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('pass_update')  }}  
                 </div>

  @endif 
   
  

     @if (Session::has('updated_role'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('updated_role')  }}  
                 </div>

  @endif 