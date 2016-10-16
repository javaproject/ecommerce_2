@extends('layouts.app')
@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<div class="container">
		@include('errors')
		@if (session('image_removed'))
			<div class="alert alert-success">
				{{ Session::get('image_removed')  }}
			    {{ Session::forget('image_removed') }}
			</div>
		@endif
		<div class="container">
			@foreach(array_chunk($images->all(),3)as $r)
				<div class="row">
					@foreach($r as $image)
						<article class="col-md-4">
						@if($image->showImage())
							<div class="well well-sm">
								<center>
									<div id="gallery">
										<h4>{{ $image->name .' '. $image->active}}</h4>
										<a href="/uploads/images/{{ $image->path}}" ><img alt="{{$image->name}}" class="img-thumbnail" height=200px width=200px src="/uploads/images/{{ $image->path}}"></a>
									</div>
									<!--ONLY ADMINS CAN REMOVE AN IMAGE -->
									@if(Auth::user()->isAdmin())
										<div class="row">
											<div class="col-sm-3">
												<a href="" style="color:inherit" class="links-dark edits pull-left" >
													{{ Form::open(['url'=>['removeimg',$image->id ], 'method' => 'PUT', 'class'=>'col-md-12']) }}

													{!! Form::button('<i class="fa fa-remove fa-lg links-dark" style="font-size:20px;"></i>', ['type' => 'submit', 'style'=>'']) !!}
													{{ Form::close() }}
												</a>
												@endif
							<br><br>
							<div class="container">
								<div class="row">
									<div class="col-xs-1">
										<br>
										{{ '$ '.$image->price  }}
										<div class="col-sm-6">
											<button type="button" class="btn btn-success btn-sm">
												<span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
											</button>
										</div>
									</div>
								</div>
						    </div>
										</div>
										</div>
								</center>

							</div>
						@endif
						</article>
					@endforeach
				</div>
			@endforeach
		</div>
		{{ $images->links() }}

		<link rel="stylesheet" href="/example2/colorbox.css" />
		<script type="text/javascript" src="/example2/jquery.colorbox-min.js"></script>
		<script type="text/javascript" src="/example2/jquery.colorbox.js"></script>
		<script type="text/javascript">

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$(document).ready(function(){
				$('#gallery a').colorbox({

					rel: 'slideshow',
					height: '65%',
					width: '65%',
					maxWidth: '100%'
				});

			});
		</script>
	</div>
@stop