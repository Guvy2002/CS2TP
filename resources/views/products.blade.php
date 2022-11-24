@extends('layout')

@section('title', 'Welcome')

@section('content')

<table class="table">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Stock</th>
        <th scope="col">Size</th>
        <th scope="col">Gender</th>
        <th scope="col">Image</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @forelse($data as $product)
            <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->stock}}</td>
            <td>{{$product->size}}</td>
            <td>{{$product->gender}}</td>
            <td>{{$product->imgPath}}</td>
            <td><button type="submit">Add to cart</button></td>
            </tr>
        @empty
            <td>No products</td>  
        @endforelse
    </tbody>
</table>

@endsection