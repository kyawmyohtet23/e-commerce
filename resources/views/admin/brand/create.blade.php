@extends('admin.layout.master')


@section('content')
    {{-- <div class="container mt-4"> --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                
            </div>
        @endif
        <div class="mt-4 px-2">
            <div class="border-bottom pb-3">
                <a href="{{ route('brand.index') }}" class="btn btn-dark">All Brand</a>
            </div>

            <div class="mt-3">
                <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Enter Brand Name</label>
                        <input type="text" placeholder="Category..." name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Choose photo</label>
                        <input type="file" name="image" class="form-control">
                    </div>
        
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>

        </div>

    {{-- </div> --}}
@endsection

