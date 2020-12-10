@extends('admin.app')
@section('content')
    <h2>Profiles</h2>
    <div class="row d-block">
        <div class="col-sm-12">
          @if (session()->has('message'))
          <div class="alert alert-success">
            {{session('message')}}
          </div>
          @endif
        </div>
      </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="h2">Profile List</h2>
    
      <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{route('admin.profile.create')}}" class="btn btn-sm btn-outline-secondary">
          Add Profile
        </a>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Profile Picture</th>
            <th>Date Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if($users->count() > 0)
          @foreach($users as $user)
          <tr>
            
            <td>{{$user->id}}</td>
            <td>{{$user->profile->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->profile->address}}</td>
            <td>{{$user->profile->phone}}</td>
            <td><img src="{{asset('storage/'. $user->profile->thumbnail)}}" class="img-responsive" height="50"></td>
            <td>{{$user->created_at}}</td>
            <td>
              <form id="profile-delete" action="{{route('admin.profile.destroy' , $user->id)}}" method="post">
                @csrf
                <a href="{{route('admin.profile.edit', $user->id)}}" class="btn btn-primary btn-sm">Edit</a>
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
          @else
        
          <tr>
            <td colspan="7" class="alert alert-info">No products Found..</td>
          </tr>
          @endif
          
        </tbody>
        
      </table>
    </div>
    <div class="row">
      <div class="col-md-12">
    
      </div>
    </div>
@endsection