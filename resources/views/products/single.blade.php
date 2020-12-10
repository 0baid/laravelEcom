@extends('layouts.app')
@section('content')
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <img class="card-img-top img-thumbnail" src="{{asset('storage/'.$product->thumbnail)}}">
                    </div>
                    <div class="col-md-8">
                        <h4 class="card-title">{{$product->title}}</h4>
                        
                        <div class="justify-content-center d-block align-items-center">
                            <div class="btn-group">
                                <a href="" class="btn btn-sm btn-outline-secondary">Add to Card</a>     
                            </div>
                        </div>
                        <p class="card-text mt-2">{!!$product->description!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection