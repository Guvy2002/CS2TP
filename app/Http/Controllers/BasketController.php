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

        // Get the cart from the session, set an empty array if cart variable doesn't exist in session
        $cart =  Session::has('cart') ? Session::get('cart') : [];

        $productexists = false;
        // foreach ($cart as $i => $product) {
        //     echo ($i);
        //     echo ('<br>');
        //     echo ($product['id']);
        // }
        // echo count($cart[0]);
        //If product already in cart, increment its quantity
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $request->hidden_id) {
                $cart[$i]['quantity']++;
                $productexists = true;
                break;
            }
        }
        //If product not in cart, add it
        if (!$productexists) {
            $cart[] = [
                'id' => $request->hidden_id,
                'name' => $request->hidden_name,
                'price' => $request->hidden_price,
                'quantity' => 1,
                'total' => $request->hidden_price * 1
            ];
        }
        //Save cart to session
        Session::put('cart', $cart);

        return redirect('basket');
    }


    public function removeFromBasket($id)
    {
        // Get the cart from the session, set an empty array if cart variable doesn't exist in session
        $cart =  Session::has('cart') ? Session::get('cart') : [];

        //If product already in cart, remove the product
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                unset($cart[$i]); //remove the product
                $cart = array_values($cart); //reindex array
                break;
            }
        }
        //Save cart to session
        Session::put('cart', $cart);
        return redirect('basket');
    }

    public function updateQuantity($opertation, $id)
    {
        // Get the cart from the session, set an empty array if cart variable doesn't exist in session
        $cart =  Session::has('cart') ? Session::get('cart') : [];
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                if ($opertation == 'add') {
                    $cart[$i]['quantity']++;
                } else {
                    $cart[$i]['quantity']--;
                }
                if ($cart[$i]['quantity'] == 0) {
                    unset($cart[$i]); //remove the product
                    $cart = array_values($cart); //reindex array
                } else {
                    $cart[$i]['total'] = $cart[$i]['price'] * $cart[$i]['quantity'];
                }
                break;
            }
        }

        //Save cart to session
        Session::put('cart', $cart);
        return redirect('basket');
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
