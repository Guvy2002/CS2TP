@extends('layout')

@section('title', 'Welcome')

@section('content')

<div class="container">
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Group</th>
            <th>Action</th>
        </thead>
        <tbody>
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->group}}</td>
                <td>
                    @if ($data->group > 0)
                        <a href="{{url('manage')}}">Manage Products</a><br>
                    @endif
                    <a href="{{url('logout')}}">Logout</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection