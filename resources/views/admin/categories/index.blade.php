@extends('admin.app')
@section('content')
    <h2>Categories</h2>
    @if (session()->has('message'))
    <div class="alert alert-success">
      {{session('message')}}
    @endif
    </div>
    <a class="btn btn-primary" href="{{route('admin.category.create')}}">Create</a>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Description</th>
              <th>Category</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @if ($categories)
              @foreach ($categories as $category)
            <tr>
              <td>{{$category->id}}</td>
              <td>{{$category->title}}</td>
              <td>{{$category->description}}</td>
              <td>
                  @if ($category->childrens()->count()>0)
                        @foreach ($category->childrens as $children)
                            {{$children->title}}, 
                        @endforeach
                  @else
                        {{"Parent Category"}}
                  @endif
              </td>
              <td>
                <form action="/admin/category/{{$category->id}}" method="post">
                  @method('delete')
                  @csrf
                  <a href="/admin/category/{{$category->id}}/edit" class="btn btn-primary">Edit</a>
                  <span>|</span>
                  <button class="btn btn-danger" id="submit" name="submit">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach 
            @else
            <tr>
                <td colspan="4">No Category found</td>
            </tr>
            @endif
          </tbody>
          
        </table>
        {{$categories->links()}}
      </div>
@endsection