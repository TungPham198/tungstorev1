@extends('backend.index') @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="mt-5">
            <div>
                <h2 class="font-24" style="display: inline-block;">Category List</h2>
                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-bordered-primary">Add</a>
            </div>
            <br> @if(session('add_success'))
            <p class="text-success text-center">
                {{session('category_add_success')}}
                <?php session()->forget('category_add_success'); ?>
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
                            <th>Name</th>
                            <th>Index</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->index }}</td>
                            <td style="width: 20%;">
                                <div class="row d-plex justify-content-center">
                                    <a href="{{ route('categories.edit',['category'=>$category->id]) }}" class="mr-3"><i class="mdi mdi-pencil-box-multiple-outline text-primary"></i><span> Sửa </span></a>
                                    <a href="javascript:void(0);" onclick="if (confirm('Xác nhận xoá')) { $(this).find('form').submit();}">
                                        <form
                                            action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                            method="post">
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