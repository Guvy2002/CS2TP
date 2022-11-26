@extends('layout')

@section('title', 'Basket')

@section('content')

@forelse ( $data as $product )
{{$product['name']}}<br>
@empty
empty
@endforelse

@endsection