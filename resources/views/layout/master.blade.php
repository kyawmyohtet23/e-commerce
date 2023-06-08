<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>e-commerce</title>
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.min.css') }}">
    {{-- argon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/assets/css/argon-design-system.min.css">
    {{-- owl-carousel2 --}}



    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')

</head>
<body>
    

    <div class="container-fluid mt-2">
        <div class="d-flex navbar fixed-top justify-content-around py-2 shadow-sm" style="background-color: white;">
            <div class="">
                <img src="{{ asset('logo.png.webp') }}" alt="">
            </div>
            <div class=" pt-3 d-flex menus">
                <div class="mx-4">
                    <a href="{{ route('home') }}" class="text-dark">Home</a>
                </div>
                <div class="mx-4">
                    <a href="{{ route('allProduct') }}" class="text-dark">Product</a>
                </div>

                <div class="mx-4">
                    <a href="" class="text-dark">Category</a>
                </div>

                <div class="mx-4">
                    <a href="" class="text-dark">About</a>
                </div>

                {{-- {{Hash::make('makeawish22')}} --}}
                
                <div class="mx-4 bag" style="margin-top: -6px;">
                    {{-- <a href="" class="text-dark">Cart</a> --}}
                    
                
                    {{-- <h4 class=""> --}}
                      <a href="" class="text-dark">
                      <i class="bi bi-bag-check fs-4"></i>
                      <span class="badge badge-danger cart" id="cartTotal">{{ $cartTotal }}</span>

                      </a>
                    {{-- </h4> --}}
                  
                  
                </div>
                
            </div>

            <div class=" pt-3">
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Account
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('loginPage') }}">Log In</a></li>
                        @auth
                        <li>
                            <form action="{{ route('logout') }}" class="d-inline" method="post">
                                @csrf
                                <input type="submit" class="dropdown-item" value="Logout">
                            </form>
                          </li>

                          <li>
                            <a href="{{ route('profile') }}" class="dropdown-item">Profile</a>
                          </li>
                        @endauth
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Language
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ url('language/en') }}">English</a></li>
                      <li><a class="dropdown-item" href="{{ url('language/mm') }}">Myanmar</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    @if(request()->is('/'))
      @include('layout.slider')
    @endif


@yield('content')


    {{-- argon --}}
    <script src="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/gulpfile.min.js"></script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>

    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.js') }}"></script>

    {{-- fontawesome --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- toastify --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

        <script>
             window.updateCart = cart => {
              const cartCount = document.getElementById('cart_count');
              cartCount.innerText = cart;
            }
        //    window.updateCart(0);

           window.auth = @json(auth()->user());
        </script>


        @if(session()->has('error'))

        <script>
          Toastify({
    text: "{{ session('error') }}",
    className: "bg-danger",
    position: 'center',
  }).showToast();

      </script>
        @endif

        @if(session()->has('success'))
        <script>
                      Toastify({
    text: "{{ session('success') }}",
    className: "bg-success",
    position: 'center',
  }).showToast();
        </script>

        @endif

        <script>
          const successToast = (message) => {
            Toastify({
    text: message,
    close: true,
    gravity: "top",
    className: "bg-dark",
    position: 'center',
  }).showToast();
          }
        </script>

<script>
  const errorToast = (message) => {
    Toastify({
text: message,
close: true,
gravity: "top",
className: "bg-danger",
position: 'center',
}).showToast();
  }

  // change cart total
  const changeCartTotal = (cartTotal) => {
    $('#cartTotal').text(cartTotal);
  }
</script>

<script>
  const localization = "{{ app()->getLocale() }}";
  console.log(localization);
</script>


    @yield('script')
</body>
</html>