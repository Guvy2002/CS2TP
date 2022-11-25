<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;

class BasketController extends Controller
{
    public function addToBasket(Request $request) {
        $request->validate([
            'hidden_id' => 'required|min:0',
            'hidden_name' => 'required',
            'hidden_price' => 'required',
        ]);
        $item = [
            $request->hidden_id => [
                // "id" =>  $request->hidden_id, 
                "price" => $request->hidden_price,
                "name" => $request->hidden_name
            ]
        ];
        // Creating the basket if it doesn't exist
        // if(!Session::has('cart')){
            
            Session::put('cart', $item);
        // }

        // Adding product to existing basket
       
        // $entire_cart= Session::get('cart');
        // $entire_cart[$request->hidden_id]=$item;
        // Session::put('cart', $entire_cart);

        
        return redirect('basket');
    }


    public function removeFromBasket() {

    }

    public function viewBasket() {

        $data = array();

        if(Session::has('cart')) {
            $data = session()->get('cart');
        }
        return view('basket.display', compact('data'));
    }

}