@extends('admin.layout.master')

@section('content')

<div class="mt-3 p-2">
    <div class="border-bottom pb-3">
        <a href="{{ route('category.create') }}" class="btn btn-primary">Create Category</a>
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
                @foreach ($category as $c)
                <tr>
                    <td>
                        <img src="{{ asset('/images/'. $c->image) }}" style="width:100px; height:100px;" class="img-thumbnail" alt="">
                    </td>
                    <td>{{ $c->name }}</td>
                    <td>
                        <a href="{{ route('category.edit', $c->slug) }}" class="btn btn-sm btn-dark">Edit</a>
                        <form action="{{ route('category.destroy', $c->slug) }}" class="d-inline" method="post" onsubmit="return confirm('Are you sure you want to delete?')">
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
            {{ $category->links() }}
        </div>
    </div>
</div>
@endsection