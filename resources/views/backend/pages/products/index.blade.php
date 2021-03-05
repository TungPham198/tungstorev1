@extends('backend.index') @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="mt-5">
            <div>
                <h2 class="font-24" style="display: inline-block;">Product List</h2>
                <a href="{{route('products.create')}}" class="btn btn-primary btn-bordered-primary">Add</a>
            </div>
            <br> @if(session('add_success'))
            <p class="text-success text-center">

            </p>
            @endif @if(session('notice'))
            <p class="text-success text-center">
                {{session('notice')}}
            </p>
            @endif @if(session('error'))
            <p class="text-danger text-center">
                {{session('error')}}
            </p>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered m-0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $product)
                        <tr>
                            <!-- explode( " \\ ",$product->images)[0]) -->
                            <!-- $image = split(".",$product->images); -->
                            <th scope="row">{{ $product->id }}</th>
                            <td>
                                <img width="200px" src='upload/{{ explode("\\",$product->images)[0] }}' alt=""></td>
                            <td>
                                <p>Mã sản phẩm: {{ $product->sku }}</p>
                                <p>Tên sản phẩm: {{ $product->name }}</p>
                                <p>Danh muc: {{ $product->category->name }}</p>
                                <p>Trạng thái: {{ $product->status==1?'Hết hàng ':'Còn hàng ' }}</p>
                            </td>
                            <td>
                                <p>Giá bán: {{ $product->price }}</p>
                                <p>Giá nhập: {{ $product->import_price }}</p>
                            </td>
                            <td>
                                <p>Số lượng còn: {{ $product->amount }}</p>
                                <p>Số lượng bán: {{ $product->sold_amount }}</p>
                            </td>
                            <td style="width: 20%;">
                                <div class="row d-plex justify-content-center">
                                    <a href="" class="mr-3"><i class="mdi mdi-pencil-box-multiple-outline text-primary"></i><span> Sửa </span></a>
                                    <a href="javascript:void(0);" onclick="if (confirm('Xác nhận xoá ')) { $(this).find('form ').submit();}">
                                        <form action="" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                        <i class="mdi mdi-delete-sweep text-danger"></i><span> Xoá </span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
</script>
@endsection