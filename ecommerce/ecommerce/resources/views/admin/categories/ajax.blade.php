<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<button type="button" id="getRequest" class="btn btn-warning">getRequest</button>
   
   <div class="row col-lg-5" id="add"  style="visibility:hidden">
   </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript">
   
  $(document).ready(function()
  {
    $('#getRequest').click(function()
    { 

    	if(confirm("Are your sure ?"))
    	{
    	$.get('getRequest', function(data){
        
        console.log(data);
          });
    	}else{

    	}
     
    });
   
  });

  </script>

</body>
</html>