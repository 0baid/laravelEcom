@extends('layouts.app')


@section('content')



<div class="card table-responsive">
  <table class="table table-hover shopping-cart-wrap">
    <thead class="text-muted">
      <tr>
        <th scope="col" >Product</th>
        <th scope="col" width="120" >Quantity</th>
        <th scope="col" width="120" >Price</th>
        <th scope="col" width="120" >Action</th>
      </tr>
    </thead>
    @if (isset($cart))
        
    
    @foreach ($cart->getContents() as $id => $product)
      <tbody>
        <td>
          <figure class="media">
            <div class="img-wrap col-md-2">
              <img src="{{asset('storage/'.$product['product']->thumbnail)}}" class="img-responsive" height="50">
            </div>
            <figcaption>
              <h6 class="title text-truncate ml-3">{{$product['product']->title}}</h6>
            </figcaption>
          </figure>
        </td>
        <td>
          <form action="{{route('cart.update',$product)}}"  method="POST">
            @csrf
          <input type="number" name="qty" id="qty" class="form-control text-center" min="0" max="99" value="{{$product['qty']}}">
          <button class="btn btn-block btn-outline-success btn-round" type="submit">Update</button>
        </form>
        </td>
        <td>
          <div class="price-wrap">
            <span class="price">USD {{$product['price']}}</span><br>
            <small class="text-muted">{{$product['product']->price}} USD each</small>
          </div>
        </td>
        <td>
          <form action="{{route('cart.remove' , $product)}}" method="post">
            @csrf
            <button type="submit" class="btn btn-block btn-outline-danger btn-round">X Remove</button>
          </form>
        </td>
        @endforeach
        <tr>
          <th colspan="2">Total:</th>
          <td>USD {{$cart->getTotalPrice()}}</td>
          <td>{{$cart->getTotalQty()}}</td>
        </tr>
      </tbody>    
  </table>
  

  <div class="form-group md-3">
    <form action="{{route('cart.checkout')}}" method="post" id="payment-form">
    {{ csrf_field() }}
      
        <button type="submit" class="btn btn-primary">Procceed to checkout</button>

    </form>
  </div>
</div>

<!--Script for stripe Elements-->


@endif
@endsection
