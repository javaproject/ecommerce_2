   @if(Auth::user()->isAdmin())
     {!! Form::label('album','Assign Album: ') !!}
            <select class="form-control" name="album_id">
            <option value=""> SELECT AN OPTION </option>
                @foreach($arr['albums'] as $album)

      <option value = "{{ $album->id}}" {{  ($album->id ==$arr['image']->album_id) ? 'selected = "selected" ': ''}} > {{ $album->name }} 
      </option>
               
                @endforeach
<br><br>
 <h1>Change</h1>
          @if($arr["image"]->active==1)
         
          <div class="form-group">
              <div class="form-inline">
                  <div class="radio">
                    <br>
                     {{Form::radio('act','Active',true)}}
                     {!! Form::label('label', 'Activated ') !!}
                  
                      {{Form::radio('act','Not active')}}

                    {!! Form::label('label', 'Not Activated ') !!}
                  </div>
              </div>
          </div>
          @else
    
           <div class="form-group">
              <div class="form-inline">
                  <div class="radio">

                    {{Form::radio('act','Active')}}

                    {!! Form::label('label', 'Active ') !!}
                       {{Form::radio('act','Not active',true)}}

                    {!! Form::label('label', 'Not active ') !!}
                  </div>
              
              </div>
          </div>
           @endif

        
            @endif 