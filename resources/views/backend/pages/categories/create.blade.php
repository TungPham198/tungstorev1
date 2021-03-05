@extends('backend.index') @section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="mt-5">
            <h2>Add Category</h2>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name: </label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name"> @if($errors->has('name'))
                    <p class="text-danger mt-2">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Category Index: </label>
                    <input type="number" name="index" class="form-control" id="exampleInputPassword1" placeholder="Index"> @if($errors->has('index'))
                    <p class="text-danger mt-2">{{ $errors->first('index') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection