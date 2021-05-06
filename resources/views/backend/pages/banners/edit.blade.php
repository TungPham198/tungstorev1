@extends('backend.index') @section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="mt-5">
            <h2>Edit Banner: {{ $result->name}}</h2>
            <form action="{{ route('banners.update',['banner'=>$result->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name: </label>
                    <input value="{{ old( 'name')?old( 'name'): $result->name}}" type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name"> @if($errors->has('name'))
                    <p class="text-danger mt-2">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Link: </label>
                    <input value="{{ old( 'link')?old( 'link'): $result->link}}" type="text" name="link" class="form-control" id="exampleInputEmail1" value="{{ $result->link }}" placeholder="Enter link"> @if($errors->has('link'))
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
@endsection

@section('admin_js')
<script src="assets\libs\select2\js\select2.min.js"></script>
<script src="assets\libs\dropzone\dropzone.min.js"></script>
<script>
    let preloaded = [
        <?php $no = 0; ?>{
             id: {{ $no++ }},
            src: "{{ url('/upload/banners/' . $result->image) }}"
        },
    ];
    $(".input-images-1").imageUploader({
        preloaded: preloaded,
        imagesInputName: "image",
        preloadedInputName: "olderImage",
    });

    $( 'input[type=file]').change(function() {
        let arr = $('.uploaded-image');
        var count = arr.length-1;
        for(let i=0; i< count; i++){
            arr[i].remove();
        }
    });
</script>
@endsection