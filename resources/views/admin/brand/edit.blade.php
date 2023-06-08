@extends('admin.layout.master')

@section('content')
    {{-- <div class="container mt-4"> --}}
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mt-4 px-2">
            <div class="border-bottom pb-3">
                <a href="{{ route('brand.index') }}" class="btn btn-dark">All Brand</a>
            </div>

            <div class="mt-3">
                <form action="{{ route('brand.update', $brand->slug) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Enter Brand Name</label>
                        <input type="text" placeholder="brand..." value="{{ $brand->name }}" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Choose photo</label>
                        <input type="file" name="image" class="form-control">
                        <img src="{{ asset('/images/' . $brand->image) }}" style="width:100px; height:100px" class="img-thumbnail" alt="">
                    </div>
        
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>

        </div>
    {{-- </div> --}}
@endsection