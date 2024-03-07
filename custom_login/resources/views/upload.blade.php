@extends('layout')
@section('title', 'Upload Files')

@section('content')

<div class="container">
    <div class="mt-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    </div>

    <div class="mt-5">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    </div>

<form action="{{ route('upload.post') }}"  enctype="multipart/form-data" method="POST" class="ms-auto me-auto mt-5"  style="width:500px;">
@csrf
<div class="mb-3">
  <label for="formFile" class="form-label">Default file input example</label>
  <input class="form-control" name="file" type="file" id="formFile">
</div>
<input type="submit" class="btn btn-primary">
</form>
</div>

@endsection