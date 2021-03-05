@extends('backend.index') @section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="mt-5">
            <h2>Edit Category: {{ $result->name}}</h2>
            <form action="{{ route('categories.update',['category'=>$result->id]) }}" method="POST">
                @csrf @method('put')
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name: </label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{ $result->name }}"> @if($errors->has('name'))
                    <p class="text-danger mt-2">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Category Index: </label>
                    <input type="number" name="index" class="form-control" id="exampleInputPassword1" placeholder="Enter Index" value="{{ $result->index }}"> @if($errors->has('index'))
                    <p class="text-danger mt-2">{{ $errors->first('index') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection