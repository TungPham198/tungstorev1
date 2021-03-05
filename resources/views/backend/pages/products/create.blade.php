@extends('backend.index') @section('content')
<script src="{{ asset('assets/ckeditor/ckeditor/ckeditor.js') }}"></script>
<div class="row">
    <div class="col-lg-6">
        <div class="mt-5">
            <h2>Add Product</h2>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Sku: </label>
                    <input value="{{ old( 'sku')}}" type="text" name="sku" class="form-control" id="exampleInputEmail1" placeholder="Enter name"> @if($errors->has('sku'))
                    <p class="text-danger mt-2">{{ $errors->first('sku') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name: </label>
                    <input value="{{ old( 'name')}}" type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name"> @if($errors->has('name'))
                    <p class="text-danger mt-2">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Import Price: </label>
                    <input value="{{ old( 'import_price')}}" type="number" name="import_price" class="form-control" id="exampleInputPassword1" placeholder="Index"> @if($errors->has('import_price'))
                    <p class="text-danger mt-2">{{ $errors->first('import_price') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Price: </label>
                    <input type="number" value="{{ old( 'price')}}" name="price" class="form-control" id="exampleInputPassword1" placeholder="Index"> @if($errors->has('price'))
                    <p class="text-danger mt-2">{{ $errors->first('price') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Amount: </label>
                    <input type="number" value="{{ old( 'amount')}}" name="amount" class="form-control" id="exampleInputPassword1" placeholder="Index"> @if($errors->has('amount'))
                    <p class="text-danger mt-2">{{ $errors->first('amount') }}</p>
                    @endif
                </div>
                <!-- <div class="form-group">
                    <label for="exampleInputPassword1">Category </label>
                    <input type="text" name="category_id" class="form-control" id="exampleInputPassword1" placeholder="Index"> @if($errors->has('index'))
                    <p class="text-danger mt-2">{{ $errors->first('index') }}</p>
                    @endif
                </div> -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Category: </label>
                    <div class="col-md-10">
                        <select name="category_id" class="form-control">
                            <option value="">----Choese----</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('category_id'))
                    <p class="text-danger mt-2">{{ $errors->first('category_id') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Summary: </label>
                    <input value="{{ old( 'summary')}}" type="number" name="summary" class="form-control" id="exampleInputPassword1" placeholder="Index"> @if($errors->has('summary'))
                    <p class="text-danger mt-2">{{ $errors->first('summary') }}</p>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Status: </label>
                    <div class="col-md-10">
                        <select name="status" class="form-control">
                            <option value="1">Hết hàng</option>
                            <option value="2">Còn hàng</option>
                        </select>
                    </div>
                    @if($errors->has('status'))
                    <p class="text-danger mt-2">{{ $errors->first('status') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <p>Default file input</p>
                    <input value="{{ old( 'image')}}" name="images[]" type="file" class="filestyle" multiple>
                </div>
                <div class="form-group row">
                    <!-- <label class="col-md-2 col-form-label" for="example-textarea">Description: </label> -->
                    <div class="col-md-10" style="width: 100%;flex: 0 0 100%; max-width: 100%;">
                        <textarea name="des" class="form-control" cols="100" rows="12" id="example-textarea" placeholder="Description at here."></textarea>
                    </div>
                    @if($errors->has('des'))
                    <p class="text-danger mt-2">{{ $errors->first('des') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('example-textarea');
</script>
@endsection