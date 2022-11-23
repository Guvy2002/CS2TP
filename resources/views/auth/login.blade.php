@extends('layout')

@section('title', 'Welcome')

@section('content')

<form action="{{route('login-user')}}" method="post">
    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif
    @csrf
    <div class="col-md-4 col-md-offset-4">
        <label for="email">Email</label>
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
        <span class="text-danger">@error('email') {{$message}} @enderror</span>
        <br>

        <label for="password">Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password" value="">
        <span class="text-danger">@error('password') {{$message}} @enderror</span>
        <br>

        <button type="submit">Login</button>
        <a href="{{url('register')}}">Register here</a>
    </div>
</form>

@endsection