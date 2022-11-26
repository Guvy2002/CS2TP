<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;

class BasketController extends Controller
{
    public function addToBasket(Request $request)
    {
        $request->validate([
            'hidden_id' => 'required|min:0',
            'hidden_name' => 'required',
            'hidden_price' => 'required',
        ]);
        //Don't think this is needed (it automatcally creates the 'cart' with push)
        // Creating the basket if it doesn't exist
        // if(!Session::has('cart')){
        //     Session::put('cart', []);
        // }

        // Session::put('cart', $item);
        $item =
            [
                "id" =>  $request->hidden_id,
                "price" => $request->hidden_price,
                "name" => $request->hidden_name
            ];
        // $item=[1 => ['price' => 10, 'name' => 'test'], [2 => ['price' => 20, 'name' => 'test2']], [3 => ['price' => 30, 'name' => 'test3']]];

        // Adding product to basket
        Session::push('cart', $item);

        return redirect('basket');
    }


    public function removeFromBasket()
    {
    }

    public function viewBasket()
    {

        $data = array();

        if (Session::has('cart')) {
            $data = session()->get('cart');
        }
        return view('basket.display', compact('data'));
    }
}
