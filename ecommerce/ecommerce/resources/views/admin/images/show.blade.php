@extends('layouts.app')
@section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
 <br><br>
<div class="row"  style="background: #f5f5f5; padding:20px; border-radius:10px;">
		<article class="col-md-4" >
				<a href="/uploads/images/{{ $image->path}}">
			 <img  alt="Fotoja nuk gjendet " class="img-rounded" height="250px" width="250px" src="/uploads/images/{{ $image->path}}">
			 </a>
			</article>		
	
	<div class="content" >
	<br><br>
  			<table width="400" >
  			<th></th>
  			<tr><h4><th>Title:</th></h4>
  				<h3><td>{{ $image->name }}</td></h3></tr>
  				<th></th>
  				<tr><h4><th>Created By:</th></h4>
  				<h3><td>
          <a href = "/user/{{$image->user->id}}">{{ $image->user->username }}</a></td></h3></tr>
  				<th></th>
  				<tr><h4><th>Status:</th></h4>
  				<h3><td>{{ ($image->active()) ? 'Active' : 'Not Active' }}</td></h3></tr>
  					
  				
  			</table>
</div>
</div>

</div>
<div class="container">
			<h4><a href="/image" class="btn btn-primary">Back</a></h4>
</div>
@stop