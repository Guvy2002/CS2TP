<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Order;

class BasketController extends Controller
{

    public function checkoutBasket(Request $request)
    {
        // Get our cart and check its not empty
        $cart = Session::has('cart') ? Session::get('cart') : [];
        if ( count($cart) == 0 ) return redirect('basket')->with('fail', "Checkout was unsuccessful, basket empty");

        // Keep track of the total value so we check again its correct
        $total_recount = 0;
        $validated_products = array();
        $allValid = true;

        // Process and validate each product in the cart, removes all invalid items and updates basket
        for ($i = 0; $i < count($cart); $i++) {
            $product = Product::where('id', '=', $cart[$i]['id'])->first();
    
            if( !$product ) {
                $this->removeFromBasket($cart[$i]['id']);
                $allValid = false;
                continue;
            }

            if ($cart[$i]['price']    ==  $product->price && 
                $cart[$i]['quantity'] <=  $product->stock) 
            {
                $validProduct = array('id'=>$product->id, 'quantity'=>$cart[$i]['quantity'], 'price'=>$cart[$i]['price']);
                array_push($validated_products, $validProduct);
            }
            else {
                $this->removeFromBasket($cart[$i]['id']);
                $allValid = false;
                continue;
            }

            $total_recount += $product->price * $cart[$i]['quantity'];
        }

        if( $total_recount != $request->hidden_total || !$allValid ) return redirect('basket')->with('fail', "Checkout was unsuccessful, basket updated, {$total_recount}, {$request->hidden_total}, {$allValid}");

        $res = 0;

        $order = new Order();
        $order->user_id = Session::get('loginId');
        $order->total_price = $total_recount;
        $order->save();

        // Create orders
        foreach ( $validated_products as $product ) {
            // Update Inventory
            $record = Product::where('id', $product['id'])->first();
            $record->stock = $record->stock - $product['quantity'];
            $record->save();

            // Record Item sale 
            $sale = new Sale();
            $sale->order_id = $order->id;
            $sale->product_id = $product['id'];
            $sale->user_id = Session::get('loginId');
            $sale->price = $product['price'];
            $sale->quantity = $product['quantity'];
            $sale->save();
        }

        $this->clearBasket();

        return redirect('basket')->with('success', "Checkout was successful");
    }

    public function clearBasket() 
    {
        Session::pull('cart');
        return back();
    }

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
        $cart = Session::has('cart') ? Session::get('cart') : [];

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
