<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>12 Inya - Admin</title>
    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" /> --}}
    {{-- argon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/assets/css/argon-design-system.min.css">
    {{-- style.css --}}
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}">

    {{-- toastify --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    @yield('css')

</head>
<body>



    <div class="container-fluid">
        {{-- style="background-color: #001C31;" --}}
    @include('admin.layout.nav')

        <div class="row">
            <div class="col-2 text-center py-2 menus sticky-top shadow-sm">
                    <div class="list-group-flush list">
                        <a href="{{ route('order') }}" class="list-group-item list-group-item-action">
                          Orders
                        </a>
                        <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action">Products</a>

                        <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action">Category</a>

                        <a href="" class="list-group-item list-group-item-action">Brand</a>
                        <a href="" class="list-group-item list-group-item-action">Color</a>

                        <a href="" class="list-group-item list-group-item-action">Trend Menu</a>
                        <a href="{{ route('productTransaction') }}" class="list-group-item list-group-item-action">Product Transactions</a>
                        {{-- <a href="{{ route('adminLogout') }}" class="btn btn-danger w-100 mt-3">Logout</a> --}}
                        <form action="{{ route('adminLogout') }}" method="post">
                            @csrf
                            <input type="submit" value="logout" class="btn btn-danger w-100">
                        </form>
                    </div>
            </div>

            <div class="col-10 bg-secondary">

                <div class="card p-2">
                    @yield('content')

                </div>
            </div>



            {{--  --}}

        </div>
    </div>










    <script src="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/gulpfile.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>


    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    {{-- <script type="text/javascript" src="cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('script')

    {{-- toastify --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <style>
        .toastify {
            background-image: unset;
        }
    </style>

    @if(session()->has('success'))
    <script>
        Toastify({
  text: "{{ session('success') }}",
  className: "bg-success",
  position: 'center',
}).showToast()
    </script>

    @endif

</body>
</html>