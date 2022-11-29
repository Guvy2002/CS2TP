@extends('layout')

@section('title', 'Basket')

@section('content')
<h3>Basket</h3>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @php($total = 0)
        @forelse($data as $product)
        <tr>
            <td>{{$product['id']}}</td>
            <td>{{$product['name']}}</td>
            <td>{{$product['price']}}</td>
            <!-- TODO: Add quantity -->
            <td><input type='text' name='quantity' value={{$product['quantity']}} disabled></td>
            <td>{{$product['total']}}</td>
            <td><a href="{{route('remove-from-basket',$product['id'])}}">Remove</a></td>
            <td><a href="{{route('updateQuantity',['add',$product['id']])}}"><button>+</button></a></td>
            <td><a href="{{route('updateQuantity',['deduct',$product['id']])}}"><button>-</button></a></td>
        </tr>
        @php($total += $product['total'])

        @empty
        <td>No products</td>
        @endforelse
        @if($total > 0)
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <tr>
            <td colspan='3' align='right'>Total</td>
            <td align='middle'> <?= number_format($total, 2) ?> </td>
            <td>
                <form action="{{route('checkout-cart')}}" method="post">
                    @csrf
                    <input type='hidden' name='hidden_total' value="{{$total}}" />
                    <button type="submit">Checkout</button>
                </form>
            </td>
        </tr>
        @endif
    </tbody>
</table>

@if(Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif
@if(Session::has('fail'))
<div class="alert alert-danger">{{Session::get('fail')}}</div>
@endif

<a href="{{url('home')}}"><button>Home</button></a>
<a href="{{url('products')}}"><button>Products</button></a>

@endsection