
<section class="modal fade" id="modal">

<div class="modal-body">

	 {!! Form::open(['method' => 'POST', 'route'=>['image.store', $album->id] ,'files' => true, 'method' => 'post','class'=>'form-horizontal']) !!}
                
        <div class="form-group">
               <label for="name">Title</label>
               <input type="text" class="form-control" id="name" name="name">
                {{ Form::hidden('album_id', $album->id) }}
       </div>

       <div class="form-group">  
                <label for="path">Upload Image</label>
                <input type="file" class="form-control" id="path" name="path">
      </div>
              
      <button type="submit" class="btn btn-default btn-xm">Submit</button>
           {{ csrf_field() }}
          {!! Form::close() !!}
</div>
</section>
<script type="text/javascript">
	
		$(document).ready(function()
		{
				
			$('#upload').on('click',function()
			{
				$('#modal').modal({show:true});
					if($('#name').val() == '')
					{
						$('#error').text('fjdhfdjk');
						return false;
					}

			});

		});

</script>
