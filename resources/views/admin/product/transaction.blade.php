@extends('admin.layout.master')

@section('content')
    <div class="border-bottom py-3">
        <a href="" class="btn btn-outline-success btn-sm py-2">Add Transactions</a>
        <a href="" class="btn btn-danger btn-sm py-2">Remove Transactions</a>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Total Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $t)
                <tr>
                    <td>
                        <img src="{{ asset('/images/'. $t->product->image) }}" style="width: 120px; height:100px;" class="img-thumbnail" alt="">
                    </td>
                    <td>{{ $t->product->name }}</td>
                    <td>{{ $t->total_quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection