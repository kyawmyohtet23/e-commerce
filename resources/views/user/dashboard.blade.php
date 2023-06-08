@extends('layout.master')


@section('content')
    <div class="container">
        <div id="root" style="margin-top: 100px;">

        </div>  
    </div>

@endsection

@section('script')

<script>
    const blade_user = @json($user);
</script>

<script>
    const successCheckOut = (message) => {
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
        const errorCheckOut = (message) => {
      Toastify({
text: message,
close: true,
gravity: "top",
className: "bg-danger",
position: 'center',
}).showToast();
    }
  </script>
    <script src="{{ asset('js/Profile.js') }}"></script>
@endsection