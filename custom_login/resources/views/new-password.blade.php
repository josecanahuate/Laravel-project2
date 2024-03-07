@extends('layout')
@section('title', 'login')

@section('content')
<main>
<div class="ms-auto me-auto mt-5"  style="width:500px;">
<div class="mt-5">
        @if($errors->any())
            <div class="col-12">
                @foreach($errors->all() as $errors)
                <div class="alert alert-danger">{{ $errors }}  </div> <!-- alerta para imprimir errorses -->
                @endforeach
            </div>
        @endif
    </div>

    @if(session()->has('errors'))
    <div class="alert alert-danger">{{ session('errors') }}  </div> <!-- alerta para imprimir errorses -->
    @endif

    @if(session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}  </div> <!-- alerta para imprimir errorses -->
    @endif
    <p>We will send a link to your email, use that link to reset password</p>

    <form action="{{ route('reset.password.post') }}" method="POST">
    @csrf
    <input type="text" name="token" hidden value="{{$token}}">

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Enter New Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</main>

@endsection