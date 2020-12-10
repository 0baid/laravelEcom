@extends('admin.app')
@section('content')
    <form class="form-horizontal" method="post" action="@if (isset($user)) {{route('admin.profile.update', $user->id)}} @else {{route('admin.profile.store')}} @endif" enctype="multipart/form-data">
		@if (isset($user))
			@method('PUT')
		@endif
		
		
		<div class="row">
			@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
							<li>{{ Session::get('message') }}</li>
						</ul>
					</div>
					@endif
			@csrf
		
			<div class="row col-lg-12">
				<div class="col-lg-9">
					<div class="form-group row">
						<div class="col-lg-12 mt-2">
							<label class="form-control-label">Name:</label>
							<input type="text" id="texturl" name="name" class="form-control col-lg-4" value="{{@$user->profile->name}}">
							<label class="form-control-label">Email:</label>
							<input type="text" id="texturl" name="email" class="form-control col-lg-4" value="{{@$user->email}}">
							@if (isset($profile))
								<label class="form-control-label">Old Password:</label>
								<input type="password" id="texturl" name="old_password" class="form-control col-lg-4" >
							@endif
							<label class="form-control-label">Password:</label>
							<input type="password" id="texturl" name="password1" class="form-control col-lg-4" >
							<label class="form-control-label"> Re-enter Password:</label>
							<input type="password" id="texturl" name="password2" class="form-control col-lg-4" >
							<label class="form-control-label">Address:</label>
							<input type="text" id="texturl" name="address" class="form-control col-lg-4" value="{{@$user->profile->address}}">
							<label class="form-control-label">Phone:</label>
							<input type="text" id="texturl" name="phone" class="form-control col-lg-4" value="{{@$user->profile->phone}}">
							<label class="form-control-label">Role:</label>
							<input type="text" id="texturl" name="Role" class="form-control col-lg-4" value="{{@$user->role_id}}">
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="list-group row">
						<li class="list-group-item active"><h5>Featured Image</h5></li>
						<li class="list-group-item">
							<div class="input-group mb-3">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
									<label class="custom-file-label" for="thumbnail">Chose File</label>
								</div>
							</div>
							<div class="img-thumbnail text-center">
								<img src="@if(isset($user)) {{asset('storage/'. $user->profile->thumbnail)}} @else {{asset('profile.png')}}@endif" id="thumbnail" class="img-fluid">
							</div>
						</li>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-12">
						<input type="submit" name="submit" class="btn btn-primary btn-block" value="Submit Profile">
					</div>
				</div>
			</div>
		</div>
	</form>
</div>


@endsection