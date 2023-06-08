@extends('admin.layout.master')

@section('content')

<div class="mt-3 p-2">
    <div class="border-bottom pb-3">
        <a href="{{ route('brand.create') }}" class="btn btn-primary">Create Brand</a>
    </div>
    
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brand as $b)
                <tr>
                    <td>
                        <img src="{{ asset('/images/'. $b->image) }}" style="width:100px; height:100px;" class="img-thumbnail rounded-circle" alt="">
                    </td>
                    <td>{{ $b->name }}</td>
                    <td>
                        <a href="{{ route('brand.edit', $b->slug) }}" class="btn btn-sm btn-dark">Edit</a>
                        <form action="{{ route('brand.destroy', $b->slug) }}" class="d-inline" method="post" onsubmit="return confirm('Are you sure you want to delete?')">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="offset-5">
            {{ $brand->links() }}
        </div>
    </div>
</div>
@endsection