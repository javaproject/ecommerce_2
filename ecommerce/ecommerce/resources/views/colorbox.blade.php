<!DOCTYPE html>
<html>
<head>

 <meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>COLOR FUCKING BOX</title>
	    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="example1/colorbox.css" />
		<script src="example1/jquery.colorbox-min.js"></script>
		<script src="example1/jquery.colorbox.js"></script>
		
	<script>
	   $.ajaxSetup({  
         headers: {  
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                      } 
                     });
			$(document).ready(function(){
				

	$('#gallery').find('a').colorbox({rel:'gallery',width:"75%", height:"75%",
     maxWidth: '100%'});
			});
		</script>
</head>
<body>


<div id="gallery" class="caption">

	<a href=""><img src="/uploads/images/horse.jpg" height= 200px
	width=150px /></a>
</div>


</body>
</html>