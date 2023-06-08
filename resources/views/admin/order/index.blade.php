@extends('admin.layout.master')

@section('content')

<div class="mt-3 p-2">
    {{-- <div class="border-bottom pb-3">
        <a href="{{ route('category.create') }}" class="btn btn-primary">Create Category</a>
    </div> --}}
    
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Customer Information</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>
                        <img src="{{ asset('/images/'. $order->product->image) }}" style="width:100px; height:100px;" class="img-thumbnail" alt="">
                    </td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->total_quantity }}</td>
                    <td>{{ $order->product->sale_price * $order->total_quantity }}ks</td>
                    <td>
                        <table>
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>Email</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <form action="{{ route('changeStatus') }}" class="d-inline" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $order->id }}">
                            <select name="status" id="" class="btn btn-dark btn-sm">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="success" {{ $order->status == 'success' ? 'selected' : '' }}>Success</option>
                                <option value="cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>Cancel</option>
                            </select>
                            <button class="btn btn-sm btn-outline-primary ms-3" type="submit">Change</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="offset-5">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection