@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container">
    @include('errors')

    @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-offset-3 col-sm-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($images as $p)
                        <li class="list-group-item">
                            <span class="badge">{{ $p['qty'] }}</span>
                            <strong>{{ $p['image']['name']  }}</strong>
                            <span class="label label-success">{{ '$'. $p['price']  }}</span>

                            {!! Form::open(array('url'=>'action', 'method'=>"get")) !!}
                            <a href= "{{ url('remove/' . $p['image']['id']) }}"  class="glyphicon glyphicon-remove"></a>
                            <a href= "{{ url('increase/' . $p['image']['id']) }}"  class="glyphicon glyphicon-plus"></a>
                            <a href= "{{ url('decrease/' . $p['image']['id']) }}"  class="glyphicon glyphicon-minus"></a>
                            {!! Form::close() !!}
                        </li>
                    @endforeach
                </ul>
                <div class="row col-sm-6">
                    Total Price:<strong> {!! ' $' .$totPrice .' '  !!} </strong>
                    <hr>
                  <a href="{{ route('checkout')  }}" type="button" class="btn btn-success">Checkout</a>
                </div>
            </div>
        </div>
    @else
    <h2>No Items in the cart </h2>
    @endif

@endsection