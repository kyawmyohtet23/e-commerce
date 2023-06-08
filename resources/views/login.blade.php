@extends('layout.master')

<div class="container" style="margin-top:80px;">
    {{-- {{ Hash::make('makeawish22') }} --}}
    <div class="row">
        <div class="col-5 mx-auto mt-5" >
            <div class="card bg-secondary text-dark">
                <div class="card-header bg-secondary text-center">
                    Login
                </div>

                <div class="card-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name :</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your name">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        </div>
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

                        <input type="submit" value="Login" class="btn btn-dark w-100">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>