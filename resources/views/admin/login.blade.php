<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/assets/css/argon-design-system.min.css">
    
    {{-- toastify --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body>
    <div class="container mt-5">
        {{-- {{ Hash::make('makeawish22') }} --}}
        <div class="row">
            <div class="col-4 mx-auto mt-5" >
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        Admin Login
                    </div>

                    <div class="card-body">
                        <form action="{{ route('adminLogin') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" name="email" placeholder="your@gmail.com">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="password" class="form-control" name="password" placeholder="password">
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            </div>

                            <input type="submit" value="Login" class="btn btn-primary w-100">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/gulpfile.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <style>
        .toastify {
            background-image: unset;
        }
    </style>

    @if(session()->has('error'))
    <script>
        Toastify({
  text: "{{ session('error') }}",
  className: "bg-danger",
  position: 'center',
}).showToast()
    </script>

    @endif
</body>
</html>