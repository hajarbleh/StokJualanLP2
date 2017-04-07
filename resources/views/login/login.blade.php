@extends('layout.base')

@section('title','Login')

@section('content')
  <div class="h3">Login</div>
  <form action="" method="POST">
    {{ csrf_field() }}
    @if (session('login') == 'fail')
    <p class="text-danger">nrp atau password salah</p>
    @endif
    nrp : <input class="form-control" type="text" name="nrp" required="">
    <br>
    password : <input class="form-control" type="password" name="password" required="">
    <br>
    <input class="btn btn-default" type="submit" value="login">
  </form>
@endsection
