@extends('layout.master')

@section('css')
    <style>
        .color .border {
            cursor: pointer;
        }
        .color .white:hover {
            cursor: pointer;
            background-color: white;
        }

        .color .red:hover {
            cursor: pointer;
            background-color: rgb(235, 42, 42);
            color: white !important;
        }

        .color .black:hover {
            cursor: pointer;
            background-color: black;
            color: white !important;
        }
    </style>
@endsection

@section('content')
    
<div id="root" style="margin-top: 100px;"></div>


@endsection

@section('script')
<script>
    // window.product_slug = "{{ $slug }}";
    const blade_product_data = @json($product);

</script>
{{-- <script src="{{ mix('js/productDetail.js') }}"></script> --}}
<script src="{{ asset('js/Detail.js') }}"></script>

@endsection