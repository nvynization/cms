@extends('layouts.master')
@section('content')
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-8">
                <form action="{{route('categories.store')}}" method="post">
                    @csrf
                    <div class="">
                        <label for="">Category Name</label>
                        <input type="text" name="name" id="" class="form-control">
                        @error('name')
                        <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="">
                        <label for="" class="form-label">Parent Category</label>
                        <select name="parent_id" id="" class="form-control">
                            <option value="">No Parent</option>
                            @foreach($parents as $parent)
                            <option value="{{$parent->id}}">{{$parent->name}}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary rounded-pill justify-content-center align-items-center">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection