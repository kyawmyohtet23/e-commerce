@extends('admin.layout.master')

@section('content')
    {{ auth()->guard('admin')->user()->name }}

@endsection