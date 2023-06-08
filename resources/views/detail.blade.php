@extends('layout.master')

@section('content')

    <div class="container">
        <h3 style="margin-top: 100px;">
            <a href="{{ route('categoryProduct', $category_slug) }}" class="text-dark">
            <i class="bi bi-arrow-left-circle"></i>

            </a>
        </h3>
    </div>
    <div id="root"></div>
@endsection

@section('script')
<script>
    const blade_product_data = @json($product);
    
//    console.log(blade_product_data);
    
    
</script>

<script src="{{ asset('js/Detail.js') }}"></script>

@endsection

