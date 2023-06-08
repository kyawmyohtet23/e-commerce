@extends('admin.layout.master')

@section('content')
    <h4 class="p-2">Reduce for - <b class="text-success">{{ $product->name }}</b></h4>

    <div class="mt-2 px-2">
        <div class="border-bottom pb-3">
            <a href="{{ route('product.index') }}" class="btn btn-dark">All Product</a>
        </div>

        <div class="mt-3">
            <form action="{{ route('storeProductReduce', $product->slug) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Choose Supplier</label>
                    <select name="supplier_slug" id="supplier"  class="form-control">
                        @foreach ($supplier as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Total Quantity</label>
                    <input type="text" value="{{ $product->total_quantity }}" name="total_quantity" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" id="description" cols="5" rows="2">{{ $product->description }}</textarea>
                </div>
    
                <button type="submit" class="btn btn-primary">Reduce</button>
            </form>
        </div>

    </div>

@endsection