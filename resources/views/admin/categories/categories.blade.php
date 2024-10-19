@extends('layouts.master')

@section('content')

<div class="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
                <a href="{{route('categories.create')}}" class="btn btn-primary rounded-pill w-100">Add New Category</a>
            </div>
            <div class="col-md-4">
                <a href="{{route('categories.restore')}}" class="btn btn-primary rounded-pill w-100">Restore All</a>
            </div>
        </div>
       
        <div class="row">
            @if($message=Session::get('success'))
                <span class="alert alert-success d-block">{{$message}}</span>
            @endif
        </div>
        <div class="row mt-5">
        <div class="col-md-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Parent Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$category->name}}</td>
                            @if($category->parent==null)
                            <td>-</td>
                            @else
                            <td>{{$category->parent->name}}</td>
                            @endif
                            <td data-url="{{route('categories.destroy',$category->id)}}">
                                  <a href="{{route('categories.edit',$category->id)}}" class="btn btn-outline-success rounded-pill">edit</a>
                                  <button class="btn btn-outline-danger rounded-pill btn-delete">delete</button>
                            </td>
                        </tr>                       

                        @empty
                        <tr>
                            <td colspan="4">
                                <span class="text-danger">Not Available Category data.Empty list.</span>
                            </td>

                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{$categories->links()}}
    </div>
</div>

@endsection