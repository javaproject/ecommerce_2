@extends('layouts.app')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> 
   
<form enctype="multipart/form-data" class="upload_form" method="POST" action="#">
       <div >
        <label for="catagry_name">Name</label>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="text"  id="catagry_name" placeholder="Name">
     
      </div>
      <div>
        <label for="catagry_name">File</label>
        <input type="file" name="logo"  id="catagry_logo">
        <p >Enter Catagory Logo.</p>
    </div>
    <div >
      <button type="button" class="addbtn">Add</button>
      <button type="button" class="cnclbtn">Reset</button>
    </div>
</form>
    

<script type="text/javascript">
	$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});  
		$(document).ready(function()
		{			
			$(".addbtn").click(function(){
		    var token = $('input[name=_token]').val();
					$.ajax({
					      url:'bateri',			   
					      data:new FormData($(".upload_form")[0]), '_token': token,			    
					      async:true,
					      type:'post',
					      processData: false,
					      contentType: false,
					      success:function(response){
					        console.log(response);
					      },
					    });
		 			});

		});

</script>

@endsection