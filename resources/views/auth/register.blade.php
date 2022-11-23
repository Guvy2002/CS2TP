@extends('layout')

@section('title', 'Welcome')

@section('content')

<form action="{{route('register-user')}}" method="post">
    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif
    @if(Session::has('mismatch'))
    <div class="alert alert-danger">{{Session::get('mismatch')}}</div>
    @endif
    @csrf
    <div class="col-md-4 col-md-offset-4">
        <label for="name">Name</label>
        <input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name')}}">
        <span class="text-danger">@error('name') {{$message}} @enderror</span>
        <br>

        <label for="email">Email</label>
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
        <span class="text-danger">@error('email') {{$message}} @enderror</span>
        <br>

        <label for="password">Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password" value="">
        <span class="text-danger">@error('password') {{$message}} @enderror</span>
        <br>

        <label for="password2">Password</label>
        <input type="password" class="form-control" placeholder="Re-enter Password" name="password2" value="">
        <span class="text-danger">@error('password') {{$message}} @enderror</span>
        <br>

        <button type="submit">Create account</button>
        <a href="{{url('login')}}">Sign in</a>
    </div>
</form>

@endsection