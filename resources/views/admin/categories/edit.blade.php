@extends('layouts.master')
@section('content')
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="{{route('categories.index')}}">back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-8">
                <form action="{{route('categories.update',$category->id)}}" method="post">
                    @method('put')
                    @csrf
                    <div class="">
                        <label for="">Category Name</label>
                        <input type="text" name="name" id="" class="form-control" value="{{$category->name}}">
                        @error('name')
                        <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="">
                        <label for="" class="form-label">Parent Category</label>
                        <select name="parent_id" id="" class="form-control">
                            @if($category->parent_id==null)
                                <option value="">No Parent</option>
                                @foreach($parents as $parent)
                                <option value="{{$parent->id}}">{{$parent->name}}</option>
                                @endforeach
                            @else
                            <option value="">No Parent</option>
                            @foreach($parents as $parent)
                            @if($parent->id==$category->id)
                                <option value="{{$parent->id}}" selected>{{$parent->name}}</option>
                            @else
                            <option value="{{$parent->id}}">{{$parent->name}}</option>
                            @endif
                            @endforeach
                            @endif
                        </select>
                        @error('parent_id')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary rounded-pill justify-content-center align-items-center">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection