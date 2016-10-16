@extends('layouts.app')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
	
		#login{
			margin: 0 auto;
			display: block;
			margin-top: 5%;
		}
		section#modal{
			width: 500px;
			height: 300px;
		}
		
</style>
	
<button id = "login" class="btn btn-primary btn-large">Upload Image MODAL</button>


<section class="modal fade" id="modal">

<div class="modal-body">

	<form action="modal" method="post">
		{{ csrf_field() }}
	<div class="form-group">
		<label for="name">Title</label>
		<input type="text" class="form-control" id="name" name="name">

		<label for="error" id="error"></label>
	</div>

	<div class="form-group">	
		<label for="path">Upload Image</label>
		<input type="file" class="form-control" id="path" name="path">
	</div>

	<button type="submit" class="btn-danger">Submit</button>

	</form> 

</div>

</section>
<script type="text/javascript">
	
		$(document).ready(function()
		{
				
			$('#login').on('click',function()
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

@endsection