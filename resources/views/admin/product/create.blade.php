@extends('admin.layout.master')

@section('css')
{{-- select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

{{-- summer note --}}
<link href="summernote-bs5.css" rel="stylesheet">
@endsection

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
                <a href="{{ route('product.index') }}" class="btn btn-dark">All Product</a>
            </div>

            <div class="mt-3">
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="card p-4">
                                @csrf
                                <div class="form-group">
                                    <label for="">Enter Product Name</label>
                                    <input type="text" placeholder="Product..." name="name" class="form-control">
                                </div>
            
                                <div class="form-group">
                                    <label for="">Choose Product Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>

                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control" id="description" cols="5" rows="2"></textarea>
                                </div>
                    
                            
                        </div>

                        <div class="card p-4 mt-4">
                            <div class="form-group">
                                <label for="">Total Quantity</label>
                                <input type="text" name="total_quantity" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Buy Price</label>
                                <input type="text" value="" name="buy_price" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Sale Price</label>
                                <input type="text" value="" name="sale_price" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Discount Price</label>
                                <input type="text" name="discount_price" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-4 p-4">
                        <div class="form-group">
                            <label for="">Choose Supplier</label>
                            <select name="supplier_slug" id="supplier"  class="form-control">
                                @foreach ($supplier as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Choose Category</label>
                            <select name="category_slug" id="category" class="form-control">
                                @foreach ($category as $c)
                                    <option value="{{ $c->slug }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Choose Brand</label>
                            <select name="brand_slug" id="brand" class="form-control">
                                @foreach ($brand as $b)
                                    <option value="{{ $b->slug }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Choose Color</label>
                            <select name="color_slug[]" id="color" class="form-control" multiple>
                                @foreach ($color as $col)
                                    <option value="{{ $col->slug }}">{{ $col->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>

                    </div>
                </div>
            </form>
            </div>

        </div>
    {{-- </div> --}}
@endsection

@section('script')
{{-- select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- jquery --}}
{{-- <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<script src="summernote-bs5.js"></script>

<script>
    $(document).ready(function(){
        $('#supplier').select2();
        $('#category').select2();
        $('#color').select2();
        $('#brand').select2();

        $('#description').summernote();
    })
</script>
@endsection