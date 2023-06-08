<div class="mt-5">
    <div id="carouselExampleFade" class="carousel slide carousel-fade">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('7be04e2f-e90e-4d1e-8fe6-bc6c23234b2b.jpg_1200x1200.jpg') }}"  class="d-block img-fluid w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h3><b>@lang('data.Title')</b></h3>
              @if (!auth()->guard('web')->check())
              <button class="btn btn-dark">Login</button>

              <a href="{{ route('registerPage') }}" class="btn btn-outline-dark">Register</a>
              @endif
                {{-- <button class="btn btn-outline-dark">Register</button> --}}
              </div>
          </div>
          <div class="carousel-item">
            <img src="{{ asset('7be04e2f-e90e-4d1e-8fe6-bc6c23234b2b.jpg_1200x1200.jpg') }}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('7be04e2f-e90e-4d1e-8fe6-bc6c23234b2b.jpg_1200x1200.jpg') }}" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>