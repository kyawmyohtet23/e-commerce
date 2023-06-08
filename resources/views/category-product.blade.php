@extends('layout.master')

@section('content')

    <div class="container" style="margin-top: 100px;">
      <h3 style="">
        <a href="{{ route('home') }}" class="text-dark">
        <i class="bi bi-arrow-left-circle"></i>

        </a>
    </h3>
        <div class="row mt-3">
            @foreach ($products as $p)
            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                <a href="{{ route('categoryProductDetail', $p->slug) }}">
                <div >
                  <div class="card border-0">
                    <img
                      src="{{ asset('/images/' . $p->image) }}"
                      style="width:150px; height:150px;"
                      alt=""
                      class='d-block mx-auto'
                    />
                    <div class="card-body text-center">
                      <h6 class="">{{$p->name}}</h6>
                      <span class='text-dark'>{{$p->sale_price}}ks</span>
                    </div>
                  </div>
                </div>
                  </a>
                  </div>
                @endforeach
                
        </div>
    </div>
@endsection