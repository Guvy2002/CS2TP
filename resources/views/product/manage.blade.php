@extends('layout')

@section('title', 'Products')

@section('content')

{{-- Form submission goes to web.php add-product function in the ProductController --}}
<form action="{{route('add-product')}}" method="post">
    <h1>Manage your products</h1>
    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif
    @csrf
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Size</th>
            <th>Gender</th>
            <th>Image</th>
            <th scope="col"></th>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name')}}"></td>
                <td><input type="number" class="form-control" placeholder="Price" name="price" step="0.01" min="0.00" value="{{old('price')}}"></td>
                <td><input type="number" class="form-control" placeholder="0" name="stock" min="0" value="{{old('stock')}}"></td>
                <td><input type="number" class="form-control" placeholder="0" name="size" step="0.5" min="0.00" value="{{old('size')}}"></td>
                <td>
                    <select class="form-control" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    </select>
                </td>
                <td><input type="file" name="image" id="image"></td>
                <td><button type="submit">Add product</button></td>
            </tr>
        </tbody>
    </table>
</form>

<span class="text-danger">@error('name') {{$message}} @enderror</span>
<span class="text-danger">@error('price') {{$message}} @enderror</span>
<span class="text-danger">@error('stock') {{$message}} @enderror</span>
<span class="text-danger">@error('size') {{$message}} @enderror</span>
<span class="text-danger">@error('gender') {{$message}} @enderror</span>

<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
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
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->stock}}</td>
            <td>{{$product->size}}</td>
            <td>{{$product->gender}}</td>
            <td>{{$product->imgPath}}</td>
            <td><button type="submit">Edit</button></td>
            </tr>
        @empty
            <td>No products</td>  
        @endforelse
    </tbody>
</table>

<a href="{{url('home')}}"><button>Home</button></a>
<a href="{{url('products')}}"><button>Products</button></a>

@endsection
