@extends('layout')

@section('title', 'Basket')

@section('content')

@forelse ( $data as $product )
    {{$product['name']}}
@empty
    empty
@endforelse

@endsection