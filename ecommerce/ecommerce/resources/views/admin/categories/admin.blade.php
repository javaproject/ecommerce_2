   @if(Auth::user()->isAdmin())
          @if($category->active==1)
         
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
              {!! Form::label('label', 'Change ') !!}
              <div class="form-inline">
                  <div class="radio">

                        {{Form::radio('act','Active')}}

                    {!! Form::label('label', 'Active ') !!}
                      
                  </div>
                  <div class="radio">
                         {{Form::radio('act','Not active',true)}}

                    {!! Form::label('label', 'Not active ') !!}
                  </div>
              </div>
          </div>
           @endif
            @endif 