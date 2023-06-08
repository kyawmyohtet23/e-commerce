@extends('layout.master')

@extends('layout.slider')

@section('css')
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
@endsection

@section('content')

    {{-- <div class="">
        <div class="card pt-2 text-center" id="card">
            <form action="">



            </form>
        </div>
    </div> --}}

    <div class="container">
        <div class="row mt-4">
            @if (session('nothing'))
                <h5 class="text-center text-dark">{{ session('nothing') }}</h5>
            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="border ms-3 px-4">
                <ul class="list-group list-group-flush text-center">
                    <form action="">
                        <li class="list-group-item">
                            <select name="category_slug" class="form-control" id="">
                                <option value="">Category</option>
                                @foreach ($category as $c)
                                    <option value="{{ $c->slug }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </li>
                        <li class="list-group-item">
                            <select name="color_slug" class="form-control" id="">
                                <option value="">Color</option>
                                @foreach ($color as $c)
                                    <option value="{{ $c->slug }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </li>
                        <li class="list-group-item">
                            <select name="brand_slug" class="form-control" id="">
                                <option value="">Brand</option>
                                @foreach ($brand as $b)
                                    <option value="{{ $b->slug }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </li>
                        <li class="list-group-item">
                <input type="text" class="form-control" placeholder="search" name="nameSearch" id="">
                        <div class="mt-3">
                            <input type="submit" class="btn btn-sm text-white bg-primary" value="search" name="" id="">
                            <a href="{{ route('allProduct') }}" class="btn btn-sm btn-danger">Clear</a>
                        </div>

                        </li>
                    </form>
                    
                  </ul>
            </div>
        </div>
        <div class="col-8">
            <div class="row">
            @foreach ($product as $p)
                        <div class="col-4 mt-3">
                            <div class="card border-0">
                                <img src="{{ asset('/images/' . $p->image) }}" style="width: 150px; height: 150px;" class="d-block mx-auto" alt="">
                
                                    <div class="card-body text-center">
                                        <h6>{{ $p->name }}</h6>
                                        <span>{{ $p->sale_price }}</span>
                                    </div>
                                </div>
                        </div>
            @endforeach
        </div>

        </div>
    </div>

    <div class="">
        {{ $product->links() }}
    </div>
   
@endsection