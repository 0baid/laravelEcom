@extends('admin.app')
@section('content')
    <form class="form-horizontal" method="post" action="@if (isset($product)) {{route('admin.product.update' , $product->id)}} @else {{route('admin.product.store')}} @endif " enctype="multipart/form-data">
		@if (isset($product))
			@method('PUT')
		@endif
		<div class="row">
			@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
			@csrf
			<div class="row col-lg-12">
				<div class="col-lg-9">
					<div class="form-group row">
						<div class="col-lg-12">
							<label class="form-control-label">Title:</label>
							<input type="text" id="texturl" name="title" class="form-control" value="{{@$product->title}}">
							<div class="form-group row mt-2">
								<div class="col-lg-12">
									<label class="form-control-label">Description:</label>
									<textarea name="description" id="editor" class="form-control" cols="30" rows="10" >{!! @$product->description !!}</textarea>
								</div>
							</div>
							<div class="form-group row col-lg-9">
								<div class="col-6">
									<label class="from-control-label">Price:</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">$</span>
										</div>
										<input type="text" class="form-control" name="price" placeholder="0.00" aria-label="price" aria-describedby="basic-addon1" value="{{@$product->price}}"/>
									</div>
								</div>
								<div class="col-6">
									<label class="from-control-label">Discount:</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">$</span>
										</div>
										<input type="text" class="form-control" name="discount_price" placeholder="0.00" aria-label="discount" aria-describedby="basic-addon1" value="{{@$product->discount_price}}"/>
									</div>
								</div>
							</div>
							<div class="form-group row col-lg-12">
								<div class="card col-sm-12 p-0 mb-2">
									<div class="card-header align-items-center">
										<h5 class="card-title float-left">Extra Options</h5>
										<div class="float-right">
											<button type="button" id="btn-add" class="btn btn-primary btn-sm" href="#" >+</button>
											<button type="button" id="btn-add" class="btn btn-danger btn-sm" href="#" >-</button>
										</div>
									</div>
									<div class="card-body" id="extras">
										<div class="row align-items-center options">
											<div class="col-sm-4">
												<label class="form-control-label">Option <span class="count">1</span></label>
												<input type="text" name="extras[option][]" id="" class="form-control">
											</div>
											<div class="col-sm-8">
												<label class="form-control-label">Values</label>
												<input type="text" name="extras[values][]" class="form-control"/>
												<label class="form-control-label">Additional Prices</label>
												<input type="text" name="extras[prices][]" class="form-control"/>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="list-group row">
						<li class="list-group-item active"><h5>Status</h5></li>
						<li class="list-group-item">
							<div class="form-group row">
								<select class="form-control" id="status" name="status">
									<option value="1">Publish</option>
									<option value="2">Pending</option>
								</select>
							</div>
							<div class="form-group row">
								<div class="col-lg-12">
									<input type="submit" name="submit" class="btn btn-primary btn-block" value="@if (isset($product)) Update Record @else Add Record @endif">
								</div>
							</div>
						</li>
						<li class="list-group-item active"><h5>Featured Image</h5></li>
						<li class="list-group-item">
							<div class="input-group mb-3">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
									<label class="custom-file-label" for="thumbnail">Chose File</label>
								</div>
							</div>
							<div class="img-thumbnail text-center">
								<img src="@if(isset($product)) {{asset('/storage/'.$product->thumbnail)}} @else {{asset('/storage/'.'images/thumbnail.jpg')}}@endif" id="thumbnail" class="img-fluid">
							</div>
						</li>
						<li class="list-group-item">
							<div class="col-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="featured" type="checkbox" name="discount" value="0"></span>
									</div>
									<p type="text" class="form-control" name="featured" placeholder="0.00" aria-label="featured" aria-describedby="featured"></p>
								
								</div>
							</div>
						</li>
						<li class="list-group-item active"></li>
						<li class="list-group-item">
							<select name="category_id[]" id="select2" class="form-control" multiple>
								@if($categories->count()>0)
								@foreach ($categories as $category)
									<option value="{{$category->id}}">{{$category->title}}</option>
								@endforeach
								@endif
							</select>
						</li>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

@endsection