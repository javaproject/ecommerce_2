@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                 <div class="panel-body">
                 @if (session('pass_update'))
                               <div class="alert alert-success"> {{ session('pass_update') }}</div>
                        
                 @endif
                   </div>   
                <div class="panel-body">
                    @if(session('logout'))
                    <div class="alert alert-success">
                        {{ session('logout') }}
                     </div>
                     @endif
                    You are logged in!
                    <p></p>
                    <p></p>
                    <div class="container">
                    <ul class="list-group">
                        <li class="list-group-item col-sm-3"><a href="/user" > Categories</a></li>
                        <li class="list-group-item col-sm-3"><a href="/role" > Albums</a></li>
                        <li class="list-group-item col-sm-3"><a href="/category">Images</a></li>
                    </ul>
                 </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
