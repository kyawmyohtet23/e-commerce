@extends('admin.layout.master')

@section('content')

<div class="mt-3 p-2">
    <div class="border-bottom pb-3">
        <a href="{{ route('product.create') }}" class="btn btn-primary">Create Product</a>
    </div>
    
    @if ($product->count() == 0)
        
            <h4 class="alert alert-danger text-center">No Product Found</h4>
        
    @else
    <div>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Remain Qty</th>
                    <th>Add or Remove</th>
                    <th>Option</th>
                    <th>Trend/Not_trend</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $p)
                    <tr>
                        <td>
                            <img src="{{ asset('/images/' . $p->image) }}" style="width: 100px; height: 100px;" class="img-thumbnail" alt="">
                        </td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->total_quantity }}</td>
                        <td>
                            <a href="{{ route('createProductReduce', $p->slug) }}" class="btn btn-warning btn-sm px-3">-</a>
                            <a href="{{ route('createProductAdd', $p->slug) }}" class="btn btn-warning btn-sm px-3">+</a>
                        </td>
                        <td>
                            <a href="{{ route('product.edit', $p->slug) }}" class="btn btn-sm btn-dark">Edit</a>
                            <form action="{{ route('product.destroy', $p->slug)}}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete?')">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('trend') }}" class="d-inline" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $p->id }}">
                                <select name="trend" id="" class="btn btn-dark btn-sm">
                                    <option value="trend" {{ $p->trend == 'trend' ? 'selected' : '' }} >Trend</option>
                                    <option value="not_trend" {{ $p->trend == 'not_trend' ? 'selected' : '' }}>Not_trend</option>
                                </select>
                                <button class="btn btn-sm btn-outline-primary ms-3" type="submit">Change</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="offset-5">
            {{ $product->links() }}
        </div>
    </div>
    @endif
</div>
@endsection