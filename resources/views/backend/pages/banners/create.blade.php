@extends('backend.index') @section('content')
<!-- <script src="{{ asset('assets/ckeditor/ckeditor/ckeditor.js') }}"></script> -->
<div class="row">
    <div class="col-lg-6">
        <div class="mt-5">
            <h2>Add Banner</h2>
            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Name: </label>
                    <input value="{{ old( 'name')}}" type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name"> @if($errors->has('name'))
                    <p class="text-danger mt-2">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Link: </label>
                    <input value="{{ old( 'link')}}" type="text" name="link" class="form-control" id="exampleInputEmail1" placeholder="Enter link"> @if($errors->has('link'))
                    <p class="text-danger mt-2">{{ $errors->first('link') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label class="control-label text-capitalize">Images</label>
                    <div class="input-images-1" id="dropzone" style="padding-top: .5rem;"></div>
                    @if($errors->has('image'))
                    <p class="text-danger mt-2">{{ $errors->first('image') }}</p>
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

 @section('admin_js')
<script src="assets\libs\select2\js\select2.min.js"></script>
<script src="assets\libs\dropzone\dropzone.min.js"></script>
<script>
    $('.input-images-1').imageUploader({
        imagesInputName: 'image',
        preloadedInputName: 'preloaded',
        label: "{{ trans('dashboard.label.placeholder_image') }}"
    });
</script>
@endsection