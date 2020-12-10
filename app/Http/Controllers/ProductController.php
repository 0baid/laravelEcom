<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Http\Requests\StoreProduct;
use Illuminate\Http\Request;
use App\Cart;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view ('admin.products.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        if($request->has('thumbnail')){
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('images/product', $name, 'public');
        }
            $product = Product::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'thumbnail' => $path,
                'status' => $request->status,
                'options' => isset($request->extras) ? json_encode($request->extras) : null,
                'featured' => ($request->featured) ? $request->featured : 0,
                'price' => $request->price,
                'discount'=>$request->discount ? $request->discount : 0,
                'discount_price' => ($request->discount_price) ? $request->discount_price : 0,
            ]);
            if($product){
                 $product->categories()->attach($request->category_id,['created_at'=>now(), 'updated_at'=>now()]);
                 return redirect(route('admin.product.index'))->with('message', 'Product Successfully Added');
            }else{
                 return back()->with('message', 'Error Inserting Product');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $products = Product::paginate(6);
        return view('products.all' , compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //dd($product->id);
        $categories = Category::all();
        return view ('admin.products.create',['categories' => $categories , 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if($request->has('thumbnail')){
            $extension = ".".$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
            $name = $name.$extension;
            $path = $request->thumbnail->storeAs('images/product', $name, 'public');
            $product->thumbnail = $path;
        }
        $product->title = $request->title;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->options = isset($request->extras) ? json_encode($request->extras) : null ;
        $product->featured = ($request->featured) ? $request->featured : 0;
        $product->price = $request->price;
        $product->discount = $request->discount ? $request->discount : 0;
        $product->discount_price = ($request->discount_price) ? $request->discount_price : 0;
        
       
        $product->categories()->detach();
        if($product->save())
        {
            $product->categories()->attach($request->category_id);
            return back()->with('message' , "Updated successfully");
        }else
        {
            return back()->with('message' , "Update Unsuccessful");
        }

            
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->withi('message',"Deleted Succesfully");
    }
    public function single(Product $product)
    {
        return view('products.single', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        //dd($query);
        $products = Product::where('title','like',"%$query%")->paginate(3);
        return view('products.all' , compact('products'));
    }

    public function addToCart(Product $product)
    {
        //dd(Session::get('cart'));
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart ($oldCart);
        $cart->addProduct($product,1);
        Session::put('cart' , $cart);
        return back();
    
    }

    public function removeFromCart(Product $product)
    {
        //dd($product);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeProduct($product);
        Session::put('cart' , $cart);
        return back();
    }
    public function showCart()
    {
        $cart = Session::get('cart');
        //dd($cart);
        return view('products.cart', compact('cart'));
    }
    public function updateCart(Product $product, Request $request)
    {
        //dd($request->qty);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateProduct($product, $request->qty);
        Session::put('cart' , $cart);
        return back();
    }

   
}