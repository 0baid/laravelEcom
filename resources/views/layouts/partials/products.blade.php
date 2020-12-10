<div class="album bg-light">
    <div class="container">
        <form action="{{route('search')}}" method="get" class="btn-group mb-3">
            <input type="text" name="query" id="query" class="from-control">
            <button type="submit" class="btn btn-group btn-outline-secondary btn-sm">Search </button>
        </form>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" src="{{asset('storage/'.$product->thumbnail)}}" alt="Card image cap" style="height: 225px; width:100%; display:block;">
                    <div class="card-body">
                        <h4 class="card-title">{{$product->title}}</h4>
                        <p class="card-text">{!!substr($product->description,0,30)!!}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a type="button" href="{{route('products.single', $product)}}" class="btn btn-sm btn-outline-secondary">View Product</a>
                                <a type="button" href="{{route('cart.add' , $product)}}" class="btn btn-sm btn-outline-secondary">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            {{$products->links()}}
        </div>
    </div>
</div>
