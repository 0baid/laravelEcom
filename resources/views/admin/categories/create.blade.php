@extends('admin.app')
@section('content')
<form action="@if(isset($category)) {{route('admin.category.update' , $category->id)}} @else {{route('admin.category.store')}} @endif" method="post">
@csrf
@if (isset($category))
    @method('PUT')
@endif

<div class="form-group row">
    <div class="col-sm-12">
        <label for="form-controll-label">Title: </label>
        <input type="text" name="title" id="texturl" class="form-control" value="{{@$category->title}}">
        <p class="small">{{config('app.url')}} <span id="url"></span></p>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-12">
        <label for="form-controll-label">Description: </label>
        <textarea name="description" id="editor" class="form-control" rows="10" cols="80" >{{@$category->description}}</textarea>

    </div>
</div>

<div class="form-group row">
    <div class="col-sm-12">
        <label for="form-controll-label">Select Category: </label>
        <select name="parent_id[]" id="parent_id" class="form-control" multiple>
            @if ($categories)
                <option value="0">Top Level</option>
                option
                @foreach ($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                @endforeach
            @endif
            option
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-12">
        @if (isset($category))
        <input type="submit" value="Edit Category" class="btn btn-primary mt-2" name="submit">
        @else
        <input type="submit" value="Add Category" class="btn btn-primary mt-2" name="submit">
        @endif
    </div>
</div>



</form>

@endsection